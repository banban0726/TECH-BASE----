<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-4</title>
</head>
<body>
    <?php
        $filename = "mission_3-4.txt";
        if(!empty($_POST["name"]) && !empty($_POST["comment"])){
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            $date = date("Y/m/d/h:i:s");
            if(file_exists($filename)){
                $lines = file($filename,FILE_IGNORE_NEW_LINES);
                foreach($lines as $line){
                    $pieces = explode("<>", $line);
                    $count = $pieces[0] + 1;
                }
            }
            else{
                $count = 1;
            }
            
            if(!empty($_POST["edit_number"])){
                $edit_number = $_POST["edit_number"];
                $fp = fopen($filename, "w");
                foreach($lines as $line){
                    $pieces = explode("<>", $line);
                    if($line[0] == $edit_number){
                        fwrite($fp,$edit_number."<>".$name."<>".$comment."<>".$date.PHP_EOL);
                    }
                    
                    else{
                        fwrite($fp,$line.PHP_EOL);
                    }
                }
                
                fclose($fp);
                echo $edit_number . $name . $comment . $date . "を更新しました<br>";
            }
            
            else{
                $fp = fopen($filename,"a");
                fwrite($fp,$count."<>".$name."<>".$comment."<>".$date.PHP_EOL);
                fclose($fp);
                echo $count . $name . $comment . $date . "を受け付けました<br>";
            }
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
        
        elseif(!empty($_POST["edit"])){
            $edit = $_POST["edit"];
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $item){
                //echo $item."<br>";
                $pieces = explode("<>", $item);
                //echo $pieces[0]."<br>";
                if($pieces[0] == $edit){
                    $edit_name = $pieces[1];
                    $edit_comment = $pieces[2];
                }
            }
        }
    ?>
    
    <form action="" method="post">
        <input type="name" name="name" placeholder="名前を入力してください" value="<?php if(isset($edit_name)){echo $edit_name;}?>">
        <input type="text" name="comment" placeholder="コメント" value="<?php if(isset($edit_comment)){echo $edit_comment;}?>">
        <input type="hidden" name="edit_number" value="<?php if(isset($edit)) {echo $edit; }?>">
        <input type="submit" name="submit">
        <input type="number" name="delete" placeholder="削除対象番号">
        <button>削除</button>
        <input type="number" name="edit" placeholder="編集対象番号">
        <button>編集</button>
    </form>
    
    <?php
        if(file_exists($filename)){
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                $pieces = explode("<>", $line);
                echo $line."<br>";
            }
        }
    ?>
</body>
</html>