<!--
PHP file using a textarea to receive a query from the user and display the results after interacting with MySQL.
-->

<!DOCTYPE html>
<html>
<head><title>CS143 Project 1B Show Actor Info</title></head>
<body>
<h1>Show an Actor's Information</h1>

<?php
        $db_connection = mysql_connect("localhost", "cs143", "");
        if(!$db_connection) {
          $errmsg = mysql_error($db_connection);
          print "Connection failed: $errmsg <br />";
          exit(1);
        }
        mysql_select_db("CS143", $db_connection);
        $actor_lastname = "Aaron";
        $actor_firstname= $_GET['actor_firstname'];
        print "The actor's first name is " .$actor_firstname ."<br>";
        print "The actor's last name is " .$actor_lastname. "<br>";
        mysql_close($db_connection);
?>
<h3>Actor Information</h3>
<?php print "Actor: " . $actor_firstname . " " . $actor_lastname ."<br/>";?>

</body>
</html>
