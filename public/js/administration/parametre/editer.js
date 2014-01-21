$(document).ready(function(){
	
	tinyMCE.init(
			tinymce.extend(objTinymce,{height:"500",width:846})
		);

	$('#valeur').parents(".ligne").after('<div class="ligne"><button type="button" id="btn_apercu" name="btn_apercu" class="'+$('#bloc').val()+'" >aperçu</button><div id="apercu" class="'+$('#bloc').val()+'"></div></div>');

	$(document).on('click','#btn_apercu',function(){ 
		$('#apercu').html(tinymce.get('valeur').getContent());
	})
	
});