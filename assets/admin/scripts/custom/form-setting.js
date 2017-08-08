var FormSetting = function () {

	var handleSettingForm = function () {
		//====== Maintenance mode in setting listing
		$('form#maintenance_form').submit(function(){
		    //$(":checked").val()
		    var val  = $(this).find('input:checked').val();
		    var link = $(this).attr('action');
			    //alert(window.location);
			    //alert(val);
		    if (link){
			    var pid = $(this).attr('pid');
			    var hash = $(this).attr('hash');
			    $.ajax({
				type: 'POST',
				url: link,
				data: 'ajax=true&form=maintenance_form&mode='+val,
				datatype: "JSON",
				async: false,
				success: function(msg){
				    if (msg == 1) {
						alert('Please wait while updating data');
				    }
					setInterval(window.location.reload(),3000);
				},
				error: function (request,setting){
				}
			    });
			      //window.location = window.location;
		      //window.location.reload();
		    }
			    return false;
		});

		$('.maintenance_mode').change(function(){
			if ($(this).val() == 1) bootbox.alert("The site will be temporary off in maintenance mode. Click Submit to continue ");
		});

		//====== Maintenance mode in setting listing
		$('form#chat_mode_form').submit(function(){
		    var val  = $(this).find('input:checked').val();
		    var link = $(this).attr('action');
			if (link){
			    var pid = $(this).attr('pid');
			    var hash = $(this).attr('hash');
			    $.ajax({
					type: 'POST',
					url: link,
					data: 'ajax=true&form=chat_mode_form&mode='+val,
					datatype: "JSON",
					async: false,
					success: function(msg){
					    if (msg == 1) {
							alert('Please wait while updating data');
					    }
						setInterval(window.location.reload(),3000);
				},
				error: function (request,setting){
				}
			    });
			      //window.location = window.location;
		      //window.location.reload();
		    }
			    return false;
		});

		$('.chat_mode').change(function(){
			if ($(this).val() == 0) bootbox.alert("The chat form will be offline. Click Submit to continue ");
		});

		//====== Video Form in setting listing
		$('form#video_form').submit(function(){
		    var val  = $(this).find('input#fieldID3').val();
		    var link = $(this).attr('action');
		    if (link){
			    var pid = $(this).attr('pid');
			    $.ajax({
				type: 'POST',
				url: link,
				data: 'ajax=true&form=video_form&value='+val,
				datatype: "JSON",
				async: false,
				success: function(msg){
				    if (msg == 1) {
						alert('Please wait while updating data');
				    }
				    setInterval(window.location.reload(),3000);
				},
				error: function (request,setting){
				}
			    });
			      //window.location = window.location;
		      //window.location.reload();
		    }
			    return false;
		});

		//====== Video Form in setting listing
		$('form#video_cover_form').submit(function(){
		    var val  = $(this).find('input#fieldID4').val();
		    var link = $(this).attr('action');
		    if (link){
			    var pid = $(this).attr('pid');
			    $.ajax({
				type: 'POST',
				url: link,
				data: 'ajax=true&form=video_cover_form&value='+val,
				datatype: "JSON",
				async: false,
				success: function(msg){
				    if (msg == 1) {
						alert('Please wait while updating data');
				    }
				    setInterval(window.location.reload(),3000);
				},
				error: function (request,setting){
				}
			    });
			      //window.location = window.location;
		      //window.location.reload();
		    }
			    return false;
		});

	}

    return {
        //main function to initiate the module
        init: function () {

			handleSettingForm();
		}
	}

}();
