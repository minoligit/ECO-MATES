<?php
  include_once 'include.php';

// use PHPMailer\PHPMailer\PHPMailer; 
// use PHPMailer\PHPMailer\Exception; 
 
// require 'PHPMailer/Exception.php'; 
// require 'PHPMailer/PHPMailer.php'; 
// require 'PHPMailer/SMTP.php'; 
 
// $mail = new PHPMailer; 
 
?>

<?php 
//////////////////////////////////////Send Messages to all members/////////////////////////////////////
if (isset($_POST['submit-message-all'])) {
  
  $sender = $_POST['sender'];
  $receiver = "all";
  $topic = $_POST['topic'];
  $message = $_POST['message'];
  $msgDateTime = $_POST['msgDateTime'];

  $sql1 = "SELECT email FROM members;";
  $result1 = mysqli_query($conn1, $sql1);

  // $mail->isSMTP();                          // Set mailer to use SMTP 
  // $mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers 
  // $mail->SMTPAuth = true;                   // Enable SMTP authentication 
  // $mail->Username = 'minolitfdo@gmail.com'; // SMTP username 
  // $mail->Password = 'mtharifdo';            // SMTP password 
  // $mail->SMTPSecure = 'tls';                // Enable TLS encryption, `ssl` also accepted 
  // $mail->Port = 587;                        // TCP port to connect to 

  // $mail->setFrom('minolitfdo@gmail.com', 'Nature_lovers');
  // $mail->addAddress('aaafdo97@gmail.com'); 
  // $mail->isHTML(true); 
  // $mail->Subject = '$topic'; 
  // $bodyContent = '$message'; 
  // $mail->Body = $bodyContent; 

  // if(!$mail->send()) { 
  //     echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
  // } else { 
  //     echo 'Message has been sent.'; 
  // } 



  // while($row=mysqli_fetch_assoc($result1)){
  //   $send = mail($row['email'], $topic, $message);
  // }
  
  //if ($send==true) {
    $sql2 = "INSERT INTO messages (sender,receiver,topic,message,msgDateTime) VALUES ('$sender','$receiver','$topic','$message','$msgDateTime')";
    $run2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

    if ($run2) {
      echo "<script>alert('Message is successfully sent');</script>";
      header("Location:messagess.php");
    }
    // else{
    //    echo "<script>alert('Failed to record message');</script>";
    // }
  //}
  else {
    echo "<script>alert('Please try again');</script>";
  }
}


//////////////////////////////////////Send Messages to all members///////////////////////////////////////
/////////////////////////////////////Send message to seleted members/////////////////////////////////////
if (isset($_POST['submit-message-select'])) {
  
  $sender = $_POST['sender'];
  $receiver = $_POST['receiver'];
  $topic = $_POST['topic'];
  $message = $_POST['message'];
  $msgDateTime = $_POST['msgDateTime'];

  //$send = mail($member, $subject, $message);

  //if ($send==true) {
    $sql2 = "INSERT INTO messages (sender,receiver,topic,message,msgDateTime) VALUES ('$sender','$receiver','$topic','$message','$msgDateTime')";
    $run2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

    if ($run2) {
      echo "<script>alert('Message is successfully sent');</script>";
      header("Location:messagess.php");
    }
  //   else{
  //      echo "<script>alert('Failed to record message');</script>";
  //   }
  // }
  else {
    echo "<script>alert('Please try again');</script>";
  }
}
/////////////////////////////////////Send message to seleted members/////////////////////////////////////
/////////////////////////////////////////////Delete messages/////////////////////////////////////////////
if (isset($_POST['delete-messages'])) {
  
  $dltMsgDateTime = $_POST['delete-message-before'];
  $sql3 = "DELETE FROM messages WHERE msgDateTime<'$dltMsgDateTime';";
  $run = mysqli_query($conn1, $sql3) or die(mysqli_error($conn1));

  if($run){
    echo "<script>alert('Messages were successfully deleted.');</script>";
    header("Location:messages.php");
  }
  else{
    echo "<script>alert('Could not delete the messages. Please try again.');</script>";
    //header("Location:messages.php");
  }
}

/////////////////////////////////////////////Delete messages/////////////////////////////////////////////
?>