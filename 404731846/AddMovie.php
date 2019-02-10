<!-- Get information required to add a movie to the database -->
<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Add Movie</title>
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
<h2>Add a Movie to the Database</h2>
<p>
<br>
Enter the following information about the movie you want to add.
</p>
<p>
<form action="AddMovie.php" method="POST">
    Movie title: <input type="text" name="title"><br>
    Release year (YYYY): <input type="number" name="year" min="1900" max="2019"><br>
    MPAA rating: <input type="radio" name="rating" value="G">G
    <input type="radio" name="rating" value="NC-17">NC-17
    <input type="radio" name="rating" value="PG">PG
    <input type="radio" name="rating" value="PG-13">PG-13
    <input type="radio" name="rating" value="R">R
    <input type="radio" name="rating" value="surrendere">surrendere
    <br>
    Production Company: <input type="text" name="company"><br>
    Genre: <input type="checkbox" name="genre" value="Drama">Drama
    <input type="checkbox" name="genre[]" value="Comedy">Comedy
    <input type="checkbox" name="genre[]" value="Romance">Romance
    <input type="checkbox" name="genre[]" value="Crime">Crime
    <input type="checkbox" name="genre[]" value="Horror">Horror
    <input type="checkbox" name="genre[]" value="Mystery">Mystery
    <input type="checkbox" name="genre[]" value="Thriller">Thriller
    <br>
    <input type="checkbox" name="genre[]" value="Action">Action
    <input type="checkbox" name="genre[]" value="Adventure">Adventure
    <input type="checkbox" name="genre[]" value="Fantasy">Fantasy
    <input type="checkbox" name="genre[]" value="Documentary">Documentary
    <input type="checkbox" name="genre[]" value="Family">Family
    <input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi
    <input type="checkbox" name="genre[]" value="Animation">Animation
    <br>
    <input type="checkbox" name="genre[]" value="Musical">Musical
    <input type="checkbox" name="genre[]" value="Western">Western
    <input type="checkbox" name="genre[]" value="War">War
    <input type="checkbox" name="genre[]" value="Adult">Adult
    <input type="checkbox" name="genre[]" value="Short">Short
    <br>
    <b>Associate Actor with New Movie (Optional)</b>
    <br>
    Role: <input type="text" name="role"><br>
    Actor first name: <input type="text" name="first"><br>
    Actor last name: <input type="text" name="last"><br>
   <input type="submit" value="Add movie!" />
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
$year = $_POST['year'];
$rating = $_POST['rating'];
$company = $_POST['company'];
$first = $_POST['first'];
$last = $_POST['last'];
$role = $_POST['role'];

// Receive id info
$id_query = "Select id from MaxMovieID;";
if($maxID = $conn->query($id_query))
{
    $row = $maxID->fetch_assoc();

    $newIDmax = $row["id"] + 1;

    $update = "update MaxMovieID set id = id+1;";

    if ($conn->query($update) === FALSE)
    {
       echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $query = "insert into Movie values($newIDmax,'$title',$year,'$rating','$company');";
   $conn->query($query) or die($conn->error());

    foreach($_POST['genre'] as $genre)
    {
       $addgenre = "insert into MovieGenre values($newIDmax,'$genre');";
       $conn->query($addgenre) or die($conn->error());
    }

    $aid_query = "select id from Actor where first='$first' and last='$last';";
    $AID = $conn->query($aid_query);
    $rowA = $AID->fetch_assoc();
    $aid = $rowA["id"];
    $query = "insert into MovieActor values($newIDmax,$aid,'$role');";
    $conn->query($query) or die($conn->error());


}

$maxID->free();



$conn->close();
?>
