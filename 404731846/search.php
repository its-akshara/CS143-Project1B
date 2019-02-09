

<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Demo</title></head>
<body>
<h1>Search For a Movie or Actor</h1>
Enter a keyword:
<form action="search.php" method="POST">
   <input type ="text" name="input" size=20 maxlength=60>
   <input type="submit" value="Submit" >
</form>
</p>

<?php
        $db_connection = mysql_connect("localhost", "cs143", "");
        mysql_select_db("CS143", $db_connection);
        $input = trim(htmlspecialchars($_POST['input']));
        $keywords = preg_split("/[\s,]+/",$input);
        $arrlength = count($keywords);
        if(isset($arrlength)) {
          $query = "select id,title,year from Movie where ";
          for($x = 0; $x < $arrlength; $x++) {
            $query=$query."title like '%".$keywords[$x]."%'";
            if($x !== $arrlength-1) {
              $query=$query." and ";
            }
          }
          echo "<br><hr>";
          echo "<h3>Found Actors by first/last name</h3>";
          echo "<br><hr>";
          echo "<h3>Found movies by title</h3>";
          $movies_found = mysql_query("$query");
          echo "<table border='1'>";
          echo "<tr>";
          while ($i < mysql_num_fields($movies_found))
          {
  		        $col = mysql_fetch_field($movies_found, $i);
  		        echo "<th>".$col->name."</th>";
  		        $i++;
  	      }
          echo "</tr>";

          while($row = mysql_fetch_row($movies_found))
          {
              echo "<tr>";
              echo "<td align='center'>".$row[0]."</td>";
              echo "<td align='center'><a href='ShowMovieInfo.php?mid=".$row[0]."'>".$row[1]."</a></td>";
              echo "<td align='center'>".$row[2]."</td>";
  	          echo "</tr>";
          }
          echo "</table>";
        }
        mysql_close($db_connection);
?>

</body>
</html>
