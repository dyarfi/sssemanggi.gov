var FormStatus = function () {
	
	var handleStatusForm = function () {		
	    $('#select_action').change(
		    function () {
			    $(this).parents('form').submit();
		    }
	    );	
	}

	var handleDeleteForm = function() {
		// =========== Input Type Lookup Function =============	
		//Check username that already taken
		$('.btn.default.btn-xs.red[title="Delete"]').click(function() {
		 	var conf = confirm("Are you sure that you want to delete this record?");
		    if(conf == true){
		        return true;
		    }
			return false;
		});
	}
	
    return {
        //main function to initiate the module
        init: function () {
	    	handleStatusForm();
	    	handleDeleteForm();
        }

    };

}();