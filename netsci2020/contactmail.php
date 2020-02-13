<?php 
//echo"<pre>";print_r($_POST);exit;
function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
$user_email = $_POST['email'];
$user_fname = $_POST['fname'];
$user_lname = $_POST['lname'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$to_email='manimaran@uohyd.ac.in';
$subject = 'Message from NetSci2020 website';
$message = 'user with email address '.$user_email.' has sent you this message'.$message.' through your website.';

//check if the email address is invalid $secure_check
$secure_check = sanitize_my_email($user_email);
if ($secure_check == false) {
    echo "Invalid input";
} else { //send email 
    $result=mail($to_email, $subject, $message);
    //print_r($result);
    if ($result) {
    	echo "Success ";
    }
    else
    print_r(error_get_last()['message']);
}
?>