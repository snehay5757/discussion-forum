<!DOCTYPE html>
<html lang="en">
<head>
 <title>FORUM</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width,initial-scale=1">
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
 <link rel="stylesheet" type="text/css" href="forum.css">
</head>
 <body>
    <div class="page">
    <header class="row">
        <div class="col-md-4"><img src="Mnit_logo.png" alt="logo" height="100px"></div>
        <h1 class="col-md-4">MNIT DISCUSSION FORUM<br><small>where similar ideas meet</small></h1>
        <div class="col-md-4"><img src="community.jpg"alt="image" height="100px"></div>
   </header>
     <nav class="navbar navbar-inverse">
        <div class="container-fluid">
           <ul class="nav navbar-nav">
              <li class="active">
                 <a class="link-nav" href="index.php">INTERESTS</a>
              </li>
              
           </ul>
           <ul class="nav navbar-nav navbar-right">
              <li>
                 <a href="#">Sign Up</a>
              </li>
              <li>
                 <a href="loginform.html">Log In</a>
              </li>
           </ul>
        </div>
     </nav>
     <!--common-->
      <!--<div class="list-group">
          <a href="webdev.html" class="list-group-item">
            <h4 class="list-group-item-heading">WEB DEVELOPMENT</h4>
            <p class="list-group-item-text">By whom</p>
          </a>
        <a href="#" class="list-group-item">
           <h4 class="list-group-item-heading">ETHICAL HACKING</h4>
           <p class="list-group-item-text">By whom</p>
         </a>
         
     </div>-->
     <div class="container">
        <table class="table-hover table table-responsive topic_table">
         <thead>
            <tr>
               <th>Interest</th>
               <th>Introduced By</th>
               <th>Creation Time</th>
               <th>Posts till now</th>
               <th>ADD</th>
            </tr>
         </thead>
         <tbody>
            <!-- <tr>
                 <td>WEB DEV</td>
                 <td>Sneha</td>
                 <td>#</td>
                 <td>1</td>
                 <td><a href="#"><button class="btn btn-success">+</button></a></td>
             </tr>-->
             <?php
$conn = mysqli_connect("localhost","id11437357_xyz","root@");
mysqli_select_db($conn,"id11437357_forum") or die(mysqli_error());
if($conn->connect_error){
    die("Connection failed" .$conn->connect_error);
    
}
function mysqli_result($res,$row=0,$col=0){ 
   $numrows = mysqli_num_rows($res); 
   if ($numrows && $row <= ($numrows-1) && $row >=0){
       mysqli_data_seek($res,$row);
       $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
       if (isset($resrow[$col])){
           return $resrow[$col];
       }
   }
   return false;
}
$q1="SELECT ID,topic,date_format(time, '%b %e %Y at %r') as fmt_time,
fname from addtopic_table order by time desc";
$q1_res=mysqli_query($conn,$q1) or die(mysqli_error());
while($info=mysqli_fetch_array($q1_res)){
  $id=$info['ID'];
  $fname=$info['fname'];
  $time=$info['fmt_time'];
  $topic=$info['topic'];
  $get_num_q2="select count(post_id) from post_table
    where topic_id = $id";
  $get_num_q2_res=mysqli_query($conn,$get_num_q2) or die(mysqli_error($conn));
  $post_count=mysqli_result($get_num_q2_res,0,'count(post_id)');
  ?>
  <tr>
  <td><?php echo $topic?></td>
  <td><?php echo $fname ?></td>
  <td><?php echo $time ?></td>
  <td><?php echo $post_count ?></td>
  <td><a href='post.php?topic_id=<?php echo $id?>'><button class="btn btn-default">+</button></td>
  </tr>
<?php } ?>
</table>
<?php mysqli_close($conn);
?>
         </tbody>
        </table>
     </div>
     <div class="container">
        <fieldset>
        <h3 class="addtopichead text-center">ADD A NEW TOPIC HERE:</h3>
        <form class="form-horizontal" action="addtopic.php" method="post">
           <div class="form-group">
              <label class="control-label col-md-2" for="name">FIRST NAME:</label>
              <div class="col-md-10">
              <input class="form-control" type="text" id="name" name="name" placeholder="YOUR FIRST NAME" required>
              </div>
           </div>
           <div class="form-group">
              <label class="col-md-2 control-label" for="name">LAST NAME:</label>
              <div class="col-md-10">
                 <input class="form-control" type="text" id="lname" name="lname" placeholder="YOUR LAST NAME">
              </div>
           </div>
           <div class="form-group">
              <label class="control-label col-md-2" for="email">E-MAIL:</label>
              <div class="col-md-10">
                 <input class="form-control" type="email" id="oemail" name="oemail" placeholder="Your college mail ID" required>
              </div>
           </div>
           <div class="form-group">
              <label class="control-label col-md-2" for="text">TOPIC:</label>
              <div class="col-md-10">
                 <input class="form-control" type="text" name="topic" id="topic" placeholder="Topic of your interest" required>
              </div>
           </div>
           <div class="form-group">
              <label class="control-label col-md-2" for="text">DESCRIPTION:</label>
              <div class="col-md-10">
                 <textarea class="form-control" rows="5" name="description" id="description" placeholder="Describe your interest"></textarea>
              </div>
           </div>
           <div class="form-group">
              <div class="col-md-offset-11 col-md-1">
                 <button type="submit" class="btn btn-default submit-btn">ADD!</button>
              </div>
           </div>
        </form>
      </fieldset>
     </div>
</div>
     <footer>
            <h4 class="text-center">&copy; MNIT Jaipur</h4>
         </footer>
 </body>
 </html>
