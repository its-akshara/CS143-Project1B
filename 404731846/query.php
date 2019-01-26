<!--
PHP file using a textarea to receive a query from the user and display the results after interacting with MySQL.
-->

<?php
	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("CS143", $db_connection);
	$result = mysql_query("select * from MovieRating where mid=4729;");
	while($row = mysql_fetch_row($result))
	{
		$mid=$row[0];
		$imdb=$row[1];
		$rot=$row[2];
		print "$mid, $imdb, $rot<br/>";
	}
	mysql_close($db_connection);
?>


<!DOCTYPE html>
<html>
<head><title>CS143 Project 1A Demo</title></head>
<body>
<p>
Created by: Akshara Sundararajan and Rubia Liu
<br>
Enter a select query.
<p>
<form action="query.php" method="GET">
   <textarea name="query" cols="60" rows="8"><?php print "$query" ?></textarea><br />
   <input type="submit" value="Submit" />
</form>
</p>
<p><small>Note: tables and fields are case sensitive.</small>
</p>


</body>
</html>
