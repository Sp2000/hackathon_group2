/**
 *
 */

function annotate (id, gbifKey) {
	$.ajax({
    dataType: "json",
	  url: "ajax.php?annotate=" + gbifKey
	}).success(function(data) {
	  $("#id_" + id).addClass("marked");
    $("#id_" + id + " .annotation_message").html(
      '<a href="' + data.repositoryURI + '" target="annotation">' + data.repositoryURI + ": " + decodeURIComponent(data.comment) + '</a>'
    );
    
	});
	return;
}