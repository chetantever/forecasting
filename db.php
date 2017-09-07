<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
border: 1px solid black;
border-collapse: collapse;
}
th, td {
padding: 5px;
text-align: left;
}
</style>
</head>
<body>
<a href="index.html" target="_blank">Home</a>
<br/><br/>
<?php
echo "<h3>Report</h3>";
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
echo $fromdate;
echo "<br>";
echo $todate;

$servername = "localhost";
$username = "root";
$password = "";
$filename = "forecasting.sql";

mysql_connect($servername, $username, $password) or die('Could not connect to database: ' . mysql_error());
mysql_select_db('pesit');
$lines = file($filename);
foreach ($lines as $line) {
	mysql_query($line) or die('Could not execute query: ' . $line . 'Error:' . mysql_error());
}

#$query = "select * from Q8";
$query = "select q8.BOOK_ID,book.title,book.publisher_name,q8.N_BOOKS,q8.TOTAL_EXISTING,q8.TOTAL_REQUIRED from q8,book where q8.BOOK_ID=book.book_id";
$qry_result = mysql_query($query) or die(mysql_error());

//Build Result String
$display_string = "<table>";
$display_string .= "<tr>";
$display_string .= "<th>BOOK ID</th>";
$display_string .= "<th>TITLE</th>";
$display_string .= "<th>PUBLISHER NAME</th>";
$display_string .= "<th>N(BOOKS)</th>";
$display_string .= "<th>TOTAL NO OF EXISTING BOOKS</th>";
$display_string .= "<th>TOTAL BOOKS REQUIRED</th>";
$display_string .= "</tr>";

 // Insert a new row in the table for each person returned
while($row = mysql_fetch_array($qry_result)) {
  $display_string .= "<tr>";
  $display_string .= "<td>$row[BOOK_ID]</td>";
  $display_string .= "<td>$row[title]</td>";
  $display_string .= "<td>$row[publisher_name]</td>";
  $display_string .= "<td>$row[N_BOOKS]</td>";
  $display_string .= "<td>$row[TOTAL_EXISTING]</td>";
  $display_string .= "<td>$row[TOTAL_REQUIRED]</td>";
  $display_string .= "</tr>";
}
$display_string .= "</table>";
echo $display_string;
?>
<br/><br/><br/>

</body>
</html>