<?php


$dsn = 'データベース名';

$user = 'ユーザー名';

$password = 'パスワード';

$pdo = new PDO($dsn,$user,$password);

$sql = "CREATE TABLE bbs2"

	."("

	."number INT,"
	."name char(32),"
	."comment TEXT,"
	."time TEXT,"
	."pass TEXT"

	.");";

$stmt = $pdo->query($sql);


$comment =$_POST["comment"];

$name = $_POST["name"];

$time = $_POST["time"];

$sakuban = $_POST["sakuban"];

$henban = $_POST["henban"];

$hensyunum = $_POST["hensyunum"];

$pass = $_POST["pass"];

$pass1 = $_POST["pass1"];

$pass2 = $_POST["pass2"];

if(!empty($hensyunum)){
	$nm = $name;
	$kome = $comment;
	$sql = "update bbs2 set name='$nm',comment='$kome' where number = $hensyunum";
	$result = $pdo->query($sql);

}else{

if(!empty($comment)){

	$sql =$pdo->prepare("INSERT INTO bbs2 (number,name,comment,time,pass) VALUES(:number,:name,:comment,:time,:pass)");

		$sql -> bindParam(':number',$number,PDO::PARAM_STR);
		$sql -> bindParam(':name',$name,PDO::PARAM_STR);
		$sql -> bindParam(':comment',$comment,PDO::PARAM_STR);
		$sql -> bindParam(':time',$time,PDO::PARAM_STR);
		$sql -> bindParam(':pass',$pass,PDO::PARAM_STR);

		$next = 'SELECT MAX(number) FROM bbs2';
		$num = $pdo->query($next);	
		$count = 1;
		$result = $num->fetch();
                $number =$result[0] + $count;

	$sql ->execute();

	}
}

if(!empty($henban)){

	$sql = "SELECT*FROM bbs2 WHERE number = $henban";
	$hen = $pdo->query($sql);
	$del=$hen->fetch();

	if($del[4] == $pass2){

		$henname = $del[1];
		$hencoment = $del[2];
		$hensyuban = $del[0];
	
		
	}
}

if(!empty($sakuban)){

	$sql = "SELECT*FROM bbs2 WHERE number = $sakuban";
	$saku = $pdo->query($sql);
	$result = $saku->fetch();

	if($result[4] = $pass1){

		$sql = "delete from bbs2 where number =$sakuban";
		$result = $pdo->query($sql);

	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>mission4</title>
</head>
<body>
<h1>コメント入力フォーム</h1>

<?php
 
$hiduke= Date('Y年n月j日g時i分s秒'); 

?>

<form action ="mission_4.php" method = "post">
名前：<input type = "text" name = "name" value = <?php echo $henname?>><br/>
コメント：<input type ="text" name = "comment" value = <?php echo $hencoment?>><br/>
パスワード：<input type = "text" name = "pass">
<input type ="submit"  value ="送信"><br/><br/>

削除番号：<input type = "number" name = "sakuban"><br/>
パスワード：<input type = "text" name = "pass1">
<input type ="submit"  value ="削除"><br/><br/>

編集対象番号：<input type = "number" name = "henban"><br/>
パスワード：<input type = "text" name = "pass2">
<input type ="submit"  value ="編集">

<input type = "hidden" name = "hensyunum" value =<?php echo $hensyuban?>>
<input type ="hidden" name = "time" value ="<?php echo $hiduke; ?>">


</form>
</body>
</html>

<?php


$dsn = 'mysql:dbname=tt_341_99sv_coco_com;host=localhost';

$user = 'tt-341.99sv-coco';

$password = 'L7a6NnCU';

$pdo = new PDO($dsn,$user,$password);

$sql = 'SELECT*FROM bbs2 ORDER BY number';

$results = $pdo->query($sql);

foreach($results as $row){

	echo $row['number'].'<br>';
	echo $row['name'].'<br>';
	echo $row['comment'].'<br>';
	echo $row['time'].'<br>';

}

?>