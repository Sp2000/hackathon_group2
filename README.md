Hackathon Group 2
===================
Annotations group


see the [NOTES](./NOTES.md)


### example PUT request to the annosys to create a new taxon annotation

      curl -i -H "Accept: application/json" -X PUT http://127.0.0.1:10080/services/annotations\?taxonInScopeUri\=http://www.gbif.org/species/1097026\&taxonInScopeName\=Prionus+Geoffroy%2C%201762\&area\=\&comment\=http%3A%2F%2Frs.gbif.org%2Fterms%2Fao%23ImplausibleDistribution

response:

      {
        "repositoryURI":"http://127.0.0.1:10080/services/annotations/BGBM/AnnoSys/1425543850108",
        "annotator":"","time":1425543850147,"motivation":"TaxonConcept",
        "comment":"http://rs.gbif.org/terms/ao#ImplausibleDistribution",
        "target":"http://www.gbif.org/species/1097026",
        "scientificName":"Prionus Geoffroy, 1762"
      }
