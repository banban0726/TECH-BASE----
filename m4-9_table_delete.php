<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-9</title>
</head>
<body>
    <?php
        $dsn = 'mysql:dbname=tb250018db;host=localhost';
        $user = 'tb-250018';
        $password = 'xAvbNEgA7D';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = 'DROP TABLE tbtest';
        $stmt = $pdo->query($sql);
        echo "テーブルを削除しました"
    ?>
</body>
</html>