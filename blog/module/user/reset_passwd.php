<?php
include '../../../system/connec_db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $oldpassword = $_POST['old_password'];
    $newpassword = $_POST['new_password'];
    $retype_password= $_POST['retype_password'];
    

    
    $result= "SELECT password FROM users WHERE user_id='8'  ";
    $checkpass = $conn ->query($result);
    $takepass= $checkpass->fetch_assoc()['password'];

    // echo $takepass;
    if(empty($oldpassword) || empty($newpassword) || empty($retype_password)){
        echo "Khong duoc de trong";
    }elseif($oldpassword != $takepass){ 
        echo "Sai mat khau roi";
    }else{
        if($newpassword != $retype_password){
            echo "Mat  khau khong trung khop";
        }
        elseif($oldpassword == $newpassword){
            echo "Khong duoc dung lai mat khau";
        }else{
            
            //  $newpass=" UPDATE users SET password='$newpassword' where user_id='8'";
            //  $changepass = $conn->query($newpass);
            echo "Doi mat khau thanh cong";
        }
        }

}







?>

<h1>Change Password</h1>

<form method="post" action="">

<label for="newPassword">Old Password:</label>
<input type="password" id="oldPassword" name="old_password" title="Old password" />

<label for="confirmPassword">New Password:</label>
<input type="password" id="newPassword" name="new_password" title="Type new password" />

<label for="confirmPassword">Confirm Password:</label>
<input type="password" id="confirmPassword" name="retype_password" title="Confirm new password" />

<p class="form-actions">
<input type="submit" value="Change Password" title="Change password" />
</p>

</form>