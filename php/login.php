<?php
	ini_set('display_errors',"1");
	session_start();
	include("../php/config.php");

	if(isset($_POST["username"]) && isset($_POST["password"]) && $conn)
    {
        $uname = $_POST["username"];
        $pass = $_POST["password"];
        
        $sql = "SELECT password, userid FROM users WHERE username = '$uname'";

        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $passwordFromDB = $row["password"];
                $idFromDB = $row["userid"];
            }
        }

        if (!$result) {
    		trigger_error('Invalid query: ' . $conn->error);
		}
        if($pass == $passwordFromDB)
        {
            $_SESSION["id"] = $idFromDB;
            $conn->close();
            header('Location: ../index.php');
        }
        else
        {
        	echo "something did not work";
        	$conn->close();
        	header('Location: ../pages/pageLogin.php?error=1');
        }
       
    }
    else
    {
    	header('Location: ../index.php');
    }
?>