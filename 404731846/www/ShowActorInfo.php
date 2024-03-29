<!--
PHP file using a textarea to receive a query from the user and display the results after interacting with MySQL.
-->

<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Show Actor Info</title>
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
<h2>Show an Actor's Information</h2>
<h3>Actor Information</h3>
<?php
        $db_connection = mysql_connect("localhost", "cs143", "");
        if(!$db_connection) {
          $errmsg = mysql_error($db_connection);
          print "Connection failed: $errmsg <br />";
          exit(1);
        }

        mysql_select_db("CS143", $db_connection);

        $actor_lastname = $_GET['actor_lastname'];
        $actor_firstname= $_GET['actor_firstname'];
        $actor_id= $_GET['aid'];

        if(isset($actor_id)) {
          $query = "select * from Actor where id=".$actor_id;
        }
        else {
          $query = "select * from Actor where last='".$actor_lastname."' and first ='".$actor_firstname."'";
        }

        $actor_info = mysql_query("$query");
        $num_rows = mysql_num_rows($actor_info);
        if($num_rows !== 1) {
          print "Need more information--parameters given do not return one actor<br>";
        }
        else {
          echo "<table border='1'>";
          echo "<tr>";
          while ($i < mysql_num_fields($actor_info))
          {
  		        $col = mysql_fetch_field($actor_info, $i);
  		        echo "<th>".$col->name."</th>";
  		        $i++;
  	      }
          echo "</tr>";
          while($row = mysql_fetch_row($actor_info))
          {
              echo "<tr>";
              $aid = $row[0];
              for($i=0; $i<mysql_num_fields($actor_info); $i++)
  	          {
  		            echo "<td align='center'>".$row[$i]."</td>";
  	          }
  	          echo "</tr>";
          }
          echo "</table>";


          echo "<br><hr>";

          echo "<h3>Actor's Movie(s) and Role(s)</h3>";

          $query = "select mid, role from MovieActor where aid='".$aid."'";
          $movieactor_info = mysql_query("$query");
          $num_rows = mysql_num_rows($movieactor_info);
          if($num_rows < 1) {
            print "<p>Actor is not in any movies.</p>";
          }
          else {
            echo "<table border='1'>";
            echo "<tr><th>title</th><th>role</th></tr>";
            while($row = mysql_fetch_row($movieactor_info))
            {
                $test="select title from Movie where id ='".$row[0]."'";
                $movie_title = mysql_query("$test");
                $isolate_title = mysql_fetch_row($movie_title);
                echo "<tr>";
                echo "<td align='center'><a href='ShowMovieInfo.php?mid=".$row[0]."'>".$isolate_title[0]."</a></td>";
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
