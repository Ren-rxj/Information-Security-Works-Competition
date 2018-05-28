<!--
    AUTHOR:Ren Xujie
    DATE:2018-5-15
    PROJECT:SQL injection with method Parameterized Query
-->


<html>
<head>
    <title>Information</title>
    <meta charset="GBK"/>
    <link href="../css/result.css" rel="stylesheet">
    <link href="../../fontawesome/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
</head>

<body>
<a href='../../index.html' style='position:absolute;top:20px;left:20px;text-decoration:none;color:white;'><i class='fas fa-home' style='font-size:20px;'></i>&#160Home</a>
<h1>Your informations:<br /></h1>
<div style='text-align:center;'>
<?php
$username=$_GET['username'];
$password=$_GET['password'];

if(!$username||!$password)
{
    echo "You have not entered username or password. Please go back and enter both of them.";
    exit;
}

$config = fopen("../../configure",'r');
$config_username =  ltrim(rtrim(fgets($config)));
$config_password = ltrim(rtrim(fgets($config)));
$config_username = substr($config_username,strpos($config_username,':')+1);
$config_password = substr($config_password,strpos($config_password,':')+1);

/*        if(!get_magic_quotes_gpc())
        {
            $username=addslashes($username);
            $password=addslashes($password);
        }
*/

@ $db=new mysqli('localhost',$config_username,$config_password,'Sheep');
if (mysqli_connect_errno())
{
    echo "Error:Could not connect to database,please try again later";
}

$stmt = $db->prepare("select * from users where username=? and password=?");
$stmt->bind_param('ss', $username,$password);

$stmt->execute();

$result = $stmt->get_result();

//$charset="";
//$db->query($charset);

//$query="select id,username,password,realname from users where username='".$username."' and password='".$password."'";
//$result=$db->query($query);
$num_result=$result->num_rows;

if (!$num_result){
    echo "Your username or password is wrong.Please go back and enter again.";
    exit;
}

echo " <table border=\"1\" width=\"4\">
                    <tr>
                        <th>USERNAME</th>
                        <th>PASSWORD</th>
                    </tr>";

for ($i=0;$i<$num_result;$i++){
    $result_info=$result->fetch_assoc();
    echo "<tr>
                    <td>".$result_info['username']."</td>
                    <td>".$result_info['password']."</td>
                    </tr>";
}

echo "</table>";
echo '</div>';
$stmt->close();
$result->free();
$db->close();


?>

<p><font size="5" face="楷体"> &#160&#160&#160&#160在后端代码中使用mysqli类的prepare()方法和bind_param()方法完成了参数化查询的功能。参数化查询用户输入的所有字符视为SQL的参数，而在前面几关中用户输入的内容被直接拼接在了后端的SQL查询语句中，因而出现SQL注入漏洞。<br/>
    例如用户输入内容为："';drop all;"在不进行一些特定的过滤情况下该语句将被直接拼接在SQL语句后面。若采用参数化查询的方法，该内容将被视为SQL的参数传给后端，此时后端构建的SQL语句可能为："selece * from dbname where username="';drop all;"（数据库将在表dbname中查找username为"'drop all;"的元素。</font></p>

</body>
</html>