<?php

$_POST = json_decode(file_get_contents('php://input'), true);

$host = 'localhost'; // адрес сервера
$database = 'taskm'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));

if($_POST['target'] == 'addTask'){

    $title = $_POST['title'];
    $author = $_POST['author'];
    $count = 5;

    $query ="INSERT INTO tasks (title, author, count) VALUES ('" . $title . "', '" . $author . "', '" . $count . "')";

    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        echo "Выполнение запроса прошло успешно";
    };
};

if($_POST['target'] == 'getTasks'){

    $query = "SELECT * FROM `tasks`";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

    $record = mysqli_fetch_all($result);

    $data = json_encode($record);
    echo $data;


}





// закрываем подключение
mysqli_close($link);

