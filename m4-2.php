<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-2</title>
</head>
<body>
    <?php
        $dsn = 'mysql:dbname=tb250018db;host=localhost';
        $user = 'tb-250018';
        $password = 'xAvbNEgA7D';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = "CREATE TABLE IF NOT EXISTS tbtest"
        ." ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name char(32),"
        . "comment TEXT"
        .");";
        $stmt = $pdo->query($sql);
    ?>
</body>
</html>