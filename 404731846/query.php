<!--
PHP file using a textarea to receive a query from the user and display the results after interacting with MySQL.
-->

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

<?php
        $db_connection = mysql_connect("localhost", "cs143", "");
        mysql_select_db("CS143", $db_connection);
        print "Your query was:  ";
        $query =  $_GET['query'];
        print "$query <br/> <br/>";


        $result = mysql_query("$query");

        echo "<table border='1'>";
        echo "<tr>";
        while ($i < mysql_num_fields($result)) 
        {
		    $col = mysql_fetch_field($result, $i);
		    echo "<th>".$col->name."</th>";
		    $i++;
	}  
        echo "</tr>";

        while($row = mysql_fetch_row($result))
        {
            echo "<tr>";
            for($i=0; $i<mysql_num_fields($result); $i++)
	    {
		echo "<td align='center'>".$row[$i]."</td>";
	    }
	    echo "</tr>";	    
        }
        echo "</table>";
        mysql_close($db_connection);
?>
