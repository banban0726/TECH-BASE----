<!DOCUTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>おすすめスイーツ掲示板</title>
</head>
<body>
<h1>🍮おすすめのスイーツを教えてください🍮</h1>
<h5>※パスワードを忘れると削除・編集が出来ないので忘れないでね</h5>
    <?php
        $filename = "mission_3-5.txt";
        #最終行を取得する
        $file = file($filename, FILE_IGNORE_NEW_LINES);
        $last_line = array_pop($file);
        $last_item = explode("<>", $last_line);
        $last_num = $last_item[0];
        
        #特定の行を読み込む→$passwordにパスワードを代入する関数
        function get_targetLine($filename, $lineNum) 
        {
            $fp = fopen($filename, 'r');
            for ($i = 0; $i < $lineNum; $i++) 
            { 
                $targetLine = fgets($fp);
                echo $targetLine;
            }
            fclose($fp);
            $pass_item = explode("<>", $targetLine);
            $password = $pass_item[4];
            return trim($password);
        }
        #特定の行を読み込む→$passwordに投稿番号を代入する関数        
        function get_targetLine2($filename, $lineNum2) 
        {
            $fp = fopen($filename, 'r');
            for ($i = 0; $i < $lineNum2; $i++) 
            { 
                $targetLine2 = fgets($fp);
            }
            fclose($fp);
            $post_item = explode("<>", $targetLine2);
            $post = $post_item[0];
            return trim($post);
        }
        
        #投稿フォーム
        if (!empty ($_POST["name"]) && !empty ($_POST["str"]) && empty($_POST["editnum"])&& !empty($_POST["pass1"]))
        {
            $date = date("Y/m/d/H:i:s");
            $name = $_POST["name"];
            $str = $_POST["str"];
            $pass = $_POST["pass1"];
            if (file_exists($filename))
            {
                $count = (int)$last_num +1 ;#最終行から次の行を指摘
            }else{
                $count = 1;
            }
            $coment = $count. "<>". $name. "<>". $str.  "<>". $date;
            $coment_new = $count. "<>". $name. "<>". $str.  "<>". $date. "<>". $pass. "<>";#パスワード存在ver.
            $fp = fopen ($filename, "a");
            fwrite ($fp, $coment_new.PHP_EOL);
            fclose ($fp);
            $file = file ($filename, FILE_IGNORE_NEW_LINES);
            foreach ($file as $files)
            {
                $num = explode ("<>", $files);
                for ($i = 0; $i < count($num) - 2; $i ++)#-1でパスワードを非表示に
                {
                    echo $num[$i] ." ";
                }
                echo "<br>";
            }
        #削除フォーム    
        }elseif (!empty ($_POST["number"]) && !empty ($_POST["pass2"]) && get_targetLine($filename, $_POST["number"]) == $_POST["pass2"] && get_targetLine2($filename, $_POST["number"]) == $_POST["number"])
        {
            $number = $_POST["number"];
            $pass = $_POST["pass2"];
            $file = file ($filename, FILE_IGNORE_NEW_LINES);
            $post_pass = (get_targetLine($filename, $_POST["number"]));
            $post_post = (get_targetLine2($filename, $_POST["number"]));
            $fp = fopen ($filename, "w");
            foreach($file as $files)
            {
                $line = explode("<>", $files);
                $postnum = $line[0];
                if ($postnum != $number )
                { 
                    fwrite($fp, $files.PHP_EOL);
                    for ($j = 0; $j < count($line) -2; $j ++)
                    {
                        echo $line[$j]. " ";
                    }
                    echo "<br>";
                }
            }
            fclose ($fp);
         #消去フォームのパスワードが違う時のエラー表示
        }elseif (!empty ($_POST["number"]) && !empty ($_POST["pass2"]) && get_targetLine($filename, $_POST["number"]) != $_POST["pass2"] && get_targetLine2($filename, $_POST["number"]) == $_POST["number"])    
        {
            $number = $_POST["number"];
            $pass = $_POST["pass2"];            
             echo "パスワードがちがいます。入力し直してください。※ブラウザバックすると履歴のこっています";
         
         #編集フォーム    
         }elseif (!empty ($_POST["edit"]) && !empty ($_POST["pass3"]) && get_targetLine($filename, $_POST["edit"]) == $_POST["pass3"] && get_targetLine2($filename, $_POST["edit"]) == $_POST["edit"])
         {
             $edit = $_POST["edit"];
             $pass = $_POST["pass3"]; 
             $file = file ($filename, FILE_IGNORE_NEW_LINES);
             $fp = fopen ($filename, "a");
             foreach ($file as $file1)
             {
                 $line1 = explode("<>", $file1);
                 $editnum = $line1[0];
                 if ($editnum == $edit)
                 {
                     $newname = $line1[1];
                     $newcoment = $line1[2];
                     $newnum = $line1[0];    
                     
                 }
             }
         
         }elseif (!empty ($_POST["edit"]) && !empty ($_POST["pass3"]) && get_targetLine($filename, $_POST["edit"]) != $_POST["pass3"] && get_targetLine2($filename, $_POST["edit"]) == $_POST["edit"])
         {
             $edit = $_POST["edit"];
             $pass = $_POST["pass3"];            
             echo "パスワードがちがいます。入力し直してください。※ブラウザバックすると履歴のこっています";
         
         #新規コメントか編集コメントかの判定
         }elseif (!empty($_POST["name"]) && !empty($_POST["str"]) && !empty($_POST["editnum"])&& !empty($_POST["pass1"]))
         {
             $editnum = $_POST["editnum"];
             $name = $_POST["name"];
             $str = $_POST["str"];
             $date = date("Y/m/d/H:i:s");
             $pass = $_POST["pass1"];
             $file = file($filename, FILE_IGNORE_NEW_LINES);
             $fp = fopen($filename, "w");
             foreach($file as $file2)
             {
                 $editdata = explode("<>", $file2);
                 if($editdata[0] == $editnum)
                 {
                     fwrite($fp, $editnum."<>". $name. "<>". $str.  "<>". $date. "<>". $pass. "<>".PHP_EOL);
                 }else{
                     fwrite($fp,$file2.PHP_EOL);
                 }
             }
             fclose($fp);
             $file = file ($filename, FILE_IGNORE_NEW_LINES);
             foreach ($file as $files)
             {
                 $num = explode ("<>", $files);
                 for ($i = 0; $i < count($num) -2; $i ++)
                 {
                     echo $num[$i] ." ";
                 }
                 echo "<br>";
             } 
            
         #起動初期にこれまでの投稿内容を表示させる 
         }else{
         
             $file = file ($filename, FILE_IGNORE_NEW_LINES);
             foreach ($file as $files)
             {
                 $num = explode ("<>", $files);
                 for ($i = 0; $i < count($num) -2; $i ++)
                 {
                     echo $num[$i] ." ";
                 }
                 echo "<br>";
             }
         }
         
     ?>
     <br>
     =====================================================================================================
     <br>
     <table>
     <tr>
     <td align="left" valign="top"><form action = "" method = "post">
         <span style = "background-color:yellow">🖊投稿フォーム🖊<br></span>
         名前<br>
         <input type = "text" name = "name" placeholder = "名前" value = "<?php if(!empty($newname)){ echo $newname;}?>">
         <br>
         コメント<br>
         <input type = "text" name = "str" placeholder = "コメント" value = "<?php if(!empty($newcoment)){echo $newcoment;}?>">
         <br>パスワード<br>
         <input type = "text" name = "pass1" placeholder = "パスワードを入力">
         <input type = "hidden" name = "editnum" placeholder = "編集番号" value = "<?php if(!empty($newnum)){echo $newnum;}?>">        
         <input type = "submit" name = "submit">
     </form></td>
    
     <td>　</td>
     <td align="left" valign="top"><form action = "" method = "post">
         <span style = "background-color:yellow">🖊削除フォーム🖊<br></span>
         <input type = "number" name = "number" placeholder = "削除したい番号">
         <br>パスワード<br>
         <input type = "text" name = "pass2" placeholder = "パスワードを入力">        
         <input type = "submit" name = "del" value = "削除">
     </form></td>
     
     <td>　</td>
     <td align="left" valign="top"><form action = "" method = "post">
         <span style = "background-color:yellow">🖊編集フォーム🖊<br></span>
         <input type = "number" name = "edit" placeholder = "編集したい番号">
         <br>パスワード<br>
         <input type = "text" name = "pass3" placeholder = "パスワードを入力">     
         <input type = "submit" name = "edition" value = "編集">
     </form></td>
     </tr>
     </table>
 </body>
</html>