<!DOCTYPE html>
<head>
<title>Annotate the Dutch species list</title>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="scripts/lib.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<?php
require_once 'connect.php';
require_once 'helper.php';
require_once 'ajax.php';

$stmt = $dbh->query('select count(*) from comparison where inNsr = 1');
$matched = $stmt->fetchColumn();
?>

<h1>Annotate GBIF records not occurring in Nederlandse Soortenregister</h1>
<p>The Dutch lists contains <?php echo $matched; ?> names that occur in
GBIF records for The Netherlands. This page lists the remaining GBIF names that
do not match with the Dutch list either as a valid name or a synonym.
Taxa that are not part of the native Dutch flora and fauna can be annotated
using the AnnoSys service.</p>

<form>
<table style="margin-top: 25px;">
<tr><th>Name</th><th>Map at GBIF</th><th>Blackist</th></tr>
<?php
$stmt = $dbh->query('select * from comparison where inNsr = 0 order by scientificName limit 0,1000');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr id="id_' . $row['id'] . '"><td>' . $row['scientificName'] . "</td>
        <td><a href='http://www.gbif.org/species/" . $row['gbifKey'] . "#map' target='_blank'>map</a></td>
        <td><input type='checkbox' onclick='annotate(" . $row['id'] . "," .
        $row['gbifKey'] . ")'/></td></tr>\n";
}
?>
</form>
</body>
</html>