<!-- Get information required to add a relation between actor and movie to the database -->
<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Add Actor to Movie Relation</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
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
<h2>Add an Actor to Movie Relation to the Database</h2>
<p>
<font size=2>Created by: <i>Akshara Sundararajan</i> and <i>Rubia Liu</i></font>
<br>
Enter the following information about the relation you want to add.
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
        $query = "insert into MovieActor values($mid,$aid,'$role');";
        $conn->query($query) or die($conn->error());
    }

}

$ID->free();



$conn->close();
?>
