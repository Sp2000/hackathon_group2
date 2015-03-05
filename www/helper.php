<?php
function getTaxonName ($key) {
    include 'connect.php';
    $stmt = $dbh->prepare('select scientificName from comparison where gbifKey = ?');
    $stmt->execute(array($key));
    $name = $stmt->fetchColumn();
    unset($dbh);
    return $name;
}

function setAlphabet () {
    include 'connect.php';
    $stmt = $dbh->query('select distinct left(scientificname, 1) from comparison');
    $letters = $stmt->fetchAll(PDO::FETCH_NUM);

    $alphabet = '';
    foreach ($letters as $letter) {
        if (isset($_GET['letter']) && strtolower($_GET['letter']) == strtolower($letter[0])) {
            $alphabet .= utf8_decode($letter[0]) . ' | ';
        } else {
            $alphabet .= '<a href="?letter=' . $letter[0] . '">' . utf8_decode($letter[0]) . '</a> | ';
        }
    }

    return substr($alphabet, 0, -3);
}

function getLetter () {
    if (isset($_GET['letter']) && !empty($_GET['letter'])) {
        return (string)$_GET['letter'];
    }
    return 'A';
}