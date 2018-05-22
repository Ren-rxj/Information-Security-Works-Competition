<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link href="./css/result.css" rel="stylesheet">
<link href="../fontawesome/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
<title>Content-Type字段校验的文件上传漏洞</title>
</head>
<body>
<a href='../index.html' style='position:absolute;top:20px;left:20px;text-decoration:none;color:white;'><i class='fas fa-home' style='font-size:20px;'></i>&#160Home</a>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<h1>文件上传测试(文件头 content-type 字段校验) </h1>
<?php
//var_dump($_FILES['file']);
//echo "<br />";
$filename = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];
$error = $_FILES['file']['error'];
$type = $_FILES['file']['type'];
if($type != "image/png" && $type != "image/gif" && $type != "image/bmp" && $type != "image/jpeg" && $type != "image/pjpeg" && $type != "image/x-png"){
	echo "<p>请选择正确类型的文件!</p>";
	echo "<a href='2.html'><i class='fas fa-undo'></i>&#160重新上传</a>";
	exit;
}
//$des_addr = "../uploads";
$des_addr = "./upload/".$filename;
//copy($tmp_name,$des_addr);
move_uploaded_file($tmp_name,$des_addr);
if ($error == 0 ){
		echo "<h2>上传成功</h2>";
		echo "<img src = $des_addr alt='图片无法显示'/> ";
		echo "<p><a href='3.html'>下一关&#160<i class='fas fa-arrow-right'></i></a></p>";
}
else{
	echo "<h2>上传失败</h2>";
	echo "<a href='2.html'><i class='fas fa-undo'></i>&#160重新上传</a>";
}

?>
</body>
</html>
