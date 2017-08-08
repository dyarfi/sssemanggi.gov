/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */
/*
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links',  groups: [ 'mediaembed' ] },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';
	
	config.extraPlugins = 'mediaembed';
};
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
   	config.filebrowserBrowseUrl 		=  base_URL+'assets/grocery_crud/texteditor/kcfinder/browse.php?type=files';
   	config.filebrowserImageBrowseUrl =  base_URL+'assets/grocery_crud/texteditor/kcfinder/browse.php?type=images';
   	config.filebrowserFlashBrowseUrl =  base_URL+'assets/grocery_crud/texteditor/kcfinder/browse.php?type=flash';
   	config.filebrowserUploadUrl		=  base_URL+'assets/grocery_crud/texteditor/kcfinder/upload.php?type=files';
   	config.filebrowserFlashUploadUrl =  base_URL+'assets/grocery_crud/texteditor/kcfinder/upload.php?type=flash';
   	
   	// Medium config
   	CKEDITOR.config.toolbar_MiniBasic = [
		// { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
		//{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.		
		[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
		//'/',																					// Line break - next group will be placed in new line.
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ]}, 
	];

	/*
	//config.removeButtons = 'Underline,Subscript,Superscript';	
	//config.extraPlugins = 'colorbutton,colordialog';
	*/

   	CKEDITOR.config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links',  groups: [ 'mediaembed' ] },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		//{ name: 'about' }
	];

	CKEDITOR.config.extraPlugins = 'colorbutton,colordialog,htmlwriter';
	CKEDITOR.config.allowedContent = true;
	CKEDITOR.config.extraAllowedContent = 'div(*); p(*); section(*); ul(*) li(*); a(*); a[!href,target]; br(*); hr(*); p(*);';
	
};

CKEDITOR.on('instanceReady', function() {
	$.each( CKEDITOR.instances, function(instance) {
		// Additional Config ------ 
	 	CKEDITOR.instances[instance].updateElement();
	 	CKEDITOR.instances[instance].getData();
		//console.log(CKEDITOR.instances[instance].updateElement());
		// Additional Config ------ 		
		CKEDITOR.instances[instance].on("change", function(e) {
			for ( instance in CKEDITOR.instances )
		 	CKEDITOR.instances[instance].updateElement();
		 	CKEDITOR.instances[instance].getData();
	 	});
	});
});
