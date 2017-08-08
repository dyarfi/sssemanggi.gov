$(function(){
	$( 'textarea.texteditor' ).ckeditor({toolbar:'Full'});
	$( 'textarea.texteditor' ).ckeditor({toolbar:'MyBasic',width:780});	
	$( 'textarea.MyBasic' ).ckeditor({toolbar:'MyBasic',width:780});
	$( 'textarea.MiniBasic' ).ckeditor({toolbar:'MiniBasic',width:670,height:400});
});
