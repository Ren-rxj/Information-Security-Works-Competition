<html>
<head>
    <title>Information</title>
    <meta charset="utf-8"/>
</head>

<body>
<h1>Your informations:<br /></h1>
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
    $result->free();
    $db->close();

    if($num_result >1 ){
        echo '<h1>sql injection success</h1>';
        echo "<a href='../html/login_filt.html'>下一关</a><br/><br/>";
        echo "<p align='left' ><font face='楷体'> &#160&#160&#160&#160提示：下一关我们将采用过滤一次关键字（如or）的方式进行防注入。</p>";
    }
            
?>
</body>
</html>