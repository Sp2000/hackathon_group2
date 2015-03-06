<?php
require_once 'helper.php';

if (isset($_GET['annotate']) && !empty($_GET['annotate'])) {
    print annotate((int)$_GET['annotate']);
}

function annotate ($key) {

    $url = 'http://127.0.0.1:10080/services/annotations?';
    $data = array(
        'taxonInScopeUri' => 'http://www.gbif.org/species/' . $key,
        'taxonInScopeName' => getTaxonName($key),
        'statement' => 'http://rs.gbif.org/terms/ao#ImplausibleDistribution',
        'area' => 'http://rs.tdwg.org/ontology/voc/GeographicRegion.rdf#NET',
        // 'comment' => 'my comment ...' // optional !
    );
    $ch = curl_init($url . http_build_query($data) );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($ch);
    if ($response) {
        storeAnnotation($key, $response);
        return $response;
    }

    return false;
/*
 * curl -i -H "Accept: application/json" -X PUT http://127.0.0.1:10080/services/annotations\?taxonInScopeUri\=http://www.gbif.org/species/1097026\&taxonInScopeName\=Prionus%2BGeoffroy%2C%201762&comment=test1
 */
}


