<!--
movie2: 1776, 1972
-->

<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Show Movie Info</title></head>
<body>
<h1>Show a Movie's Information</h1>

<?php
        $db_connection = mysql_connect("localhost", "cs143", "");
        if(!$db_connection) {
          $errmsg = mysql_error($db_connection);
          print "Connection failed: $errmsg <br />";
          exit(1);
        }
        mysql_select_db("CS143", $db_connection);
        $movie_title = "1999";
        $movie_year = "1998";
        $actor_firstname = "Caroline";
        $actor_lastname = "Aaron";
        print "The movie's title is " .$movie_title ."<br>";
        print "The movie's year is " .$movie_year. "<br>";
        print "The lead actor is ".$actor_firstname." ".$actor_lastname."<br>";
        mysql_close($db_connection);

?>
<h3>Movie Information</h3>
<?php
  print "Movie: " . $movie_title . "<br>";
  print "Released: " . $movie_year ."<br/>";
  print "Lead Actor: ".$actor_firstname." ".$actor_lastname."<br>";
?>
<p><a href="ShowActorInfo.php?actor_firstname=<?php echo $actor_firstname?>&actor_lastname=<?php echo $actor_lastname?>">Actor</a></p>
</body>
</html>
