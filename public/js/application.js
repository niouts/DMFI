$(document).ready(function(){
	
	objTinymce = {
		// General options
		mode : "textareas",
		theme : "advanced",
		language : 'fr',
		plugins : "autolink,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups," +
				"insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable," +
				"visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
	
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,cut,copy,paste,pastetext,pasteword,|,undo,redo,|,bold,italic,underline,strikethrough," +
				"|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor",
		theme_advanced_buttons2 : "print,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,ltr,rtl,|" +
				",insertdate,sub,sup,|,charmap,iespell,advhr,|,link,unlink,anchor,image,media,|,code,preview",
		theme_advanced_buttons3 : "tablecontrols,hr,removeformat,visualaid,|,insertlayer,moveforward,movebackward,absolute,|,styleprops," +
				"|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		theme_advanced_default_foreground_color : "#333333",
		theme_advanced_text_colors : "#FFFFFF,#F6F6F6,#EEEEEE,#DDDDDD,#CCCCCC,#999999,#666666,#444444,#333333,#000000," +
				"#FF6600,#FFCC00,#FF9900,#D63300,#F8ECDF,#FDE0C2",
		theme_advanced_more_colors : false,
		theme_advanced_background_colors: "#FFFFFF,#F6F6F6,#EEEEEE,#DDDDDD,#CCCCCC,#999999,#666666,#444444,#333333,#000000," +
			"#FF6600,#FFCC00,#FF9900,#D63300,#F8ECDF,#FDE0C2",
		
		theme_advanced_font_sizes : "8px,10px,12px,14px,16px,18px,24px,32px,38px,56px",
		theme_advanced_fonts : "Arial=arial,sans-serif;" +
				"Helvetica Thin='Conv_HelvNeue35',arial;" +
				"Helvetica Light='Conv_HelvNeue45',arial;" +
				"Helvetica Medium='Conv_HelvNeue65',arial;" +
				"Helvetica Bold='Conv_HelvNeue75',arial",
		file_browser_callback: 'openKCFinder',
		relative_urls: false,
		width:940,
		
		theme_advanced_resize_horizontal : false,
		
		plugin_preview_width : "940",

		style_formats : [
		 				{title: 'Titre 1', block: 'h1'},
		 				{title: 'Titre 2', block: 'h2'},
		 				{title: 'Titre 3', block: 'h3'},
		 				{title: 'Paragraphe', inline: 'p'},
		 		        {title: 'Bouton', block: 'div', classes: 'bouton' },
		 		        {title: 'Titre Principal', inline : 'span', styles : {'font-family':'"Conv_HelvNeue35",arial','font-size': '56px','color':'#666'}},
		 				{title: 'Titre Large 46', inline : 'span', styles : {'font-family':'"Conv_HelvNeue35",arial','font-size': '46px','color':'#666'}},
		 				{title: 'Titre Large 42', inline : 'span', styles : {'font-family':'"Conv_HelvNeue35",arial','font-size': '42px','color':'#666'}},
		 				{title: 'Titre Large 38', inline : 'span', styles : {'font-family':'"Conv_HelvNeue35",arial','font-size': '38px','color':'#666'}},
		 				{title: 'Titre Medium', inline : 'span', styles : {'font-family':'"Conv_HelvNeue45",arial','font-size': '36px','color':'#666'}},
		 				{title: 'Titre 30', inline : 'span', styles : {'font-family':'"Conv_HelvNeue45",arial','font-size': '30px','color':'#666'}},
		 				{title: 'Titre 26', inline : 'span', styles : {'font-family':'"Conv_HelvNeue45",arial','font-size': '26px','color':'#666'}},
		 				{title: 'Titre 24', inline : 'span', styles : {'font-family':'"Conv_HelvNeue45",arial','font-size': '24px','color':'#666'}},
		 				{title: 'Sous Titre', inline : 'span', styles : {'font-family':'arial','font-weight':'bold','font-size': '16px','color':'#666'}},
		 				{title: 'normal', inline : 'span', styles : {'font-family':'arial','font-size': '12px','color':'#333'}},
		 				{title: 'Orange', inline : 'span', classes: 'hightlight'},
		 				{title: 'lien', inline : 'span', classes: 'lien'}
		 				],
		template_templates : [
		                {title : "Editor Details",src : '/Tinymce_templates/edito.html',description : "Adds Editor Name and Staff ID"}
		                ],
		content_css : "/css/application.css"	
	};

	
	// Table
	$.extend( $.fn.dataTable.defaults, {
		"oLanguage": {
			"sProcessing": "Patientez...",
			"sLengthMenu": " résultats par page _MENU_",
			"sZeroRecords": "Aucun élément à afficher",
			"sInfo": "_TOTAL_ résultats",
			"sInfoEmpty": "0 à 0 sur 0 résultats",
			"sInfoFiltered": "(filtrée de _MAX_ entrées au total )",
			"sInfoPostFix": "",
			"sSearch": "Rechercher",
			"sUrl": "",
			"oAria": {  },
			"oPaginate": {
				"sFirst":    '',
				"sPrevious": '',
				"sNext":     '',
				"sLast":     ''
			}},
		"sPaginationType": "full_numbers",
		"bPaginate": true,
		"iDisplayLength": 20,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true,
        "pRocessing":true,	        
        "bStateSave": false,
        "sDom": '<"recherche"f>tp<"clear">'
	} );
	
	
	// Tabs
	$('.tab-content').css('display', 'none');
	$('.tabs li.actif').each(function(){
		$($(this).find('a').attr('rel')).css('display', 'block');
	});
	$('.tabs li a').click(function(){
		$('.tab-content').css('display', 'none');
		$($(this).attr('rel')).css('display', 'block');
		$(this).parent().parent().find('li').removeClass('actif');
		$(this).parent().addClass('actif');
	});
	
	
	// Btn annuler
	$('.Form .annuler').click(function() {
		 var referrer =  document.referrer;
		 if (!referrer) {
			 aAdresse = document.URL.split("/");
			 referrer = aAdresse.slice(0,5).join("/");
		 }
		 window.location = referrer;
	 });
	
	// Btn delete
	$('.btn_delete').on('click',function(){
		if(!confirm('Attention, la suppression est définitive !\nsouhaitez-vous continuer ?')) {
			return false;
		}
	});
	
	
	
});


jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-uk-pre": function ( a ) {
    	if (a == '&nbsp;')
    		return 0;
    	var ukDatea = a.split('/');
        return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
    }, 
    "date-uk-asc": function ( a, b ) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    }, 
    "date-uk-desc": function ( a, b ) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
});

function openKCFinder(field_name, url, type, win) {
    tinyMCE.activeEditor.windowManager.open({
        file: '/js/library/kcfinder-2.51/browse.php?opener=tinymce&type='+type+'&dir='+type+'/'+$('#controller').val()+'/' + $('#id').val(),
        title: 'KCFinder',
        width: 700,
        height: 500,
        resizable: "yes",
        inline: true,
        close_previous: "no",
        popup_css: false
    }, {
        window: win,
        input: field_name
    });
    return false;
};