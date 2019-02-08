<!-- Get information required to add a relation between actor and movie to the database -->
<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Add Actor to Movie Relation</title></head>
<body>
<h1>Add an Actor to Movie Relation to the Database</h1>
<p>
<font size=2>Created by: <i>Akshara Sundararajan</i> and <i>Rubia Liu</i></font>
<br>
Enter the following information about the movie you want to add.
<p>
<form action="AddActorToMovie.php" method="POST">
    Actor Information:
    <br>
    First name: <input type="text" name="first">  Last name: <input type="text" name="last">
    <br>
    Movie:
    <select name="title">
    <?php 
    $servername = "localhost";
    $username = "cs143";
    $password = "";
    $dbname = "CS143";
    $conn = new mysqli($servername, $username, $password, $dbname) or die ("Connection failed");
    $query = "select title from Movie;";
    if($res=$conn->query($query))
    {  
        while($row = $res->fetch_assoc())
        {
            $title = htmlentities($row['title']);
            echo "<option value='$title'>".$row['title']."</option>";
        }
    }
    $conn->close();
    ?>
    </select>
    <br>
    Role: <input type="text" name="role"><br> 
    <br>
   <input type="submit" value="Add relation!" />
</form>
</p>
<p><small>Note: tables and fields are case sensitive.</small>
</p>


</body>
</html>

<?php
$servername = "localhost";
$username = "cs143";
$password = "";
$dbname = "CS143";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$title = $_POST['title'];
$first = $_POST['first'];
$last = $_POST['last'];
$role = $_POST['role'];
// Receive id info
$mid_query = "select id from Movie where title='$title';";
if($MID = $conn->query($mid_query))
{
    $row = $MID->fetch_assoc();
    
    $mid = $row["id"];
    
    $aid_query = "select id from Actor where first='$first' and last='$last';";
    $AID = $conn->query($aid_query);
    if(!$AID || $AID->num_rows==0)
    {
        echo "Invalid Actor name";
    }
    else
    {
        $rowA = $AID->fetch_assoc();
        $aid = $rowA["id"];
        echo $aid;
        $query = "insert into MovieActor values($mid,$aid,'$role');";
        $conn->query($query) or die($conn->error());
    }

}

$ID->free();



$conn->close();
?>