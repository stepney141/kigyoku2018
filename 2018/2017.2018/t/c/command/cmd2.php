<?php
session_start();
//インクルード
//require_once('./twitteroauth.php');
//$sConsumerKey = "";
//$sConsumerSecret = "";
//$sAccessToken = "";
//$sAccessTokenSecret = "";
//$twObj = new TwitterOAuth($sConsumerKey,$sConsumerSecret,$sAccessToken,$sAccessTokenSecret);

mb_language("ja");
mb_internal_encoding("UTF-8");

$filename = "../ticket.txt";

$old_data = file_get_contents($filename);
$old_data_array = explode(',',$old_data);

echo '＊下に入力した内容がそのままHPに反映される。<br>';
echo '<form action="cmd.php" method="POST">';
if(isset($_POST["hidden"])) {
    echo "<table>";
    echo "<tr><td>焼きそば:</td><td><input type='text' name='t0' value='$_POST[t0]'></td></tr>";
    echo "<tr><td>わたあめ:</td><td><input type='text' name='t1' value='$_POST[t1]'></td></tr>";
    echo "<tr><td>焼き鳥:</td><td><input type='text' name='t2' value='$_POST[t2]'></td></tr>";
    echo "<tr><td>フランクフルト:</td><td><input type='text' name='t3' value='$_POST[t3] '></td></tr>";
    echo "<tr><td>ポップコーン:</td><td><input type='text' name='t4' value='$_POST[t4] '></td></tr>";
    echo "<tr><td>ドリンク(販売部門):</td><td><input type='text' name='t5' value='$_POST[t5] '></td></tr>";
    echo "<tr><td>カレーライス:</td><td><input type='text' name='t6' value='$_POST[t6] '></td></tr>";
    echo "<tr><td>中華まん:</td><td><input type='text' name='t7' value='$_POST[t7] '></td></tr>";
    echo "<tr><td>チュロス:</td><td><input type='text' name='t8' value='$_POST[t8] '></td></tr>";
    echo "<tr><td>ワッフル:</td><td><input type='text' name='t9' value='$_POST[t9] '></td></tr>";
    echo "<tr><td>ポテト:</td><td><input type='text' name='t10' value='$_POST[t10] '></td></tr>";
    echo "<tr><td>アイス:</td><td><input type='text' name='t11' value='$_POST[t11] '></td></tr>";
    echo "<tr><td>ドリンク(喫茶部門):</td><td><input type='text' name='t12' value='$_POST[t12]></tr>";
    echo "<tr><td>ラーメン:</td><td><input type='text' name='t13' value='$_POST[t13] '></td></tr>";
    echo "<tr><td>チキン南蛮丼:</td><td><input type='text' name='t14' value='$_POST[t14] '></td></tr>";
    echo "<tr><td>パン:</td><td><input type='text' name='t15' value='$_POST[t15] '></td></tr>";
    echo "</table>";
} else {
    echo "<table>";
    echo "<tr><td>焼きそば:</td><td><input type='text' name='t0' value='$old_data_array[0]'></td></tr>";
    echo "<tr><td>わたあめ:</td><td><input type='text' name='t1' value='$old_data_array[1]'></td></tr>";
    echo "<tr><td>焼き鳥:</td><td><input type='text' name='t2' value='$old_data_array[2]'></td></tr>";
    echo "<tr><td>フランクフルト:</td><td><input type='text' name='t3' value='$old_data_array[3]'></td></tr>";
    echo "<tr><td>ポップコーン:</td><td><input type='text' name='t4' value='$old_data_array[4]'></td></tr>";
    echo "<tr><td>ドリンク(販売部門):</td><td><input type='text' name='t5' value='$old_data_array[5]'></td></tr>";
    echo "<tr><td>カレーライス:</td><td><input type='text' name='t6' value='$old_data_array[6]'></td></tr>";
    echo "<tr><td>中華まん:</td><td><input type='text' name='t7' value='$old_data_array[7]'></td></tr>";
    echo "<tr><td>チュロス:</td><td><input type='text' name='t8' value='$old_data_array[8]'></td></tr>";
    echo "<tr><td>ワッフル:</td><td><input type='text' name='t9' value='$old_data_array[9]'></td></tr>";
    echo "<tr><td>ポテト:</td><td><input type='text' name='t10' value='$old_data_array[10]'></td></tr>";
    echo "<tr><td>アイス:</td><td><input type='text' name='t11' value='$old_data_array[11]'></td></tr>";
    echo "<tr><td>ドリンク(喫茶部門):</td><td><input type='text' name='t12' value='$old_data_array[12]'></td></tr>";
    echo "<tr><td>ラーメン:</td><td><input type='text' name='t13' value='$old_data_array[13]'></td></tr>";
    echo "<tr><td>チキン南蛮丼:</td><td><input type='text' name='t14' value='$old_data_array[14]'></td></tr>";
    echo "<tr><td>パン:</td><td><input type='text' name='t15' value='$old_data_array[15]'></td></tr>";
    echo "</table>";
}
echo "<input type='hidden' name='hidden' value='post'> <br/><input type='submit' name='submit' value=' 実行 ' /> <br> </form>";

if(isset($_POST["hidden"])) {
    echo '<hr>';

    unlink($filename);
    $fp = fopen($filename, "a");
    $write_text = $_POST['t0'].','.$_POST['t1'].','.$_POST['t2'].','.$_POST['t3'].','.$_POST['t4'].','.$_POST['t5'].','.$_POST['t6'].','.$_POST['t7'].','.$_POST['t8'].','.$_POST['t9'].','.$_POST['t10'].','.$_POST['t11'].','.$_POST['t12'].','.$_POST['t13'].','.$_POST['t14']','.$_POST['t15'];
    fwrite($fp, $write_text);
    fclose($fp);
}
?>
