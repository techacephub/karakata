

<?php

include'conn.php';
session_start();
// echo $surName = check($conn,$_POST["surname"]);
if($_SERVER['REQUEST_METHOD']==='POST'){
$surName = check($conn,$_POST["surname"]);
$otherName = check($conn,$_POST["otherName"]);
$gender = check($conn,$_POST["gender"]);
$email = check($conn,$_POST["email"]);
$filter= filter_var($email, FILTER_VALIDATE_EMAIL);
$username = check($conn,$_POST["username"]);
$password = check($conn,$_POST["password"]);
$hashpass = password_hash($password, PASSWORD_DEFAULT);
$confirm = check($conn,$_POST["confirm"]);
$dob = check($conn,$_POST["dob"]);
// $created_at =  htmlspecialchars($_POST["created_at"]);
$userType = check($conn,$_POST["user_type"]);

if(empty($surName) ||empty($otherName) || empty($gender) ||empty($email)||empty($password) ||empty($userType) || empty($confirm) ||empty($dob)){
	echo "some fields are empty";
}
else{
    $sql1 = " SELECT * FROM user WHERE email = '$email'  OR  `password` = '$hashpass'";
    $que = $conn->query($sql1);
    if(mysqli_num_rows($que) > 0){
        echo " user already exist";
    }elseif( $password !== $confirm){
        echo "password not match";
    }else{
$sql = "INSERT INTO `user`(`surname`, `othername`, `gender_id`, `email`, `username`, `password`, `c_password`, `dob`, `date_created`, `user_type_id`) VALUES ('$surName','$otherName','$gender','$filter','$username','$password','$confirm','$dob',NOW(),'$userType')";
$query = $conn->query($sql);
	if($query){
	echo 'data uploaded successfully';
	}else{
	    echo 'sonething went wrong';
	}
}
}

}




function check($conn,$val){
	return htmlspecialchars($conn->real_escape_string($val));
}





?>
