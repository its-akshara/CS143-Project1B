<!-- Get information required to add a movie to the database -->
<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Add Movie</title></head>
<body>
<h1>Add a Movie to the Database</h1>
<p>
<font size=2>Created by: <i>Akshara Sundararajan</i> and <i>Rubia Liu</i></font>
<br>
Enter the following information about the movie you want to add.
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
    Genre: <input type="text" name="genre"><br>
    Role: <br>
    Actor name: <input type="text" name="actor"><br>
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
$genre = $_POST['genre'];

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

    $addgenre = "insert into MovieGenre values($newIDmax,'$genre');";
    $conn->query($addgenre) or die($conn->error());
}

$maxID->free();



$conn->close();
?>