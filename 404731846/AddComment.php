<!-- Get information required to add a comment to the database -->
<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Add Comment</title>
<link href="main.css" rel="stylesheet" type="text/css" /></head>
<body>
  <h1>CS143 Movie Database</h1>
  <div class = "navbar" id="my_centered_buttons">
    <div class="dropdown1" >
      <button class="dropbtn1">Add to a Database</button>
      <div class="dropdown-content1">
        <a href="AddActorOrDirector.php">Actor or Director</a>
        <a href="AddMovie.php">Movie</a>
        <a href="AddActorToMovie.php">Actor to Movie</a>
        <a href="AddDirectorToMovie.php">Director to Movie</a>
        <a href="AddComment.php">Movie Reviews</a>
      </div>
    </div>
    <div class="dropdown2" >
      <button class="dropbtn2">Browse Information</button>
      <div class="dropdown-content2">
        <a href="ShowActorInfo.php">Actor Information</a>
        <a href="ShowMovieInfo.php">Movie Information</a>
      </div>
    </div>
    <div class="dropdown3" >
      <button class="dropbtn3">Search Database</a></button>
      <div class="dropdown-content3">
        <a href="search.php">Actor or Movie</a>
      </div>
    </div>
  </div>
<br><hr>
<h2>Add a Comment to the Database</h2>
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
