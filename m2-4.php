<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-4</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str" value="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
        $filename = "mission_2-4.txt";
        if(!empty($_POST["str"])){
            $str = $_POST["str"];
            $fp = fopen($filename,"a");
            fwrite($fp,$str.PHP_EOL);
            fclose($fp);
            echo $str . "を受け付けました<br>";
            
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                 echo $line . "<br>";
            }
        }

    ?>
</body>
</html>