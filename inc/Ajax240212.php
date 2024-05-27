<?php

namespace DE;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/PHPMailer.php';

class Ajax
{
  const USERNAME = 'restapiuser';
  const PASSWORD = 'O$4ak3wvZWj#mi)JS2$hBRJl';
  const REST_API = 'https://akademily.de/wp-json/wp/v2/requests';

  public function __construct()
  {
    add_action('wp_ajax_sendForm', [$this, 'mailer']);
    add_action('wp_ajax_nopriv_sendForm', [$this, 'mailer']);
  }

  public function mailer()
  {
    if (empty($_POST)) {
      wp_send_json_error();
    }

    $score = 'Рейтинг неизвестен';
    if (!empty($_POST['recaptcha_response'])) {
      $url = 'https://www.google.com/recaptcha/api/siteverify';
      $key = '6Ldp8tIiAAAAADuOY2dy6CA4WSILnyCPMBjh4ccr'; 
      $recaptcha = $_POST['recaptcha_response'];

      $recaptcha = file_get_contents($url . '?secret=' . $key . '&response=' . $recaptcha);
      $recaptcha = json_decode($recaptcha);

      $score = 'Проверено на спам, рейтинг: ' . $recaptcha->score;
      if ($recaptcha->score < 0.5) {
        $score = 'Возможно спам, рейтинг: ' . $recaptcha->score;
      }
    }

    $subject = sprintf(
      '%s | %s',
      Helpers::sitePermalink(),
      // Helpers::siteUri(),
      // get_bloginfo('name'),
      Helpers::siteFormName($_POST['form-id']),
    );

    $message = '';
    foreach ($_POST as $key => $value) {
      if (in_array($key, ['form-id', 'action', 'recaptcha_response'])) {
        continue;
      }

      $string = (is_array($value)) ? implode(', ', $value) : $value;
      $message .= sprintf('<p>%s : %s </p>', ucfirst($key), $string);
    }
    $message .= sprintf('<p>%s</p>', $score);

    // if (isset($_COOKIE['getParam'])) {
    //   $decCookie = json_decode(stripslashes($_COOKIE['getParam'])); //Декодируем JSON из кук
    //   foreach ($decCookie as $key => $value) {
    //     $string = (is_array($value)) ? implode(', ', $value) : $value;  //Преобразование
    //     $message .= sprintf('<p>%s : %s</p>', ucfirst($key), $string); //Вывод
    //   }
    // }

    $id = $this->sendDataToAkademily($subject, $message);

    $this->sendDataToTelegram($id, $subject, $score);

    $this->sendToClient();

    wp_send_json_success();
  }

  private function sendDataToAkademily($subject, $message): int
  {
    $dataString = json_encode([
      'title' => $subject,
      'content' => $message,
      'status' => 'publish'
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, self::REST_API);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json',
      'Content-Length: ' . strlen($dataString),
      'Authorization: Basic ' . base64_encode(self::USERNAME . ':' . self::PASSWORD),
    ]);

    $result = curl_exec($ch);
    $response = json_decode($result, true);

    curl_close($ch);

    return $response['id'];
  }

  private function sendDataToTelegram($id, $subject, $permalink)
  {
    $token = '6514367409:AAEBTkzQ4pGN1HuVsvxLZjIICfJQOFqDleU';

    $text = "<b>Новая заявка! 🤩</b> \r\n\n";
    $text .= "{$subject}\r\n\n";
		$text .= "<b>🥸 :</b> " . $_POST['name'] . "\r\n";
		$text .= "<b>📨 :</b> " . $_POST['email'] . "\r\n";
		$text .= "<b>📌 :</b> " . $_POST['type'] . "\r\n";
		$text .= "<b>📎 :</b> " . $_POST['specialization'] . "\r\n";
		$text .= "<b>✍️ :</b> " . $_POST['theme'] . "\r\n";
		$text .= "<b>🗒 :</b> " . $_POST['number'] . "\r\n";
		$text .= "<b>🔥 :</b> " . $_POST['deadline'] . "\r\n";
		$text .= "<b>👣 :</b> " . $_POST['utm_source'] . "\r\n";
		$text .= "<b>🗃 :</b> " . $id . "\r\n\n";
    $text .= "<a href='https://akademily.de/wp-admin/post.php?post=" . $id . "&action=edit'><b>Перейти к заявке</b></a>\r\n";

    $data = [
      'parse_mode' => 'html',
      'chat_id' => '-1001199768955',
      'text' => $text
    ];

    file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?" . http_build_query($data));
  }

  private function sendToClient ()
	{
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
			$mail->isSMTP(); //Send using SMTP
			$mail->Host = 'smtp.dreamhost.com'; //Set the SMTP server to send through
			$mail->SMTPAuth = true; //Enable SMTP authentication
			$mail->Username = 'kommunikation@ug-gwc.de'; //SMTP username
			$mail->Password = 'ZrdRUvWHYsmTrB2'; //SMTP password
			$mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
			$mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
			$mail->CharSet = "utf-8";

			//Recipients
			$mail->setFrom('kommunikation@ug-gwc.de', 'UG-GWC.de');
			$mail->addAddress($_POST['email'], $_POST['name']); //Add a recipient
			//  $mail->addAddress('ellen@example.com');               //Name is optional
			//  $mail->addReplyTo('info@example.com', 'Information');
			//  $mail->addCC('cc@example.com');
			//  $mail->addBCC('bcc@example.com');

			//Attachments
			//  $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			//  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
			$sbjForClient = 'Vielen Dank, dass Sie sich für Ghost Writer Company entschieden haben!';
			$messForClient = '<p>Hallo! Vielen Dank, dass Sie sich für Ghost Writer Company entschieden haben!</p>
			<br>
			<p>Wir haben Ihre Anfrage erhalten und prüfen sie derzeit. Sobald wir alle Ihre Anforderungen geprüft haben, wird sich Ihr persönlicher Manager mit Ihnen in Verbindung setzen. Wenn Sie vor 18:00 Uhr eine Anfrage gesendet haben, wird sich Ihr persönlicher Manager innerhalb von 15 Minuten mit Ihnen in Verbindung setzen. Wenn nach 18.00 Uhr, dann am nächsten Tag morgens.</p>
			<br>
			<p><b>Wenn Sie keine E-Mail erhalten haben, überprüfen Sie bitte Ihren Spam-Ordner und markieren Sie unsere E-Mail als „Kein Spam“.</b></p>
			<br>
			<p>Wenn Sie unser neuer Kunde sind oder zum ersten Mal die Hilfe eines Ghostwriters in Anspruch nehmen, finden Sie unten eine kurze Beschreibung unserer Arbeitsweise:</p>
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
			<p>Email: info@ug-gwc.de</p>
			<br>
			<p>WhatsApp: 4930 4669-02-97</p>
			<p>Festnetz: 4930 2238-98-44</p>
			<p>Mit freundlichen Grüßen, Ihr Team von Ghost Writer Company</p>';
			//Content
			$mail->isHTML(true); //Set email format to HTML
			$mail->Subject = $sbjForClient;
			$mail->Body = $messForClient;
			//  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
		return true;
	}
}

new Ajax();