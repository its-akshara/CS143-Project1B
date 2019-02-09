

<!DOCTYPE html>
<html>
<head>
  <title>CS143 Project 1B Demo</title>
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
<h2>Search For a Movie or Actor</h2>
<p>Enter a keyword:
<form action="search.php" method="POST">
   <input type ="text" name="input" size=20 maxlength=60>
   <input type="submit" value="Submit" >
</form>


<?php
        $db_connection = mysql_connect("localhost", "cs143", "");
        mysql_select_db("CS143", $db_connection);
        $input = trim(htmlspecialchars($_POST['input']));
        $keywords = preg_split("/[\s,]+/",$input);
        $arrlength = count($keywords);
        if(isset($arrlength) && ($arrlength > 0) && ($keywords[0]!="")) {
          $query = "select * from Actor where";
          for($x = 0; $x < $arrlength; $x++) {
            $query=$query." concat(first,' ',last) like '%".$keywords[$x]."%'";
            if($x !== $arrlength-1) {
              $query=$query." and ";
            }
          }
          $actors_found = mysql_query("$query");

          $query = "select id,title,year from Movie where ";
          for($x = 0; $x < $arrlength; $x++) {
            $query=$query."title like '%".$keywords[$x]."%'";
            if($x !== $arrlength-1) {
              $query=$query." and ";
            }
          }
          $movies_found = mysql_query("$query");

          echo "<br><hr>";
          echo "<h3>Found Actors by name</h3>";
          echo "<table border='1'>";
          echo "<tr><th>id</th><th>name</th><th>sex</th><th>dob</th><th>dod</th></tr>";
          while($row = mysql_fetch_row($actors_found))
          {
              echo "<tr>";
              echo "<td align='center'>".$row[0]."</td>";
              echo "<td align='center'>
              <a href='ShowActorInfo.php?aid=".$row[0]."'>".$row[2]." ".$row[1]."</a></td>";
              echo "<td align='center'>".$row[3]."</td>";
              echo "<td align='center'>".$row[4]."</td>";
              echo "<td align='center'>".$row[5]."</td>";
  	          echo "</tr>";
          }
          echo "</table>";

          echo "<br><hr>";
          echo "<h3>Found movies by title</h3>";
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
</p>
</body>
</html>
