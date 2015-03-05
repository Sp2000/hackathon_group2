<?php
require_once 'helper.php';

if (isset($_GET['annotate']) && !empty($_GET['annotate'])) {
    annotate((int)$_GET['annotate']);
}

function annotate ($key) {

    $url = 'http://127.0.0.1:10080/services/annotations?';
    $data = array(
        'taxonInScopeUri' => 'http://www.gbif.org/species/' . $key,
        'taxonInScopeName' => getTaxonName($key),
        'comment' => 'test1'
    );
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($ch);
    if (!$response) {
        return false;
    }

    return true;
/*
 * curl -i -H "Accept: application/json" -X PUT http://127.0.0.1:10080/services/annotations\?taxonInScopeUri\=http://www.gbif.org/species/1097026\&taxonInScopeName\=Prionus%2BGeoffroy%2C%201762&comment=test1
 */
}


