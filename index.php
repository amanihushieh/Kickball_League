<html>
<head>
<title>Kickball League</title>
<link rel="stylesheet" href="index.css" />

</head>
<body>
<?php

include_once "db.php";

session_start();
$err1="";
$err2="";



if (isset($_POST['register']))
{
    if($_POST['password'] != $_POST['cpassword']){
             $err1="*password mismatch!";}
    else {
 
  $pdo = db_connect();

  try {
   
   
    
    $sql = "INSERT INTO registration(username,email, password,cpassword) VALUES (:username,:email,:password,:cpassword) ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':username', $_POST['username']);
    $statement->bindValue(':email', $_POST['email']);
    $statement->bindValue(':password', $_POST['password']);
    $statement->bindValue(':cpassword', $_POST['cpassword']);
    

    $done=$statement->execute();
    if ($done){
       header("location:index.php");
    }

  }
  catch (PDOException $e) {
      die($e->getMessage());
    }
}
}
?>
<?php
include_once "db.php";




if (isset($_POST['login']))
{
    if(isset($_REQUEST['email2']))
{
    $_SESSION['Name'] = $_REQUEST['email2'];



}
    $pdo = db_connect();


  try {
    $sql = "SELECT * FROM registration WHERE email=:email2 AND password=:password2";
    $statement = $pdo->prepare($sql);
    
    $statement->bindValue(':email2', $_POST['email2']);
    $statement->bindValue(':password2', $_POST['password2']);
    $statement->execute();
    $counter = $statement->rowcount();

    if ($counter > 0) {
        header("location:dashboard.php");

    }
    else{
        echo "Not Found";
    }

}  catch (PDOException $e) {
      die($e->getMessage());
    }
  }
  ?>
  <div>
  <header>
    <ul>
        <li><img src="img2.png" alt="photo" /></li>
        <li id="a"> 
     <a href="#">ABOUT US</a>
</li>
</ul>
</header>
<main>
<form method ="post" action ="<?php echo $_SERVER['PHP_SELF'] ?>">
<section class="sec1">
  <table class="table1"  cellspacing=0 cellpadding=7>
    <thead>
            <tr>
                <th colspan=2 align='center'>Register</th> 
            </tr>
</thead>
<tbody>
            <tr>
                <td>User Name:</td> <td><input type="text" id="username" name="username" >
              </td> 
            </tr>
            <tr>
                <td>Email:</td> <td><input type="text" id="email" name="email"></td>
            </tr>
            <tr>
            <td>Password:</td> <td><input type="password" id="password" name="password"></td>
            </tr>
            <tr>
                <div class="pass">
            <td>Confirm Password:</td> <td><input type="password" id="cpassword" name="cpassword" ></td>
            <span class="err"><?php echo $err1 ?></span>
            </div>

            </tr>
            <tr>
                <td  colspan=2 align='center'>   <input type ="submit" name = "register" value="Register"  class="btn1"/></td> 
            </tr>
</tbody>
            </table>
</section>
<section class="sec2">

            <table class="table2" cellspacing=0 cellpadding=7>
                <thead>
            <tr>
                <th colspan=2 align='center'>Log In</th> 
            </tr>
</thead>
<tbody>
            <tr>
                <td>Email:</td> <td><input type="text" id="email2" name="email2" ></td>
            </tr>
            <tr>
            <td>Password:</td> <td><input type="password" id="password2" name="password2" ></td>
            </tr>
            <tr>
                <td colspan=2 align='center'>   <input type ="submit" name = "login" value="Log In"  class="btn2"/></td> 
            </tr>
</tbody>


    </table>
</section>
</form>
</main>
<footer>
<ul>
      <li>Address: 183 Main St, Ramallah, ps</li>
      <li>Email: KL@gmail.com</li>
      <li><a href="tel:+0569655035">Call us: +0569655035</a></li>
      <li id="a1"><a href="#">Contact Us</a><li>
        <li>&copy; 2023 Kickball League. All rights reserved.</li>

</ul>
</footer>
</div>

</body>
</html>
