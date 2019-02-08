<!-- Get information required to add a director or actor to the database -->
<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Add Actor/Director</title></head>
<body>
<h1>Add an Actor or Director to the Database</h1>
<p>
<font size=2>Created by: <i>Akshara Sundararajan</i> and <i>Rubia Liu</i></font>
<br>
Enter the following information about the Actor/Director you want to add.
<p>
<form action="AddActorOrDirector.php" method="POST">
    Person type: 
    <input type="radio" name="person" value="Actor">Actor
    <input type="radio" name="person" value="Director">Director
    <br>
    First Name: <input type="text" name="first"><br>
    Last Name: <input type="text" name="last"><br>
    Sex: 
    <input type="radio" name="sex" value="Female">Female  
    <input type="radio" name="sex" value="Male">Male 
    <input type="radio" name="sex" value="Other">Other    
    <br>
    Date of Birth (YYYY-MM-DD): <input type="text" name="dob"><br>
    Living?:<input type="radio" name="status" value="Alive">Alive
    <input type="radio" name="status" value="Dead">Dead
    <br>
    If dead, Date of Death (YYYY-MM-DD): <input type="text" name="dod"><br>
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

$first = $_POST['first'];
$last = $_POST['last'];
$sex = $_POST['sex'];
$dod = $_POST['dod'];
$dob = $_POST['dob'];
$status = $_POST["status"];
$person = $_POST['person'];

// Receive id info
$id_query = "Select id from MaxPersonID;";
if($maxID = $conn->query($id_query))
{
    $row = $maxID->fetch_assoc();
    
    $newIDmax = $row["id"] + 1;

    if($person === "Actor")
    {
        $query = ($status==="Alive"?"insert into Actor values($newIDmax,'$last','$first','$sex','$dob',NULL);":"insert into Actor values($newIDmax,'$last','$first','$sex','$dob','$dod');");
        $conn->query($query) or die($conn->error());
    }
    else if($person === "Director")
    {
        $query = ($status==="Alive"?"insert into Director values($newIDmax,'$last','$first','$dob',NULL);":"insert into Actor values($newIDmax,'$last','$first',$dob','$dod');");
        $conn->query($query) or die($conn->error());
    }
    $update = "update MaxPersonID set id = id+1;";

    if ($conn->query($update) === FALSE) 
    {
       echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$maxID->free();



$conn->close();
?>