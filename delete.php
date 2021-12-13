<?php
$file = file('data.csv');
unset($file[$_GET['index']]);
file_put_contents('data.csv', implode('', $file));
header('Location: ./list.php');
?>