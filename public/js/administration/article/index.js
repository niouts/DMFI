$(document).ready(function(){
	 $('.dataTable').dataTable({
			"aoColumnDefs": [
			     {"bSortable": false, "bSearchable": false, "aTargets":[-1]}, 
			     {"sType": "date-uk", "aTargets":[0,1] }
			]
		});
});