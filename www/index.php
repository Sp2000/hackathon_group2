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
error_reporting(E_ALL);
ini_set("display_errors", 1);

print_r( json_decode('{"repositoryURI":"http://127.0.0.1:10080/services/annotations/BGBM/AnnoSys/1425550201320","annotator":"","time":1425550201383,"motivation":"TaxonConcept","comment":"http://rs.gbif.org/terms/ao#ImplausibleDistribution","target":"http://www.gbif.org/species/4988750","scientificName":"Abax Bonelli, 1810"}'));
die();

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

<p>Select a letter from the alphabet below to display all taxa for that letter:</p>

<p><?php echo setAlphabet(); ?>

<form>
<table style="margin-top: 25px; width: 1000px;">
<tr><th>Name</th><th>Map at GBIF</th><th>Blackist</th><th>Message</th></tr>

<?php
$q = 'select * from comparison where inNsr = 0 and scientificName like ? order by scientificName';
$stmt = $dbh->prepare($q);
$stmt->execute(array(getLetter() . '%'));
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr id="id_' . $row['id'] . '"><td class="name">' . $row['scientificName'] . "</td>
        <td><a href='http://www.gbif.org/species/" . $row['gbifKey'] . "#map' target='_blank'>map</a></td>
        <td><input type='checkbox' onclick='annotate(" . $row['id'] . "," . $row['gbifKey'] . ")'/></td>
        <td class=\"annotation_message\">" . printAnnotation($row['annotation']) . "</td></tr>\n";
}
?>
</form>
</body>
</html>
<!--
data:

{"repositoryURI":"http://127.0.0.1:10080/services/annotations/BGBM/AnnoSys/1425550201320","annotator":"","time":1425550201383,"motivation":"TaxonConcept","comment":"http://rs.gbif.org/terms/ao#ImplausibleDistribution","target":"http://www.gbif.org/species/4988750","scientificName":"Abax Bonelli, 1810"}
--->