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
            $alphabet .= $letter[0] . ' | ';
        } else {
            $alphabet .= '<a href="?letter=' . $letter[0] . '">' . $letter[0] . '</a> | ';
        }
    }
    unset($dbh);

    return substr($alphabet, 0, -3);
}

function getLetter () {
    if (isset($_GET['letter']) && !empty($_GET['letter'])) {
        return (string)$_GET['letter'];
    }
    return 'A';
}

function storeAnnotation ($key, $json) {
    include 'connect.php';
    $stmt = $dbh->prepare('update comparison set annotation = ? where gbifKey = ?');
    $stmt->execute(array($json, $key));
    unset($dbh);
}

function printAnnotation ($json) {
    if (!$json || empty($json)) {
        return '';
    }
    $data = json_decode($json);
    return '<a href="' . $data->repositoryURI . '" target="annotation">' .
        $data->repositoryURI . ": " . urldecode($data->statement) . '</a>';
}