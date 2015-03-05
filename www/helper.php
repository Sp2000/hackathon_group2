<?php
function getTaxonName ($key) {
    include 'connect.php';
    $stmt = $dbh->prepare('select scientificName from comparison where gbifKey = ?');
    $stmt->execute(array($key));
    $name = $stmt->fetchColumn();
    unset($dbh);
    return $name;
}