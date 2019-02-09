<!--
PHP file using a textarea to receive a query from the user and display the results after interacting with MySQL.
-->

<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Show Movie Info</title></head>
<body>
<h1>Show a Movie's Information</h1>
<h3>Movie Information</h3>
<?php
        $db_connection = mysql_connect("localhost", "cs143", "");
        if(!$db_connection) {
          $errmsg = mysql_error($db_connection);
          print "Connection failed: $errmsg <br />";
          exit(1);
        }

        mysql_select_db("CS143", $db_connection);

        $movie_id= $_GET['mid'];
        $query = "select * from Movie where id=".$movie_id;
        $movie_info = mysql_query("$query");
        $num_rows = mysql_num_rows($movie_info);
        if(is_null($num_rows)) {
          print "Need more information--parameters given do not return a movie<br>";
        }
        else {

          echo "<p>";
          $row = mysql_fetch_row($movie_info);
          echo "Title: ".$row[1]."<br>";
          echo "Company: ".$row[4]."<br>";
          echo "Rating: ".$row[3]."<br>";
          $query = "select did from MovieDirector where mid=".$movie_id;
          $did = mysql_query("$query");
          $isolate_did = mysql_fetch_row($did);
          $query = "select first, last from Director where id=".$isolate_did[0];
          $director_name = mysql_query("$query");
          $isolate_director_name = mysql_fetch_row($director_name);
          echo "Director: ".$isolate_director_name[0]." ".$isolate_director_name[1]."<br>";
          $query = "select genre from MovieGenre where mid=".$movie_id;
          $movie_genres = mysql_query("$query");
          echo "Genre: ";
          $first = True;
          while($isolate_movie_genres = mysql_fetch_row($movie_genres))
          {
            if($first){
              echo $isolate_movie_genres[0];
              $first = False;
            }
            else {
              echo ", ".$isolate_movie_genres[0];
            }
          }
          echo "<br>";
          echo "</p>";

          echo "<br><hr>";

          echo "<h3>Actors in this Movie</h3>";

          $query = "select aid, role from MovieActor where mid=".$movie_id;
          $movieactor_info = mysql_query("$query");
          $num_rows = mysql_num_rows($movieactor_info);
          if(is_null($num_rows)) {
            print "<p>This movie has no listed actors.</p>";
          }
          else {
            echo "<table border='1'>";
            echo "<tr><th>name</th><th>role</th></tr>";
            while($row = mysql_fetch_row($movieactor_info))
            {
                $test="select first,last from Actor where id =".$row[0];
                $actor_name = mysql_query("$test");
                $isolate_actor_name = mysql_fetch_row($actor_name);
                echo "<tr>";
                echo "<td align='center'><a href='ShowActorInfo.php?aid=".$row[0]."'>".$isolate_actor_name[0]." ".$isolate_actor_name[1]."</a></td>";
                echo "<td align='center'>".$row[1]."</td>";
                echo "</tr>";
            }
            echo "</table>";
          }

        }

        mysql_close($db_connection);
?>

</body>
</html>
