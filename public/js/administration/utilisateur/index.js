$(document).ready(function(){
	 $('.dataTable').dataTable({
			"aoColumnDefs": [{ "bSortable": false, "bSearchable": false, "aTargets":[-1]}]
		});
});