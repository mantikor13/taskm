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
    if($_POST['regular']){
        $count = 5;
        $regular = true;
    }else{
        $count = 1;
        $regular = false;
    }


    $query ="INSERT INTO tasks (title, author, count, regular) VALUES ('" . $title . "', '" . $author . "', '" . $count . "', '" . $regular . "')";

    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        echo "Выполнение запроса прошло успешно";
    };
};

if($_POST['target'] == 'getTasks'){

    $all = $_POST['all'];

    if($all == false){
        $query = "SELECT * FROM `tasks` WHERE done IS NULL";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

        $record = mysqli_fetch_all($result);

        $data = json_encode($record);
    }

    echo $data;

}

if($_POST['target'] == 'getPoints'){

    $query2 = "SELECT `count` FROM `points` WHERE count > 0";
    $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));

    $record2 = mysqli_fetch_all($result2);

    $data2 = json_encode($record2);
    echo $data2;

}

if($_POST['target'] == 'addPoint'){

    $id = $_POST['id'];
    $count = $_POST['count'];
    $done = $_POST['done'];

    if($done){
        $count = 0;
        $query ="INSERT INTO points (task_id, count, done) VALUES ('" . $id . "', '" . $count . "', '" . $done . "')";
        $query2 ="UPDATE tasks SET done='true' WHERE id='" . $id . "'";

        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));

        echo "задание завершенно";
    }else{
        $query ="INSERT INTO points (task_id, count) VALUES ('" . $id . "', '" . $count . "')";

        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

        echo "балл добавлен";
    }

}





// закрываем подключение
mysqli_close($link);

