<?php

// Предполагается, что:
// $post_id - ID поста, содержащего данные Carbon Fields
// $complex_field_key - ключ для извлечения сложного поля

// Извлекаем данные сложного поля
$field_data = get_field($complex_field_key, $post_id);

// Извлекаем первые пять элементов из массива данных сложного поля
$first_five_items = array_slice($field_data, 0, 5);

// Используем каждый элемент по мере необходимости
foreach ($first_five_items as $item) {
// Доступ к данным дочернего поля осуществляется с помощью обращения по ключу массива
$child_field_data = $item['child_field_key'];
// Обрабатываем и выводим данные дочернего поля по мере необходимости
}

foreach (carbon_get_theme_option('card-a') as $item) {
  echo $item['name-a'], $item['sear-a'];
}

?>

<?php foreach (carbon_get_theme_option('card-a') as $item) { ?>
  <?= $item['name-a']; ?> <?= $item['sear-a']; ?>
<?php } ?>