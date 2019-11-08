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
   <!-- <div class="container">
        <h3 class="text-center"><?php echo mysqli_query($conn,"select topic from addtopic_table where ID = $_GET[topic_id]")?></h3>
    </div>-->
    <?php
    $conn = mysqli_connect("localhost","id11437357_xyz","root@");
    mysqli_select_db($conn,"id11437357_forum") or die(mysqli_error());
    if($conn->connect_error){
        die("Connection failed" .$conn->connect_error);
    }
    $tpid=$_GET['topic_id'];
   ?>

    <div class="container">
         <fieldset>
             <legend>ADD POST</legend>
        <form class="form-horizontal" action='postform.php?id=<?php echo $tpid?>' method="post">
            <div class="form-group">
                <label class="control-label col-md-2" for="email">E-mail:</label>
                <div class="col-md-10">
                    <input type="email" class="form-control" placeholder="Enter your registered mail ID" id="email" name="email" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="text">Name:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="your name" id="name" name="name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="text">Describe:</label>
                <div class="col-md-10">
                    <textarea class="form-control" rows="5" id="text" name="text" placeholder="Your answer/query" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-10 col-md-2">
                    <button type="submit" class="btn btn-default submit-btn">POST!</button>
                </div>
            </div>
        </form>
        </fieldset>
     </div>
    <?php
    
$verify_topic = "select topic from addtopic_table where
      ID = $_GET[topic_id]";
  $verify_topic_res = mysqli_query($conn,$verify_topic)
      or die(mysqli_error($conn));
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
 
 if (mysqli_num_rows($verify_topic_res) < 1) {
      //this topic does not exist
   $display_block = "<P><em>You have selected an invalid topic.
      Please <a href=\"topiclist.php\">try again</a>.</em></p>";
  } else {
      //get the topic title
     $topic_title=mysqli_result($verify_topic_res,0,
          'topic');
  
     //gather the posts
     $get_posts = "select post_id, text, date_format(time,
          '%b %e %Y at %r') as fm_time, fname from
          post_table where topic_id = $_GET[topic_id]
          order by time asc";
  
     $get_posts_res = mysqli_query($conn,$get_posts) or die(mysqli_error($conn));
     ?>
  
     <!--//create the display string-->
     
     <div class="conatiner text-center">
    <p class="topictitle"><?php echo $topic_title?>:</p>
    </div>
    <div class="container">
    <div class="list-group">
        
     
   <?php
    while ($posts_info = mysqli_fetch_array($get_posts_res)) {
       $post_id = $posts_info['post_id'];
       $post_text = nl2br(stripslashes($posts_info['text']));
        $post_create_time = $posts_info['fm_time'];
        $post_owner = stripslashes($posts_info['fname']);
        ?>
  
       <!-- //add to display-->
         
          <div class="list-group-item">
            <div class="list-group-heading">
              <p><span class="owner"><strong><?php echo $post_owner;?></strong></span> : [<?php echo $post_create_time;?>]</p>
            </div>
            <div class="list-group-item-text post">
              <?php echo $post_text ?>
            </div>
          </div>
    <?php } ?>
  
    <!--//close up the table-->
    </div>
</div>
    <?php }
    mysqli_close($conn) ?>
    </div>
     <footer>
        <h4 class="text-center">&copy; MNIT Jaipur</h4>
     </footer>
</body>
</html>
