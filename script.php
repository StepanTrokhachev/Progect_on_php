<?php
if ($_POST) {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

//Открытие тестового файла
    $file = fopen('clients.csv', 'a+');

//Запись строки в файл
    fwrite($file, implode($_POST, ';') . PHP_EOL);

//Закрытие файла
    fclose($file);

// Добавление новой записи
    if($_POST && !isset($_GET['mode']) || $_GET['mode'] !== 'update'){
// Открытие тестового файла
        $file = fopen('clients.csv', 'a+');

// Запись строки в файл
        $dataToSave = implode(';', $_POST);
        fwrite($file, $dataToSave . PHP_EOL);

// Закрытие файла
        fclose($file);

        echo '<pre>';
        print_r($dataToSave);
        echo '</pre>';

    } else if (isset($_GET['mode']) && $_GET['mode'] === 'update') {
// Обновление уже существующей записи

        $file = fopen('clients.csv' , 'r');
        $items = [];

        while ($item = fgetcsv($file, 1000, ';')) {
            $items[] = $item;
        }

        fclose($file);
        unlink('clients.csv');

// Элемент, который нам нужно обновить в data.csv
        $items[$_GET['index']] = $_POST;

        $dataToUpdate = '';

        foreach ($items as $item) {
// Записываем наполнение файла data.csv
            $dataToUpdate .= implode($item, ';') . PHP_EOL;
        }

        file_put_contents('clients.csv', $dataToUpdate, LOCK_EX);
    }
// Добавление новой записи
    if($_POST && !isset($_GET['mode']) || $_GET['mode'] !== 'update'){
// Открытие тестового файла
        $file = fopen('data.csv', 'a+');

// Запись строки в файл
        $dataToSave = implode(';', $_POST);
        fwrite($file, $dataToSave . PHP_EOL);

// Закрытие файла
        fclose($file);

        echo '<pre>';
        print_r($dataToSave);
        echo '</pre>';

    } else if (isset($_GET['mode']) && $_GET['mode'] === 'update') {
// Обновление уже существующей записи

        $file = fopen('data.csv' , 'r');
        $items = [];

        while ($item = fgetcsv($file, 1000, ';')) {
            $items[] = $item;
        }

        fclose($file);
        unlink('data.csv');

// Элемент, который нам нужно обновить в data.csv
        $items[$_GET['index']] = $_POST;

        $dataToUpdate = '';

        foreach ($items as $item) {
// Записываем наполнение файла data.csv
            $dataToUpdate .= implode($item, ';') . PHP_EOL;
        }

        file_put_contents('data.csv', $dataToUpdate, LOCK_EX);
    }

// После записи данных файл, перенаправляем пользователя на страницу со списком (таблицей)
    if (file_exists('./list.php')) {
        header('Location: ./list.php');
    }

} else {
    echo 'Sorry, форма не заполнена';
}