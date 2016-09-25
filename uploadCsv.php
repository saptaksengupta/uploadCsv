<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'test');
    if(isset($_POST['upload_btn'])){
        if($_FILES['fileToUpload']['name']){
            $fileName = explode('.', $_FILES['fileToUpload']['name']);
            
            if($fileName[1] == 'csv'){ // check for the file extenssion. . .
                
                $truncet_sql = 'TRUNCATE table hotels_arbnb';
                if(!mysqli_query($conn, $truncet_sql)){
                    echo 'There is an Error In Truncet Table !<br>';
                    echo mysqli_error($conn);
                    exit;
                }
                
                $handle = fopen($_FILES['fileToUpload']['tmp_name'], 'r');
                
                while ($data = fgetcsv($handle)){ // fetch the comma separated eliment of that file. . .
                    
                    $sql = "INSERT into hotels_arbnb values('',";
                    $length = sizeof($data);
                    for($i = 0; $i < sizeof($data); $i++){
                        if($i == $length - 1){
                            $sql .= " '".mysqli_real_escape_string($conn, $data[$i])."');"; 
                        }else{
                            $sql .= " '".mysqli_real_escape_string($conn, $data[$i])."' , "; 
                        }
                        
                    }                    
                    if(!mysqli_query($conn, $sql)){//check if there is any error in insertion. .
                        echo mysqli_error($conn);
                        $error = 1;
                    }  else {
                        $error = 0;
                    }
                                       
                }
                fclose($handle);
                header('location: http://'.$_SERVER['HTTP_HOST'].'/uploadCsv/index.php?error='.$error);
            }
        }
    }
