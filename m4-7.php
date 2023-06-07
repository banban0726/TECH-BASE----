<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_4-7</title>
</head>
<body>
    <?php
        $dsn = 'mysql:dbname=tb250018db;host=localhost';
        $user = 'tb-250018';
        $password = 'xAvbNEgA7D';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $id = 1; //変更する投稿番号
        $name = "バンバン";
        $comment = "万事解決"; //変更したい名前、変更したいコメントは自分で決めること
        $sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    ?>
</body>
</html>