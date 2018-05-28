<!--
    AUTHOR:Wu Jiaming
    DATE:2018-4-24
    PROJECT:registering an account for SQL injection manoeuvre
-->


<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link href="../css/result.css" rel="stylesheet">
        <link href="../../fontawesome/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
    </head>

    <body>
    <a href='../../index.html' style='position:absolute;top:20px;left:20px;text-decoration:none;color:white;'><i class='fas fa-home' style='font-size:20px;'></i>&#160Home</a>
    <?php
        $username=$_GET['username'];
        $password=$_GET['password'];

        if(!get_magic_quotes_gpc()){
            $username=addslashes($username);
            $password=addslashes($password);
        }

        if (!$username||!$password){
            echo "You have not entered username,password or realname.Please go back and try again.";
            exit();
        }

        $username = addslashes($username);
        $password = addslashes($password);

        if (preg_match("/^.*((union)|(select)|\'|\-|#|insert|update|delete)+.*$/",$username)){
                echo "Please don't use quotes,'union','select','insert','update' or 'delete' as your username!";
                exit();
        }

        $config = fopen("../../configure",'r');
        $config_username =  ltrim(rtrim(fgets($config)));
        $config_password = ltrim(rtrim(fgets($config)));
        $config_username = substr($config_username,strpos($config_username,':')+1);
        $config_password = substr($config_password,strpos($config_password,':')+1);
        

        
        @ $db=new mysqli('localhost',$config_username,$config_password,'Sheep');
        $db->query("set names 'utf8'");
        if (mysqli_connect_errno()){
            echo "Error:database connect failed,please try again later.";
            exit();
        }

        $query1="select * from users where username='".$username."'";
        $result=$db->query($query1);
        $num_results=$result->num_rows;

        if ($num_results){
            echo "You input the username '".$username."' already exists,please re-entry";
            exit();
        }


        $query2="INSERT INTO `users` (`username`, `password`) VALUES ('".$username."','".$password."')";

        $result = $db->query($query2);

        if (!$db->errno){
            echo '<h1>注册用户成功！</h1>';
            echo "<a href='../html/login.html' style='color:yellow;'>开始sql注入的实战吧!&#160<i class='fas fa-arrow-right'></i></a><br/><br/>";
        }
        else{
            echo "Error:Register failed,please try again.";
            exit();
        }

        $result->free();
        $db->close();
    ?>
    </body>
</html>