<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link href="../css/result.css" rel="stylesheet">
<link href="../../fontawesome/web-fonts-with-css/css/fontawesome-all.css" rel="stylesheet">
<title>XSS-4</title>
</head>
<body>
<h1>过滤关键字的XSS(大小写不敏感)</h1>
<form action="xss-4.php" method="get">
<input type="text" name="xss_input" placeholder="这里填写的内容会在下面显示">
<input type="submit" value="显示">
</form>
<hr>
<?php
//替换<script>,</script>标签  当大小写不敏感时该如何绕过
function xss_filter($xss) {
	$xss=str_ireplace("<script>","",$xss);
	$xss=str_ireplace("</script>","",$xss);
	Return $xss;
}
$xss = $_GET['xss_input'];
$xss=xss_filter($xss);
echo '你所输入的内容为:'.($xss?$xss:"你所输入的内容");

echo "<!--绕过方法:<scr<script>ipt>alert('xss');</s</script>cript>-->";
?>
<br/><br/><br/>
<div style='text-align:center;'>
<table style='text-align:left;'>
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

	