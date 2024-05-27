<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Ajax
{
	public $ch;
	public $channel;
	public $title;
	public $subject;
	public $message = '';
	public $fc_source;
	public $score;
	public $id;
	public $postMeta = [];

	public function __construct ()
	{
		// Если пользователь аутентифицирован, используем wp_ajax
		add_action('wp_ajax_sendForm', [$this, 'sendAll']);
		add_action('wp_ajax_sendWapp', [$this, 'sendWapp']);

		// Если пользователь не аутентифицирован, используем wp_ajax_nopriv
		add_action('wp_ajax_nopriv_sendForm', [$this, 'sendAll']);
		add_action('wp_ajax_nopriv_sendWapp', [$this, 'sendWapp'], );
	}

	public function sanitizeData ()
	{
		foreach ($_POST as $key => $value) {
			if (
				in_array($key, [
					'form-id',
					'recaptchaResponse',
					'type',
					'specialization',
					'theme',
					'quote',
					'quality',
					'number',
					'deadline',
					'exam_time',
					'name',
					'email',
					'phone',
					'kontakt',
					'calltime',
					'promo',
					'order',
				])
			) {
				$_POST[$key] = sanitize_text_field($value);
			}
		}
	}

	public function sendAll ()
	{
		if (empty($_POST)) {
			wp_send_json_error(
				[
					'message' => __('Empty form!')
				]
			);
		}
		// $this->sanitizeData();
		$this->ch = json_decode(stripslashes($_COOKIE['fc_utm']))->utm_channel;
		$this->channel = $this->getChannel($this->ch);
		$this->title = $this->getTitle($this->ch);
		$this->subject = $this->getSubject($this->channel);
		$this->postMetaCookies();
		$this->postMetaUtm();
		$this->postMetaGeo();

		$res = new stdClass();
		$res->ToCRM = $this->sendToCRM();

		if (isset($res->ToCRM->id)) {
			$this->id = $res->ToCRM->id;
			$res->ToCRM->ok = true;
		} else {
			$this->id = 1;
			$res->ToCRM->ok = false;
			$res->ToCRM->id = 1;
		}

		$res->ToTG = $this->sendToTG($this->id);
		$res->FileToTG = $this->sendFileToTG($this->id);
		// $res->ToClient = $this->sendToClient($this->id);

		$result = [
			'ToCRM' => [
				'ok' => $res->ToCRM->ok,
				'id' => $res->ToCRM->id
			],
			'ToTG' => [
				'ok' => $res->ToTG->ok
			]
		];
		if (!is_null($res->FileToTG)) {
			$result['FileToTG'] = [
				'ok' => isset($res->FileToTG->ok) ? $res->FileToTG->ok : false
			];
		}
		wp_send_json($result);
	}

	public function sendToCRM ()
	{
		try {
			$headers = array(
				'Content-Type: multipart/form-data',
				'Authorization:Basic ' . base64_encode(CRM_LOGIN . ':' . CRM_PASSWORD),
			);
			// Prepare POST data
			$data = array_merge($_POST, $this->postMeta);
			if (!empty($_FILES['file']['tmp_name'])) {
				$fileUpload = new CURLFile($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']);
				$data['file'] = $fileUpload;
			}

			$ch = curl_init(CRM_URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 300);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

			$response = curl_exec($ch);
			$resDec = json_decode($response);
			if ($resDec === true || $resDec === null) {
				$resDec = (object) [
					'ok' => false,
					'status' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
					'error' => curl_error($ch),
					'res' => $response,
				];
			} else {
				$resDec = json_decode($response);
				$resDec->ok = true;
				$resDec->status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			}

			curl_close($ch);
			return $resDec;
		} catch (Exception $e) {
			return (object) [
				'ok' => false,
				'status' => 0,
				'error' => $e->getMessage(),
				'res' => '',
			];
		}
	}

	private function sendToTG ($id)
	{
		$text = "<b>{$this->title}</b>\r\n\n";
		$text .= "{$this->subject}\r\n\n";
		$text .= "<b>🥸 :</b> " . ($_POST['name'] ?? '') . "\r\n";
		$text .= "<b>📨 :</b> " . ($_POST['email'] ?? '') . "\r\n";
		$text .= "<b>📞 :</b> " . ($_POST['phone'] ?? '') . "\r\n";
		$text .= "<b>📌 :</b> " . ($_POST['type'] ?? '') . "\r\n";
		$text .= "<b>📎 :</b> " . ($_POST['specialization'] ?? '') . "\r\n";
		$text .= "<b>✍️ :</b> " . ($_POST['theme'] ?? '') . "\r\n";
		$text .= "<b>🗒 :</b> " . ($_POST['number'] ?? '') . "\r\n";
		$text .= "<b>🔥 :</b> " . ($_POST['deadline'] ?? '') . "\r\n";
		$text .= "<b>👣 :</b> " . ($this->fc_source ?? '') . "\r\n";
		$text .= "<b>🗃 :</b> " . $id . "\r\n";
		$text .= "<b>⌚️ :</b> " . date('d.m.Y H:i:s') . "\r\n\n";
		$text .= "{$this->score} \r\n";
		// $text .= "<a href='https://akademily.de/wp-admin/post.php?post=" . $id . "&action=edit'><b>Клац</b></a>";

		$data = [
			'parse_mode' => 'html',
			'chat_id' => TG_CHAT_ID,
			'text' => $text
		];
		$response = json_decode(file_get_contents("https://api.telegram.org/bot" . TG_TOKEN . "/sendMessage?" . http_build_query($data)));
		return $response;
	}

	public function sendFileToTG ($id)
	{
		// Проверка на наличие файла
		if ($_FILES['file']['name'] !== '') {
			$uploaddir = '../../loads/' . $id . '/';
			// Проверка на существование директории
			if (!file_exists($uploaddir)) {
				mkdir($uploaddir, 0777, true);
			}
			// Загрузка
			$uploadfile = $uploaddir . basename($_FILES['file']['name']);
			if (is_uploaded_file($_FILES['file']['tmp_name']) && move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
				$data = [
					'chat_id' => TG_CHAT_ID,
					'caption' => "🗃 : " . $id,
					'document' => new CURLFile($uploadfile)
				];

				$ch = curl_init("https://api.telegram.org/bot" . TG_TOKEN . "/sendDocument");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

				$response = curl_exec($ch);
				$resDec = json_decode($response);
				if ($resDec === true || $resDec === null) {
					$resDec = (object) [
						'ok' => false,
						'status' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
						'error' => curl_error($ch),
						'res' => $response,
					];
				} else {
					$resDec = json_decode($response);
					$resDec->ok = true;
					$resDec->status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				}

				curl_close($ch);
				return $resDec;
			}
		}
	}

	public function sendMail ($to, $name = '', $subj = 'Notification', $msg = 'Form sent', $file = false)
	{
		$mail = new PHPMailer(true);
		try {
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
			$mail->isSMTP(); //Send using SMTP
			$mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
			$mail->SMTPAuth = true; //Enable SMTP authentication
			$mail->Username = MAIL_BOT_ADDRESS; //SMTP username
			$mail->Password = MAIL_BOT_PASSWORD; //SMTP password
			$mail->SMTPSecure = 'ssl'; //Enable implicit TLS encryption
			$mail->CharSet = "utf-8";
			$mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			$mail->setFrom(MAIL_BOT_ADDRESS, 'UG-GWC.de');
			$mail->addAddress($to, $name);
			//  $mail->addAddress('ellen@example.com');               //Name is optional
			//  $mail->addReplyTo('info@example.com', 'Information');
			//  $mail->addCC('cc@example.com');
			//  $mail->addBCC('bcc@example.com');
			if ($file !== false) {
				$mail->addAttachment(PATH . 'assets/docs/Warum wählt man uns.pdf');         //Add attachments
			}
			$mail->isHTML(true);
			$mail->Subject = $subj;
			$mail->Body = $msg;

			$mail->send();
			$response = new stdClass();
			$response->ok = true;
			$response->message = 'Email sent successfully';
		} catch (Exception $e) {
			$response = new stdClass();
			$response->ok = false;
			$response->message = $e->getMessage();
		}
		return $response;
	}

	public function sendToClient ($id)
	{
		$sbjForClient = 'Vielen Dank, dass Sie sich für Ghost Writer Company entschieden haben!';
		$messForClient = '<p><strong>Hallo! Vielen Dank, dass Sie sich für Ghost Writer Company entschieden haben!</strong></p>
		<p>Wir haben Ihre Anfrage erhalten und prüfen sie derzeit. Sobald wir alle Ihre Anforderungen geprüft haben, wird sich Ihr persönlicher Manager mit Ihnen in Verbindung setzen. Wenn Sie vor 18:00 Uhr eine Anfrage gesendet haben, wird sich Ihr persönlicher Manager innerhalb von 15 Minuten mit Ihnen in Verbindung setzen. Wenn nach 18.00 Uhr, dann am nächsten Tag morgens.</p>
		<p style="text-align: center;"><strong>Ihre Anfragenummer:' . $id . '</strong></p>
		<br>
		<p><strong>Wenn Sie keine E-Mail erhalten haben, überprüfen Sie bitte Ihren Spam-Ordner und markieren Sie unsere E-Mail als „Kein Spam“.</strong></p>
		<p style="text-decoration: underline;">Wenn Sie unser neuer Kunde sind oder zum ersten Mal die Hilfe eines Ghostwriters in Anspruch nehmen, finden Sie unten eine kurze Beschreibung unserer Arbeitsweise:</p>
		<ol>
			<li aria-level="1">Ihr persönlicher Manager wird sich in jeder genehmen Weise mit Ihnen in Verbindung setzen, um die Wünsche und Anforderungen betreffs Ihres Antrags zu präzisieren.</li>
			<li aria-level="1">Nachdem der Manager Sie mit den Bedingungen, Garantien, unseren Autoren bekannt macht und alle Ihre Fragen beantwortet, werden Sie ein unverbindliches Angebot erhalten.</li>
			<li aria-level="1">Wenn Sie unser Angebot annehmen, erstellt der Manager eine Rechnung zur Zahlung und sendet diese Ihnen zusammen mit einem Rechnungsanhang zu. Dieses Dokument gilt als ein offizieller Vertrag zwischen dem Auftraggeber und dem Auftragnehmer, wo die wesentlichen Auftragsbedingungen festgelegt sind, und zwar: Art der Arbeit, Thema der Arbeit, Anzahl der Seiten/Stunden, Termin, zusätzliche Anforderungen/Wünsche sowie Pflichten von den Parteien.</li>
			<li aria-level="1">Nach Eingang der Zahlung/Vorauszahlung wird der Autor mit Ihrer Arbeit beauftragt. Bevor es losgeht, klären unsere Autoren noch einmal ab, ob alle Informationen vom Kunden erhalten sind und prüfen alles sorgfältig.</li>
			<li aria-level="1">Im Laufe des Arbeitsprozess erhalten Sie auf Wunsch Teile des schon geschriebenen Textes, um die Qualität der Arbeit selbständig zu überprüfen und sicherzustellen, dass alles gut läuft. Wir möchten, dass Sie ruhig warten und uns vertrauen. Wenn Sie die Arbeit etwas korrigieren möchten, berücksichtigen unsere Autoren Ihre Bemerkungen und Kommentare, das ist eine normale Praxis.</li>
			<li aria-level="1">Sobald die Arbeit vollendet ist, wird sie der Qualitätskontrolle, dem Korrekturlesen und Lektorat unterzogen sowie auf Plagiat überprüft. Sie erhalten zusammen mit der fertigen Arbeit auch einen kostenlosen Einzigartigkeitsbericht.</li>
			<li aria-level="1">Nach der Abgabe der fertigen Arbeit besteht die Garantie auf kostenlose Korrekturen. Wenn Sie plötzlich etwas korrigieren möchten, erledigen wir das völlig kostenlos für Sie.</li>
		</ol>
		<br>
		<p>Während der Erstellung Ihrer Arbeit stehen Ihnen 2 persönliche Betreuer zur Seite, die mit Ihnen in Kontakt bleiben, gerne alle Ihre Fragen beantworten und Sie über den aktuellen Stand Ihrer Bestellung informieren.</p>
		<p>Wenn Sie eine dringende Frage haben, kontaktieren Sie uns bitte auf eine der folgenden Arten:</p>
		<br>
		<p>Email: <a href="mailto:info@ug-gwc.de">info@ug-gwc.de</a></p>
		<p>WhatsApp: <a href="https://wa.me/493046690297">493046690297</a></p>
		<p>Festnetz: <a href="tel:+493046690330">+49(304)669-03-30</a></p>
		<p style="text-align: center;"><em>Mit freundlichen Grüßen, Ihr Team von Ghost Writer Company</em></p>';

		$response = $this->sendMail($_POST['email'], $_POST['name'], $sbjForClient, $messForClient, false);
		return $response;
	}

	public function sendWapp ()
	{
		$channel = json_decode(stripslashes($_COOKIE['fc_utm']))->utm_channel;
		$clientGeo = $this->getGeo();
		date_default_timezone_set('Europe/Minsk');
		$clickTime = new DateTime();

		$text = "<b>UG-GWC.de WhatsApp клик 🥸</b>\r\n\n";
		$text .= "<b>👣 : {$channel}</b>\r\n";
		$text .= "<b>📱 : {$clientGeo->ip}</b>\r\n\n";
		$text .= "<b>🌐 : {$clientGeo->country_name}</b>\r\n";
		$text .= "<b>🏠 : {$clientGeo->region}</b>\r\n";
		$text .= "<b>⌚️ : {$clickTime->format('Y-m-d H:i:s')}</b>";

		$data = [
			'parse_mode' => 'html',
			'chat_id' => TG_CHANNEL_ID,
			'text' => $text
		];
		$res = file_get_contents("https://api.telegram.org/bot" . TG_TOKEN . "/sendMessage?" . http_build_query($data));
		return $res;
	}

	public function getGeo ()
	{
		$client_ip = $_SERVER['REMOTE_ADDR'];
		// проверка для локалки
		// $client_ip = '84.244.8.172';

		$api = 'https://json.geoiplookup.io/' . $client_ip;

		$ch = curl_init($api);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($response);

		$geo = (object) [
			'ip' => $response->ip,
			'country_name' => $response->country_name,
			'region' => $response->region,
		];
		return $geo;
	}

	public function getChannel ($ch)
	{
		if ($ch == 'cpc') {
			return 'K';
		} elseif ($ch == 'direct') {
			return 'D';
		} elseif ($ch == 'media') {
			return 'M';
		} else {
			if (isset($_GET['utm_source'])) {
				return 'K';
			} else {
				return 'O';
			}
		}
	}

	public function getTitle ($ch)
	{
		if ($ch == 'cpc') {
			return 'Новая заявка! 💰';
		} elseif ($ch == 'direct') {
			return 'Новая заявка! 💫';
		} elseif ($ch == 'media') {
			return 'Новая заявка! 🤩';
		} else {
			return 'Новая заявка! 🤑';
		}
	}

	public function getSubject ($ch)
	{
		$title = sprintf(
			'%s | %s | %s',
			$ch,
			Helpers::urlPath(),
			$this->formNameFromID()
		);
		$this->postMeta['subject'] = $title;
		return $title;
	}

	public function formNameFromID (): string
	{
		$formArr = array(
			'form-author' => 'Форма авторов',
			'form-big' => 'Большая форма',
			'form-medium' => 'Средняя форма',
			'form-first' => 'Форма 1 экран',
			'form-small' => 'Малая форма',
			'form-care' => 'Форма заботы',
			'form-popup' => 'Форма попап',
			'form-bigpromo' => 'Форма промо',
		);

		if (!empty($_POST['form-id']) && array_key_exists($_POST['form-id'], $formArr)) {
			return $formArr[$_POST['form-id']];
		} else {
			return 'Форма без ID';
		}
	}

	public function postMetaCookies ()
	{
		foreach ($_COOKIE as $key => $value) {
			if (
				in_array($key, [
					'browser',
					'cookieCook',
					'fc_page',
					'lc_page',
					'gift',
					'is_mobile',
					'os',
					'refer',
					'time_passed',
					'user_agent',
				])
			) {
				$this->postMeta[$key] = $value;
			}
		}
	}

	public function postMetaGeo ()
	{
		$clientGeo = $this->getGeo();
		if (isset($clientGeo)) {
			foreach ($clientGeo as $key => $value) {
				$this->postMeta[$key] = $value;
			}
		}
	}

	public function postMetaUtm ()
	{
		if (isset($_COOKIE['fc_utm'])) {
			$decCookie = json_decode(stripslashes($_COOKIE['fc_utm'])); //Декодируем JSON из кук
			foreach ($decCookie as $key => $value) {
				if ($key == 'utm_source') {
					$this->fc_source = $value;
				}
				$this->postMeta[$key] = $value;
			}
		} elseif (isset($_GET['utm_source'])) {
			$this->fc_source = $_GET['utm_source'] . ' (из GET)';
			$this->postMeta['utm_source'] = $_GET['utm_source'] . ' (из GET)';
		}
	}
}

new Ajax();
