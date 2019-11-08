<?php 
$conn = mysqli_connect("localhost","id11437357_xyz","root@");
mysqli_select_db($conn,"id11437357_forum") or die(mysqli_error());
if($conn->connect_error){
    die("Connection failed" .$conn->connect_error);
}
$name=mysqli_real_escape_string($conn,$_POST['name']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$text=mysqli_real_escape_string($conn,$_POST['text']);
$sql="INSERT INTO post_table (fname,email,text,time,topic_id) VALUES('$name','$email','$text',now(),'$_GET[id]')";
mysqli_query($conn,$sql) or die(mysqli_error($conn));
header('Location:postform.html');
mysqli_close($conn);
?>
