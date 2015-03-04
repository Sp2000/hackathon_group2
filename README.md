Hackathon Group 2
===================
Annotations group


see the [NOTES](./NOTES.md)


### example PUT request to the annosys to create a new taxon annotation

    curl -i -H "Accept: application/json" -X PUT http://127.0.0.1:10080/services/annotations\?taxonInScopeUri\=http://www.gbif.org/species/1097026\&taxonInScopeName\=Prionus%2BGeoffroy%2C%201762&comment=test1

response:
    {
      "repositoryURI":"http://127.0.0.1:10080/services/annotations/BGBM/AnnoSys/1425484577569",
      "annotator":"",
      "time":1425484577614,
      "motivation":"TaxonConcept",
      "comment":"test1",
      "target":"http://www.gbif.org/species/1097026"
    }
