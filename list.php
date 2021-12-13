<?php
$file = fopen('data.csv' , 'r');
$items = [];

while ($item = fgetcsv($file, 1000, ';')) {
    $items[] = $item;
}

echo '<table border=1>';
echo '<tr>';
echo '<th>Имя пользователя</th>';
echo '<th>Возраст</th>';
echo '<th>Должность</th>';
echo '<th>Комментарий</th>';
echo '</tr>';
foreach ($items as $key=>$item) {
    echo '<tr>';
    echo '<td>' . $item[0] . '</td>';
    echo '<td>' . $item[1] . '</td>';
    echo '<td>' . $item[2] . '</td>';
    echo '<td>' . $item[3] . '</td>';
    echo '<td><button onclick="location.href=\'index.php?mode=update&index='. $key .'\';">Обновить</button></td>';
    echo '<td><button onclick="location.href=\'list.php?mode=delete&index='. $key .'\';">Удалить</button></td>';


    echo '</tr>';
}
echo '</table>';