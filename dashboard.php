<!DOCTYPE HTML>
<html>
    <heade>
<title>Kickball League Dashboard</title>
<link rel="stylesheet" href="dashboard.css" />

</heade>
<body>
<?php
    include_once "db.php";

        session_start();
        if(isset($_SESSION['Name']))
        {
            $nameu=$_SESSION['Name'];

        }
            
            
        try {
            $pdo = db_connect();
            $query = "SELECT t.tname, t.level, t.gday, COUNT(p.pname) AS nump ".
                "FROM team t ".
                "LEFT JOIN player p ".
                "ON t.tname = p.tname ".
                "GROUP BY t.tname, t.level, t.gday";
        
            $dbResults = $pdo->query($query);
        
            $rows = $dbResults->fetchAll();
            
        
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
        try {
            $pdo = db_connect();
            $query = "SELECT username ".
            "FROM registration ". 
            "WHERE email = :nameu";
        
            $statement = $pdo->prepare($query);
            $statement->bindValue(':nameu', $nameu);
            $statement->execute();

            $row = $statement->fetch();
            $user=$row['username'];
            $_SESSION['nameu'] = $user;

            
        
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
            <?php echo $user ?>
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
       </ul>
   </nav>  
     
<main>
    <div class="div">
    <table b class="table1"  border=1 cellspacing=0 cellpadding=7>
        <thead>
            <tr>
                <th align='center'>Team Name</th><th align='center'>Skill Level(1-5)</th><th align='center'>Game Day</th> <th align='center'>Players</th> 
            </tr>
    </thead>
    <tbody>
            <?php foreach ($rows as $row):?>
        <tr>
            <td id="a2"><a href="teamd.php?name=<?php echo urlencode($row['tname']) ?>"><?php echo $row['tname']?></a></td>
            <td><?php echo $row['level']?></td>
            <td><?php echo $row['gday']?></td>    
            <td><?php echo $row['nump']."/9"?></td>        
        </tr>
        <?php endforeach;?>
        <tbody>
        
    </table>
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