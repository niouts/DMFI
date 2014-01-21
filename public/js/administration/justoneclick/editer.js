$(document).ready(function(){
	 
	 $('.Form .annuler').click(function() {
		 var referrer =  document.referrer;
		 if (!referrer) {
			 aAdresse = document.URL.split("/");
			 referrer = aAdresse.slice(0,5).join("/");
		 }
		 window.location = referrer;
	 });
	
});