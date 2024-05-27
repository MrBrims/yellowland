<?php
$startIndex = $_GET["startIndex"];

// выполнить выборку данных с начального индекса и вернуть результаты в формате HTML
$resultsHtml = "<ul>";
$data = array("Результат 1", "Результат 2", "Результат 3", "Результат 4","Результат 5","Результат 6","Результат 7","Результат 8", "Результат n");
for ($i = $startIndex; $i < ($startIndex + 5); $i++) {
  $resultsHtml .= "<li>" . $data[$i] . "</li>";
}
$resultsHtml .= "</ul>";

echo $resultsHtml;
