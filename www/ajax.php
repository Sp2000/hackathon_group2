<?php
if (isset($_GET['annotate']) && !empty($_GET['annotate'])) {
    annotate((int)$_GET['annotate']);
}

function annotate ($key) {
    return true;
/*
 * curl -i -H "Accept: application/json" -X PUT http://127.0.0.1:10080/services/annotations\?taxonInScopeUri\=http://www.gbif.org/species/1097026\&taxonInScopeName\=Prionus%2BGeoffroy%2C%201762&comment=test1
 */
}