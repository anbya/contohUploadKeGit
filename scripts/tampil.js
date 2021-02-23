$(document).ready(function() {
    selesai();
});

function selesai() {
	setTimeout(function() {
		update();
		selesai();
	}, 200);
}

function update() {
	$.getJSON("tampil.php", function(data) {
		$("tr").empty();
		$.each(data.result, function() {
			$("tr").append("<td>"+this['kditem']+"</td><td>"+this['qty']+"</td><td>"+this['grandprice']+"</td><br />");
		});
	});
}