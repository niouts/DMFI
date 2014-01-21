$(document).ready(function(){
	 $('#pwd1').change(function(){
		 $('#imgPwd1').remove();
		 if ($(this).val()) {
			 $('#valider').css("color", "#999");
			 $('#valider').attr('disabled', 'disabled');
			 $(this).parent().append('<img id="imgPwd1" class="notification" src="/images/valide.png" title="valide" />');
			 
			 if ($('#pwd2').val()) { 
				 $('#pwd2').change(); 
			 }
		 }
	 });
	 
	 $('#pwd2').change(function(){
		 $('#imgPwd2').remove();
		 if ($(this).val() ==  $('#pwd1').val() ) {
			 $('#valider').css("color", "#fff");
			 $('#valider').removeAttr('disabled');
			 $(this).parent().append('<img id="imgPwd2" class="notification" src="/images/valide.png" title="valide" />');
		 } else {
			 $('#valider').css("color", "#999");
			 $('#valider').attr('disabled', 'disabled');
			 $(this).parent().append('<img id="imgPwd2" class="notification" src="/images/invalide.png" title="invalide" />');
		 }
	 });
	 
	 $('#utilisateur_form').submit(function(){
		 if ( $('#pwd1').val() && $('#pwd1').val() !=  $('#pwd2').val()) {
			 alert("le nouveau mot de passe est mal confirmé !")
			 return false;
		 }
	 });
	 
	 $('.Form .annuler').click(function() {
		 var referrer =  document.referrer;
		 if (!referrer) {
			 aAdresse = document.URL.split("/");
			 referrer = aAdresse.slice(0,5).join("/");
		 }
		 window.location = referrer;
	 })
	 
	 $('#pro_id').change(function(){
		 toggleRubriques();
	 });
	 toggleRubriques();
	 
});

function toggleRubriques(){ 
	$('div[id^="rub"]').removeClass('masquer');
	if ($('#pro_id option:selected').text().toUpperCase() == 'ADMINISTRATEUR') {
		$('div[id^="rub"]').addClass('masquer');
	}
}