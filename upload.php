<?php
    include "dbconn.php";

    $type = $_POST["type"];

    echo $type;

    if($conn){
        $fileName = $_FILES["file"]["tmp_name"];

        echo $fileName;

        if ($_FILES["file"]["size"] > 0){
            echo "bigbig";
        }

        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            if (isset($column[0])){
                $RTL = mysqli_real_escape_string($conn, $column[0]);                

                echo $RTL."<br>";
            }
            if(isset($column[2])){
                $SIN = mysqli_real_escape_string($conn, $column[2]);

                echo $SIN."<br>";
            }
            $sql = "INSERT INTO ORDERTYPE (SIN, RTL, ORDER_TYPE) VALUES ('$SIN', '$RTL', '$type')";
            
            if(mysqli_query($conn, $sql)){
                echo "imported";
            }else{
                echo "lmao";
            }            
        }
    }
?>