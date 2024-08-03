<!DOCTYPE HTML>
<html>
    <heade>
<title>Team Details</title>
<link rel="stylesheet" href="teamd.css" />
</heade>
<body>
    <?php
     include_once "db.php";
    session_start();
    
    $nameu=$_SESSION['nameu'];
    
     
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
    } 
    try {
        $pdo = db_connect();
        $query = "SELECT tname, level, gday ".
            "FROM team ". 
            "WHERE tname = :name";
    
            $statement = $pdo->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->execute();

            $row = $statement->fetch();
            $tname=$row['tname'];
            $level=$row['level'];
            $gday=$row['gday'];

           


           
        
    
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
    try {
        $pdo = db_connect();
        $query = "SELECT COUNT(pname) AS numplayer ".
            "FROM player ". 
            "WHERE tname = :name";
    
            $statement = $pdo->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->execute();

            $row = $statement->fetch();
            $numberp=$row['numplayer'];
        
    
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
    $print="The team is full, you cannot add more!";

    if (isset($_POST['add']))
    {
        if ($row['numplayer']<"9"){

      $pdo = db_connect();
    
      try {
       
       
        
        $sql = "INSERT INTO player(pname,tname) VALUES (:pname,:name) ";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':pname', $_POST['pname']);
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
    else{
    
    }
}
    try {
        $pdo = db_connect();
        $query = "SELECT pname ".
            "FROM player ". 
            "WHERE tname = :name";
    
            $statement = $pdo->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->execute();

            $rows = $statement->fetchAll();
            
           


           
        
    
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }



    
    try {
        $pdo = db_connect();
        $query = "SELECT email ".
            "FROM team ". 
            "WHERE tname = :name";
    
            $statement = $pdo->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->execute();

            $row = $statement->fetch();
           
    }
    catch (PDOException $e) {
        die($e->getMessage());
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
       <li><a href="dashboard.php" class="b">Dashboard</a></li>
          <li><a href="newteam.php">Create new Team</a></li>
          <?php
          if($row['email']== $_SESSION['Name']){
              echo  "<li><a href=\"edit.php?name=$name&level=$level&gday=$gday\">Edit</a></li>";
              echo"<li><a href=\"delete.php?name=$name\">Delete</a></li>";
                
            }else{
            }
            ?>
       </ul>
   </nav>
   <main>
    <div class="div2">
        <?php
       

           echo "<ul><li>Team Name: " .$tname. "<br></li>";
            echo "<li>Level: " .$level. "<br></li>";
           echo "<li>Game Day: " .$gday. "<br></li>";
           echo "<li>Number of the players:".$numberp."/9"."</li></ul><br>";   
           ?>
        </div>
        <div class="div3">
            <?php
            echo "<ul><p>Players:</p>";
            foreach ($rows as $row):
            echo "<li>".$row['pname'] ."</li><br>";
           endforeach;
           if($numberp=="9"){
            echo "<li>".$print."</li><br>";

           }
           echo "</ul>";

           ?>
        </div>
   <div class="div">  
<form method ="post" action ="">

    <table class="table1" border=1 cellspacing=0 cellpadding=7>
    <thead>
            <tr>
                <th colspan=2 align='center'>Add Player</th> 
            </tr>
</thead>
        <tbody>
           
            <tr>
                <td>Player Name:</td> <td><input type="text" id="pname" name="pname" required></td> 
            </tr>
           
            <tr>
                <td colspan=2 align='center'>   <input type ="submit" name = "add" value="Add" class="btn1"/></td> 
            </tr>
</tbody>


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