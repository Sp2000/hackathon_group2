<?php
require_once 'connect.php';

$stmt = $dbh->query('select * from nsr');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo henk;
}