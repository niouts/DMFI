$(document).ready(function(){
	$('nav > ul > li > a.droite').parent().css('float','right');
	
	$('nav > ul > li.active').find('ul').css('display', 'block');	
	$('nav > ul > li > a').mouseenter(function(){
		$('nav > ul > li.active').find('ul').css('display', 'none');
	});
	$('nav > ul > li.active').mouseenter(function(){
		$(this).find('ul').css('display', 'block');
	});	
	$('nav > ul').mouseleave(function(){
		$('nav > ul > li.active').find('ul').css('display', 'block');
	});
	
	
	$('.deconnexion').mouseenter(function(){
		$(this).addClass('ouvert');
		$('#blocUtilisateur').css('display', 'block');
		
		$('#blocUtilisateur').mouseenter(function(){
			$('*').unbind('mouseleave.blocUtilisateur');
			$(this).addClass('ouvert');
			$('#blocUtilisateur').css('display', 'block');
			$('#blocUtilisateur').mouseleave(function(){
				$(this).removeClass('ouvert');
				$('#blocUtilisateur').css('display', 'none');
			});
		});
		
		$('*').bind('mouseleave.blocUtilisateur',function(){
			$('.deconnexion').removeClass('ouvert');
			$('#blocUtilisateur').css('display', 'none');
		});		
	});
});