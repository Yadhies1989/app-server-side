const tableData = $("#tabelSaya");

$(document).ready(function () {
	tableData.DataTable({
		processing: true,
		serverSide: true,
		pageLength: 10,
		order: [],
		ajax: {
			url: "http://localhost/app-server-side/latihan/viewajax",
			type: "POST",
		},
		columnDefs: [
			{
				target: [-1],
				orderable: false,
			},
		],
	});
});
