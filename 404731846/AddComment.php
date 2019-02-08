<!-- Get information required to add a comment to the database -->
<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Add Comment</title></head>
<body>
<h1>Add a Comment to the Database</h1>
<p>
<font size=2>Created by: <i>Akshara Sundararajan</i> and <i>Rubia Liu</i></font>
<br>
Enter the following information about the movie you want to add.
<p>
<form action="AddComment.php" method="POST">
    Reviewer name: <input type="text" name="name"><br>
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
    Rating: 
    <input type="radio" name="rating" value="5">5 stars 
    <input type="radio" name="rating" value="4">4 stars 
    <input type="radio" name="rating" value="3">3 stars  
    <input type="radio" name="rating" value="2">2 stars 
    <input type="radio" name="rating" value="1">1 star   
    <br>
    <textarea name="comment" cols="60" rows="8"><?php print "$comment" ?></textarea><br />
   <input type="submit" value="Add review!" />
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
$name = $_POST['name'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
// Receive id info
$id_query = "select id from Movie where title='$title';";
if($ID = $conn->query($id_query))
{
    $row = $ID->fetch_assoc();
    
    $mid = $row["id"];
    
    $time_query = "SELECT CURRENT_TIMESTAMP;";

    if($time_res = $conn->query($time_query))
    {
        $time_row = $time_res->fetch_row();
        $timestamp = $time_row[0];
        $query = "insert into Review values('$name','$timestamp',$mid,$rating,'$comment');";
        $conn->query($query) or die($conn->error());
    
    
    }
}

$ID->free();



$conn->close();
?>