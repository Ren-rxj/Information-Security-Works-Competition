<!--
    AUTHOR:Ren Xujie
    DATE:2018-5-15
    PROJECT:SQL injection with method addslashes
-->


<html>
<head>
    <title>Information</title>
    <meta charset="utf-8"/>
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

    while (preg_match("/^.*((drop)|update)+.*$/i",$username))
    {
        $username=preg_replace('/(drop|update)/i','',$username);
    }

while(preg_match("/^.*((union)|(select)|and|or| )+.*$/i",$username))
{
    $username=preg_replace('/(union)|(select)|and|or| /i','',$username);
}

    $username=addslashes($username);
    $password=addslashes($password);

    $config = fopen("../../configure",'r');
    $config_username =  ltrim(rtrim(fgets($config)));
    $config_password = ltrim(rtrim(fgets($config)));
    $config_username = substr($config_username,strpos($config_username,':')+1);
    $config_password = substr($config_password,strpos($config_password,':')+1);
            

            
    @ $db=new mysqli('localhost',$config_username,$config_password,'Sheep');


    if (mysqli_connect_errno())
    {
        echo "Error:Could not connect to database,please try again later";
    }

    $charset="set names 'GBK'";
    $db->query($charset);

    $query="select * from users where username='".$username."' and password='".$password."'";
    $result=$db->query($query);
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
    $result->free();

    $uapar = false;
    $query2 = "select * from users where username='".$username."'";
    $result2 = $db->query($query2);
    $num_result2 = $result2->num_rows;
    if($num_result2 > 0){
        $result_info2 = $result2->fetch_assoc();
        $password_right = $result_info2['password'];
        if($password_right !== $password){
            $uapar = true;
        }
    }

    $db->close();

    if($num_result >1 or $uapar){
        echo '<h1>sql injection success</h1>';
        echo "<a href='../html/login_para.html' style='color:yellow;'>下一关&#160<i class='fas fa-arrow-right'></i></a>";
        echo "<p><font face='楷体'> &#160&#160&#160&#160后端使用php自带函数addslashes()进行单引号等符号的转义，这已经能避免大多数情况下的SQL注入。在下一关，我们将见到更加有效的防止SQL注入的方法：参数化查询。</p>";
    }

    /**
     * the way to bypass
     * result_addsls.php?username=renxujie%be' or 1=1 -- %23&password=anything
     */
?>
</body>
</html>