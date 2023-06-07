<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charrest="UTF-8">
    <title>mission_1-23</title>
</head>
<body>
    <?php
        $items = array("Ken","Alice","Judy","BOSS","Bob");
        foreach($items as $item){
            
            //echo $items[0]. "<br>";
            
            if($item == "BOSS"){
                echo "Good morning $item!<br>";
            }
            
            else{
                echo "hi! $item<br>";
            }
        }
    ?>
</body>