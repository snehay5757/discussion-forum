<?php 
$conn = mysqli_connect("localhost","id11437357_xyz","root@");
    mysqli_select_db($conn,"id11437357_forum") or die(mysqli_error());
if($conn->connect_error){
    die("Connection failed" .$conn->connect_error);
}
$fname=mysqli_real_escape_string($conn,$_POST['name']);
$lname=mysqli_real_escape_string($conn,$_POST['lname']);
$email=mysqli_real_escape_string($conn,$_POST['oemail']);
$topic=mysqli_real_escape_string($conn,$_POST['topic']);
$description=mysqli_real_escape_string($conn,$_POST['description']);
$sql="INSERT INTO addtopic_table (fname,lname,email,topic,description,time) VALUES('$fname','$lname','$email','$topic','$description',now())";
mysqli_query($conn,$sql) or die(mysqli_error());
$topic_id=mysqli_insert_id($conn);
$sqln="INSERT INTO post_table (fname,email,text,topic_id,time) VALUES('$fname','$email','$description','$topic_id',now())";
mysqli_query($conn,$sqln) or die(mysqli_error());
header('Location:addtopic.html');
mysqli_close($conn);
?>
