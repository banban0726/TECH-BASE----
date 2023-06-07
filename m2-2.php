<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-2</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str" value="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
        $filename = "mission_2-2.txt";
        if(!empty($_POST["str"])){
            $str = $_POST["str"];
            $fp = fopen($filename,"w");
            fwrite($fp,$str);
            fclose($fp);
            echo $str . "を受け付けました";
        }
    ?>
</body>
</html>