<!DOCTYPE HTML>
<html>
    <heade>
<title>Create New Team</title>
<link rel="stylesheet" href="newteam.css" />

</heade>
<body>
<?php

include_once "db.php";
session_start();
if(isset($_SESSION['Name']))
{
    $name= $_SESSION['Name'];
    $nameu=$_SESSION['nameu'];
}
$err1="";

if (isset($_POST['create']))
{
if($_POST['level']>5||$_POST['level']<1){
        $err1="*please choose level from 1-5";}
else {
  $pdo = db_connect();

  try {
   
   
    
    $sql = "INSERT INTO team(tname,level, gday,email) VALUES (:tname,:level,:gday,:name) ";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':tname', $_POST['tname']);
    $statement->bindValue(':level', $_POST['level']);
    $statement->bindValue(':gday', $_POST['gday']);
    $statement->bindValue(':name', $name);

    $done=$statement->execute();
    if ($done){
       header("location:dashboard.php");
    }

  }
  catch (PDOException $e) {
      die($e->getMessage());
    }
}
}
 
?>
 <header>
    <ul>
        <li><img id="img1" src="img2.png" alt="photo" /></li>
        <li><div>
            <img src="icon.png" alt="User Photo">
            <?php echo $nameu ?>
    </div>
    </li>
        
        <li id="a"><a href="logout.php">Log Out</a></li>
        <li id="a"> 
     <a href="#">ABOUT US</a>
</li>
</ul>
</header>
<nav>
      <ul>
       <li><a href="dashboard.php" >Dashboard</a></li>
          <li><a href="newteam.php" class="b">Create new Team</a></li>
       </ul>
   </nav>
   <main>
    <div class="div">  
<form method ="post" action ="<?php echo $_SERVER['PHP_SELF'] ?>">
    <table class="table1"border=1 cellspacing=0 cellpadding=7>
        <tbody>
           
            <tr>
                <td>Team Name:</td> <td><input type="text" id="tname" name="tname" required></td> 
            </tr>
            <tr>
            <div class="level">
                <td>Skill Level(1-5):</td> <td><input type="text" id="level" name="level" required></td>
                <span class="err"><?php echo $err1 ?></span>
</div>
            </tr>
            <tr>
            <td>Game Day:</td> <td><input type="text" id="gday" name="gday" required></td>
            </tr
            <tr>
                <td colspan=2 align='center'>   <input type ="submit" name = "create" value="Create" class="btn1"/></td> 
            </tr>

          <tbody>
    </table>
</form>
</div>
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
  
</body>
</html>