<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link href="./css/result.css" rel="stylesheet">
<title>服务端检测文件头的文件上传漏洞</title>
</head>
<body>
<h1>文件上传测试（服务端检测文件头) </h1>
<?php
//var_dump($_FILES['file']);
//echo "<br />";
$filename = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];
$error = $_FILES['file']['error'];
$imageinfo = getimagesize($tmp_name);
//var_dump($imageinfo);
if($imageinfo["mime"] !="image/jpeg" && $imageinfo["mime"] != "image/png" && $imageinfo['mime'] != "image/gif"){
	echo "请选择正确类型的文件！"."<br />";
	exit;
}
//$des_addr = "../uploads";
$des_addr = "./upload/".$filename;
//copy($tmp_name,$des_addr);
move_uploaded_file($tmp_name,$des_addr);
if ($error == 0 ){
		echo "<h2>上传成功</h2>";
		echo "<img src = $des_addr alt='图片无法显示'/> ";
}
else{
	echo "<h2>上传失败</h2>";
}

?>
</body>
</html>
