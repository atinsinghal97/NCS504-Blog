<?php ob_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script>
       $(".button-collapse").sideNav();

    </script>
    <style>
     .form2{
      display:none;
     }
     </style>
    <title>
      Blog
    </title>
  </head>
  <body class="blue-grey lighten-5">
     <!--Checking Database Access and login status-->
    <?php
      session_start();
     ///// error_reporting(0);
      $link=mysqli_connect('localhost','root','','blog') or die(mysql_connect_error());
      if(!isset($_SESSION['login_status1']))
        $_SESSION['login_status1']=NULL;
      if(!isset($_SESSION['login_status2']))
        $_SESSION['login_status2']=NULL;
      if($_SESSION['login_status1']==true)
        header("Location:dashboard.php");
      if($_SESSION['login_status2']==true)
        header("Location:admin.php");
    ?>
    <header>
      <!--navbar-->
      <div class="navbar-fixed">
        <nav class="blue-grey darken-1" style="z-index: 7;">
          <a class="brand-logo" href="index.php" style="padding-left:10%;">My Blog</a>
          <ul class="right hide-on-med-and-down fixed">
            <li><a href="reachme.php">Reach Us</a></li>
          </ul>
          <ul id="slide-out" class="side-nav">
            <li><a href="reachme.php">Reach Us</a></li>
          </ul>
          <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        </nav>
      </div>
    </header>
    <section>
    <br>
      <div class="container">
        <div class="row " style="height: 70vh;">
          <div class=" form1 col s5 center blue-grey lighten-4" style="border-radius: 10px;padding: 20px 30px 10px 30px;  margin-left:40vh;">
            <!--login-->
            <h3>Login</h3>
            <form action="" method="post">
              <input placeholder="Username" type="text" name="name" required>
              <input placeholder="Password" type="password" name="password" required>
              <button type="submit" name="login" style="visibility: hidden;"><a class="waves-effect waves-light btn" style="visibility: visible;">Log In</a></button>
              <div>
              <p>Not registered yet? <a href="" id="SignUp">Sign Up</a></p>
              </div>
            </form>
            <?php
            if(isset($_POST["login"]))
            {
              $name=mysqli_real_escape_string($link,$_POST['name']);
              $password=mysqli_real_escape_string($link,$_POST['password']);
              $result=mysqli_query($link,"SELECT * FROM user WHERE username='$name' AND password='".($password)."'");
              $count=mysqli_num_rows($result);
              if($count)
              {
                $_SESSION['login_status1']=true;
                $_SESSION['user']=$name;
                header("location:dashboard.php");
              }
              else
              {
                $result=mysqli_query($link,"SELECT * FROM admin WHERE name='$name' AND password='".($password)."'");
                $count=mysqli_num_rows($result);
                if($count)
                {
                  $_SESSION['login_status2']=true;
                  $_SESSION['user']=$name;
                  header("location:admin.php");
                }
                else
                 header("Refresh:3");
               echo "Wrong Username or Password";
              }
            }
            ?>
          </div>
          <div class="col s2">
            &nbsp;
          </div>
          <div class="form2 col s5 center blue-grey lighten-4" style="border-radius: 10px;padding: 20px 30px 10px 30px;margin-left:16vh;">
            <!--signup-->
            <h3>Sign Up</h3>
            <form action="" method="post">
              <input placeholder="Username" type="text" name="name" required>
              <input placeholder="Email" type="email" name="email" required>
              <input placeholder="Mobile" type="number" name="mobile" required>
              <input placeholder="Password" type="password" name="password" required>
              <button type="submit" name="signup" value="Signup" style="visibility: hidden;"><a class="waves-effect waves-light btn" style="visibility: visible;">Sign Up</a></button>
              <div>
              <p>Already registered ? <a href="" id="LogIn">Log In</a></p>
              </div>
            </form>
            <?php
              if(isset($_POST["signup"]))
              {
                $name=mysqli_real_escape_string($link,$_POST["name"]);
                $email=$_POST["email"];
                $mobile=$_POST["mobile"];
                $password=mysqli_real_escape_string($link,$_POST['password']);
                $result1=mysqli_query($link,"SELECT * FROM user WHERE username='$name'");
                $result2=mysqli_query($link,"SELECT * FROM user WHERE email='$email'");
                $result3=mysqli_query($link,"SELECT * FROM admin WHERE name='$name'");
                $count1=mysqli_num_rows($result1);
                $count2=mysqli_num_rows($result2);
                $count3=mysqli_num_rows($result3);
                if($count1)
                {
                  echo "Username already exists";
                }
                else
                  if($count2)
                  {
                    echo "Email already exists";
                  }
                  else
                    if($count3)
                    {
                      echo "Username already exists";
                    }
                    else
                      {
                        $result=mysqli_query($link,"INSERT INTO user VALUES ('$name','$password','$mobile','$email')") or die(mysqli_error($link));
                        if($result)
                        echo "Sign Up Successful. Please Login!!!";
                      }
              }
            ?>
          </div>
        </div>
      </div>
      <div class="container">
        <?php
          $posts=mysqli_query($link,"SELECT * FROM post ORDER BY date DESC") or die(mysqli_error($link));
          $postcount=mysqli_num_rows($posts);
          $postperpage=2;
          $pagecount=$postcount/$postperpage;
          if(isset($_GET['p']))
          {
            $curpage=$_GET['p'];
          }
          else
          {
            $curpage=0;
          }
          if($curpage>$pagecount)
            $curpage=0;
          if($curpage<0)
            $startpost=0;
          else
            $startpost=$curpage*$postperpage;
          $previous=$curpage-1;
          $next=$curpage+1;
        ?>
        <?php
          $posts=mysqli_query($link,"SELECT * FROM post ORDER BY date DESC LIMIT $startpost, $postperpage") or die(mysql_error($link));
          while($post=mysqli_fetch_assoc($posts)):
        ?>
        <?php $id=$post["id"]; ?>
        <a href="post.php?id=<?php echo $id; ?>">
          <div class=row>
            <div class="card blue-grey darken-1">
              <div class="card-content white-text" style="overflow-wrap: break-word;>
                <span class="card-title"><?php echo $post["heading"]; ?></span>
                <p><?php $content=substr($post["content"],0,100); echo $content; ?>...</p>
              </div>
              <div class="card-action" style="padding-top: 5px;padding-bottom: 5px;">
                <a ><?php echo "Author: ",$post["auther"]; ?></a>
                <a ><?php echo "Date: ",  $post["date"]; ?></a>
                <a ><?php echo "Time: ",  $post["time"]; ?></a>
                <a class="right"><?php echo "Likes: ", $post["likes"]; ?></a>
              </div>
               <?php
                $comments=mysqli_query($link,"SELECT * FROM comments WHERE id='$id'") or die('No  Comments yet. '.mysqli_error($link));
                $count=mysqli_num_rows($comments);
                if($count):
              ?>
              <div class="card-action" style="height:15vh;padding-top: 5px;padding-bottom: 5px; background-color:white; overflow-y:scroll;">
                <a>
                  <?php
                    while($comment=mysqli_fetch_assoc($comments))
                    {
                      echo $comment["username"];
                      echo ": ", $comment["comment"], "<br>";
                    }
                  ?>
                </a>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </a>
        <?php endwhile; ?>
      </div>
      <br>
      <div class="center">
        <?php
          if($curpage>0):
        ?>
          <a class="waves-effect waves-light btn" href=index.php?p=<?php echo $previous;?>>Previous</a>
          &nbsp;
        <?php
          endif;
          if($curpage<$pagecount-1):
        ?>
          <a class="waves-effect waves-light btn" href=index.php?p=<?php echo $next;?>>Next</a>
        <?php
          endif;
        ?>

      </div>
    </section>
    <footer>
    &nbsp;
    </footer>
      <!--Import jQuery before materialize.js-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script type="text/javascript">
      $(function(){
        $('#SignUp').on('click',function(e)
        {$('.form1').css('display','none');
        $('.form2').css('display','inline');
        e.preventDefault();
        });
        });
      $(function(){
        $('#LogIn').on('click',function(e)
        {$('.form2').css('display','none');
        $('.form1').css('display','inline');
        e.preventDefault();
        });
        });

    </script>
  </body>
</html>
