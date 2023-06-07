<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-3</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前を入力してください">
        <input type="text" name="comment" placeholder="コメント">
        <input type="submit" name="submit">
        <input type="number" name="delete" placeholder="削除対象番号">
        <button>削除</button>
    </form>
    
    <?php
        $filename = "mission_3-3.txt";
        if(!empty($_POST["name"]) && !empty($_POST["comment"])){
            if(file_exists($filename)){
                $lines = file($filename,FILE_IGNORE_NEW_LINES);
                $count = 1;
                foreach($lines as $line){
                    $count++;
                }
            }
            else{
                $count = 1;
            }
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            $date = date("Y/m/d/h:i:s");
            $fp = fopen($filename,"a");
            fwrite($fp,$count."<>".$name."<>".$comment."<>".$date.PHP_EOL);
            fclose($fp);
            //echo $count . $name . $comment . $date . "を受け付けました<br>";
        }
        
        elseif(!empty($_POST["delete"])){
            $delete = $_POST["delete"];
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            $fp = fopen($filename,"w");
            foreach($lines as $item){
                //echo $item."<br>";
                $pieces = explode("<>", $item);
                //echo $pieces[0]."<br>";
                if($pieces[0] != $delete){
                    fwrite($fp,$item.PHP_EOL);
                }
            }
            fclose($fp);
        }
        
        if(file_exists($filename)){
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                echo $line."<br>";
            }
        }
    ?>
</body>
</html>