$(document).ready(function(){
	$('.dataTable').dataTable({
		"aoColumnDefs": [{ "bSearchable": false, "aTargets":[-1,-2]}],
		"bSort": false
	});
	
	$(document).on("click", "div [id^='m_']", function(){
		
		id = $(this).attr('id').replace('m_','');
		trId = parseInt($(this).parents('tr').attr('id'));
		
		if (trId == 1){
			return false;
		}

		$.ajax({
			   type:"POST",
			   url:"/administration/justoneclick/changerordre",
			   data:"bouger=monter&id="+id,
			   success: function(retour){
				   	if (retour) {
						trNext = $('#'+(trId-1)).html();
						
						$('#'+(trId-1)).html( $('#'+trId).html() );
						$('#'+(trId)).html(trNext);
				   	}
			       }
			    });
	});
	
	$(document).on("click", "div [id^='d_']", function(){
		id = $(this).attr('id').replace('d_','');
		trId = parseInt($(this).parents('tr').attr('id'));

		if ( !$('#'+(trId+1)).html() ){
			return false;
		}

		$.ajax({
			   type:"POST",
			   url:"/administration/justoneclick/changerordre",
			   data:"bouger=descendre&id="+id,
			   success: function(retour){
				   	if (retour) {
						trNext = $('#'+(trId+1)).html();
						
						$('#'+(trId+1)).html( $('#'+trId).html() );
						$('#'+(trId)).html(trNext);
				   	}
			       }
			    });
	});
	 
});