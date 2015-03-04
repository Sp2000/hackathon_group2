/**
 *
 */

function annotate (id, gbifKey) {
	$.ajax({
	  url: "ajax.php?annotate=" + gbifKey
	}).done(function() {
	  $("tr#id_" + id).addClass("marked");
	});
	return;
}