<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = rm_charac($_POST['username'] );
    $password= rm_charac($_POST['pass']);
    $retype_password=rm_charac($_POST['repass']);
    $email =rm_charac($_POST['email']);
    



    if( strlen($password) < 13 && strlen($password) > 7      ){
        if( $password == $retype_password){
            
        $checksql= "select * from users where username='$username' or email='$email'"  ;
        $checkdupicate = $conn->query($checksql);            
        if($checkdupicate->num_rows>0){
            echo "<h3>Da ton tai user hoac email</h3>";
        }else{
        $sql= " insert into users (username,password,email) values ('$username','$password','$email') ";  
        
        if($conn->query($sql)== TRUE ){
            
            header('Location: index.php?page=user&action=login');
            
        }else{
            echo "Error: ". $sql ."<br>".$conn->error; 

        }
        }
        

    }else{
        echo "<h3>Retype sai mat khau</h3>";
    }
    $conn->close();
        }else{
            echo "<h3>Chua du 8-12 ki tu</h3> <p>Dat lai mat khau </p>";
        }
    }


?>

<form method="POST">
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required><br><br>

  <label for="username">Username:</label>
  <input type="text" id="username" name="username" required><br><br>

  <label for="pass">Password:</label>
  <input type="password" id="pass" name="pass" required><br><br>

  <label for="repass">Retype Password:</label>
  <input type="password" id="repass" name="repass" required><br><br>

  <input type="submit" value="Submit">
</form>
