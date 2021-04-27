<?php
//  Змінні вартості для входу в MySQL
$host = "localhost";
$login = "kryst104_krystyn";
$pass = "0XjKWzcYfapLe2JQ";
$dbase = "krystynopil";


// Підключення до бази
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbase;charset=utf8", $login, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Вибачте, виникли не передюачувані труднощі!";
    echo $e->getMessage();
}

//URL адрес
$URL = "http://localhost/Krystynopil/";