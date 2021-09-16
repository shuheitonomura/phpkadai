<?php

//var_dump($_POST);
//exit();

$join = $_POST["join"];


$write_data = "{$join}\n";

$file = fopen('data/data.csv', 'a');
// ファイルをロックする
flock($file, LOCK_EX);
fwrite($file, $write_data);
// ファイルのロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);
// データ入力画面に移動する
header("Location:todo_txt_input.php");

