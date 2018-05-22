<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/result.css" rel="stylesheet"> 
<link href="../../fontawesome/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
<title>XSS-Impossible</title>
</head>
<body>
<a href='../../index.html' style='position:absolute;top:20px;left:20px;text-decoration:none;color:white;'><i class='fas fa-home' style='font-size:20px;'></i>&#160Home</a>
<br /><br /><br /><br /><br />
<h1>无法绕过产生XSS</h1>
<form action="xss-impossible" method="get">
<input type="text" name="xss_input" placeholder="这里填写的内容会在下面显示">
<input type="submit" value="显示">
</form>
<br /><br />
<?php
//impossible
function xss_filter($xss) {
	while(str_ireplace("<script>","",$xss)!=$xss) {
		$xss=str_ireplace("<script>","",$xss);
	}
	while(str_ireplace("</script>","",$xss)!=$xss) {
		$xss=str_ireplace("</script>","",$xss);
	}
	$xss = htmlspecialchars($xss);
	$xss=str_replace("'","",$xss);
	$xss=str_replace("\"","",$xss);
	$xss=str_replace("/","",$xss);
	$xss=str_replace("\"","",$xss);
	$xss=str_replace("<","&#60;",$xss);
	$xss=str_replace(">","&#62;",$xss);
	
	Return $xss;
}
$xss = $_GET['xss_input'];
$xss=xss_filter($xss);
echo '你所输入的内容为:'.($xss?$xss:"你所输入的内容");

?>
<div style='position: absolute;top:100px;'>
<table style='text-align:left;' cellspacing="20">
    <tr><th>关卡列表:</th></tr>
    <tr>
        <td><a href="xss-1.php" style='color:yellow;'>最基本的XSS&#160<i class='fas fa-arrow-right'></i></a></td>
    </tr>
    <tr>
        <td><a href="xss-2.php" style='color:yellow;'>闭合标签的XSS&#160<i class='fas fa-arrow-right'></i></a></td>
    </tr>
    <tr>
        <td><a href="xss-3.php" style='color:yellow;'>循环过滤关键字的XSS(大小写敏感)&#160<i class='fas fa-arrow-right'></i></a></td>
    </tr>
    <tr>
        <td><a href="xss-4.php" style='color:yellow;'>过滤关键字的XSS(大小写不敏感)&#160<i class='fas fa-arrow-right'></i></a></td>
    </tr>
    <tr>
        <td><a href="xss-5.php" style='color:yellow;'>过滤单引号和双引号的XSS&#160<i class='fas fa-arrow-right'></i></a></td>
    </tr>
    <tr>
        <td><a href="xss-6.php" style='color:yellow;'>使用htmlspecialchars函数过滤输入的XSS&#160<i class='fas fa-arrow-right'></i></a></td>
    </tr>
    <tr>
        <td><a href="xss-7.php" style='color:yellow;'>使用img标签的onerror属性实现XSS&#160<i class='fas fa-arrow-right'></i></a></td>
    </tr>
    <tr>
        <td><a href="xss-impossible.php" style='color:yellow;'>无法绕过产生XSS&#160<i class='fas fa-arrow-right'></i></a></td>
    </tr>
</table>
</div>
</body>
</html>

	