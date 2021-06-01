<?php
    include "dbconn.php";

    $user = $_POST["user"];
    $pass = $_POST["pass"];
    
    if($conn){
        $sql = "SELECT * FROM USER";
        $result = $conn->query($sql);

        if(mysqli_query($conn, $sql)){
            while($row = $result->fetch_assoc()){
                $tempUser = $row["USERNAME"];
                $tempPass = $row["PASSWORD"];
                $role = $row["ROLE"];

                if($user == $tempUser && $pass == $tempPass){
                    echo "Login Success";

                    $_SESSION["logged"] = TRUE;
                    $_SESSION["user"] = $user;
                    $_SESSION["role"] = $role;                    

                    break;
                }else{
                    echo "no user";
                }
            }
        }
    }else{
        die("FATAL ERROR");
    }
?>