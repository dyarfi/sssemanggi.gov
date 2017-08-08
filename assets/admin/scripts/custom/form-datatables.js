/***
Wrapper/Helper Class for datagrid based on jQuery Datatable Plugin
***/

var Datatable = function () {

    var tableOptions;  // main options
    var dataTable; // datatable object
    var table;    // actual table jquery object
    var tableContainer;    // actual table container object
    var tableWrapper; // actual table wrapper jquery object
    var tableInitialized = false;
    var ajaxParams = []; // set filter mode
    
    var countSelectedRecords = function() {
        var selected = $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', table).size();
        var text = tableOptions.dataTable.oLanguage.sGroupActions;
        if (selected > 0) {
            $('.table-group-actions > span', tableWrapper).text(text.replace("_TOTAL_", selected));
        } else {
            $('.table-group-actions > span', tableWrapper).text("");
        }
    }
    
    return {

        //main function to initiate the module
        init: function (options) {
            
            if (!$().dataTable) {
                return;
            }

            var the = this;

            // default settings
            options = $.extend(true, {
                src: "",  // actual table 
                filterApplyAction: "filter",
                filterCancelAction: "filter_cancel",
                resetGroupActionInputOnSuccess: true,
                dataTable: {
                    "bDestroy": true,
                    "sDom" : "<'row'<'col-md-12 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r><'table-scrollable't><'row'<'col-md-12 col-sm-12'pli><'col-md-4 col-sm-12'>r>>", // datatable layout
                    
                    "aLengthMenu": [ // set available records per page
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    "iDisplayLength": 20, // default records per page
                    "oLanguage": {  // language settings
                        "sProcessing": '<img src="'+base_URL+'/assets/admin/img/loading-spinner-grey.gif"/><span>&nbsp;&nbsp;Loading...</span>',
                        "sLengthMenu": "<span class='seperator'>|</span>View _MENU_ records",
                        "sInfo": "<span class='seperator'>|</span>Found total _TOTAL_ records",
                        "sInfoEmpty": "No records found to show",
                        "sGroupActions": "_TOTAL_ records selected:  ",
                        "sAjaxRequestGeneralError": "Could not complete request. Please check your internet connection",
                        "sEmptyTable":  "No data available in table",
                        "sZeroRecords": "No matching records found",
                        "oPaginate": {
                            "sPrevious": "Prev",
                            "sNext": "Next",
                            "sPage": "Page",
                            "sPageOf": "of"
                        }
                    },

                    "aoColumnDefs" : [{  // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                        'bSortable' : false,
                        'aTargets' : [ 0 ]
                    }],

                    "bAutoWidth": false,   // disable fixed width and enable fluid table
                    "bSortCellsTop": true, // make sortable only the first row in thead
                    "sPaginationType": "bootstrap_extended", // pagination type(bootstrap, bootstrap_full_number or bootstrap_extended)
                    "bProcessing": true, // enable/disable display message box on record load
                    "bServerSide": true, // enable/disable server side ajax loading
                    "sAjaxSource": "", // define ajax source URL 
                    "sServerMethod": "POST",

                    // handle ajax request
                    "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
                      oSettings.jqXHR = $.ajax( {
                        "dataType": 'json',
                        "type": "POST",
                        "url": sSource,
                        "data": aoData,
                        "success": function(res, textStatus, jqXHR) {
                            if (res.sMessage) {
                                App.alert({type: (res.sStatus == 'OK' ? 'success' : 'danger'), icon: (res.sStatus == 'OK' ? 'check' : 'warning'), message: res.sMessage, container: tableWrapper, place: 'prepend'});
                            } 
                            if (res.sStatus) {
                                if (tableOptions.resetGroupActionInputOnSuccess) {
                                    $('.table-group-action-input', tableWrapper).val("");
                                }
                            }
                            if ($('.group-checkable', table).size() === 1) {
                                $('.group-checkable', table).attr("checked", false);
                                $.uniform.update($('.group-checkable', table));
                            }
                            if (tableOptions.onSuccess) {
                                tableOptions.onSuccess.call(the);
                            }
                            fnCallback(res, textStatus, jqXHR);
                            var total = 0;
                            $('#datatable_ajax tbody tr').each(function (key) {    
                                total += parseFloat($(this).find('span.autonumeric.price').html());
                            });          
                            total = total.toString() == 'NaN' ? '0' : total.toFixed(6);
                            $('#datatable_ajax tbody tr:last-child').after('<tr><td colspan="3">Total</td><td colspan="3"><span class="total" data-a-dec="," data-a-sep=".">'+total+'</span></td></tr>');
                            $('span.total').autoNumeric({aSep: '.', aDec: ',' ,mDec:'3'});
                        },
                        "error": function() {
                            if (tableOptions.onError) {
                                tableOptions.onError.call(the);
                            }
                            App.alert({type: 'danger', icon: 'warning', message: tableOptions.dataTable.oLanguage.sAjaxRequestGeneralError, container: tableWrapper, place: 'prepend'});
                            $('.dataTables_processing', tableWrapper).remove();
                        }
                      } );
                    },

                    // pass additional parameter
                    "fnServerParams": function ( aoData ) {
                        //here can be added an external ajax request parameters.
                        for(var i in ajaxParams) {
                            var param = ajaxParams[i];
                            aoData.push({"name" : param.name, "value": param.value});
                        }
                    },
                   
                    "fnDrawCallback": function( oSettings ) { // run some code on table redraw
                        if (tableInitialized === false) { // check if table has been initialized
                            tableInitialized = true; // set table initialized
                            table.show(); // display table
                        }
                        App.initUniform($('input[type="checkbox"]', table));  // reinitialize uniform checkboxes on each table reload
                        countSelectedRecords(); // reset selected records indicator
                    }
                }
            }, options);

            tableOptions = options;
                       
            // create table's jquery object
            table = $(options.src);
            tableContainer = table.parents(".table-container");

            // apply the special class that used to restyle the default datatable
            $.fn.dataTableExt.oStdClasses.sWrapper = $.fn.dataTableExt.oStdClasses.sWrapper + " dataTables_extended_wrapper";

            // initialize a datatable
            dataTable = table.dataTable(options.dataTable);
            tableWrapper = table.parents('.dataTables_wrapper');

            // modify table per page dropdown input by appliying some classes
            $('.dataTables_length select', tableWrapper).addClass("form-control input-xsmall input-sm");

            // build table group actions panel
            if ($('.table-actions-wrapper', tableContainer).size() === 1) {
                $('.table-group-actions', tableWrapper).html($('.table-actions-wrapper', tableContainer).html()); // place the panel inside the wrapper
                $('.table-actions-wrapper', tableContainer).remove(); // remove the template container
            }
            // handle group checkboxes check/uncheck
            $('.group-checkable', table).change(function () {
                var set = $('tbody > tr > td:nth-child(1) input[type="checkbox"]', table);
                var checked = $(this).is(":checked");
                $(set).each(function () {
                    $(this).attr("checked", checked);
                });
                $.uniform.update(set);
                countSelectedRecords();
            });

            // handle row's checkbox click
            table.on('change', 'tbody > tr > td:nth-child(1) input[type="checkbox"]', function(){
                countSelectedRecords();
            });

            // handle filter submit button click
            table.on('click', '.filter-submit', function(e){
                e.preventDefault();

                the.addAjaxParam("sAction", tableOptions.filterApplyAction);

                // get all typeable inputs
                $('textarea.form-filter, select.form-filter, input.form-filter:not([type="radio"],[type="checkbox"])', table).each(function(){
                    the.addAjaxParam($(this).attr("name"), $(this).val());
                });

                // get all checkable inputs
                $('input.form-filter[type="checkbox"]:checked, input.form-filter[type="radio"]:checked', table).each(function(){
                    the.addAjaxParam($(this).attr("name"), $(this).val());
                });
                
                dataTable.fnDraw();
                the.clearAjaxParams();
            });

            // handle filter cancel button click
            table.on('click', '.filter-cancel', function(e){
                e.preventDefault();
                $('textarea.form-filter, select.form-filter, input.form-filter', table).each(function(){
                    $(this).val("");
                });
                $('input.form-filter[type="checkbox"]', table).each(function(){
                    $(this).attr("checked", false);
                });               
                the.addAjaxParam("sAction", tableOptions.filterCancelAction);
                dataTable.fnDraw();
                the.clearAjaxParams();
            });
        },

        getSelectedRowsCount: function() {
            return $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', table).size();
        },

        getSelectedRows: function() {
            var rows = [];
            $('tbody > tr > td:nth-child(1) input[type="checkbox"]:checked', table).each(function(){
                rows.push({name: $(this).attr("name"), value: $(this).val()});
            });

            return rows;
        },

        addAjaxParam: function(name, value) {
           ajaxParams.push({"name": name, "value": value});
        },

        clearAjaxParams: function(name, value) {
           ajaxParams = [];
        },

        getDataTable: function() {
            return dataTable;
        },

        getTableWrapper: function() {
            return tableWrapper;
        }, 

        gettableContainer: function() {
            return tableContainer;
        }, 

        getTable: function() {
            return table;
        }        

    };

};

var TableAjax = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleRecords = function() {

        $('a.get-service-list').live('click',function() {

            var sUrl = $(this).attr('data-rel');
            var grid = new Datatable();
            
            // Set the service id to the modal form
            $('#form-service-items').find('input[name=service_id]').val($(this).data('id'));
                        
            grid.init({
                src: $("#datatable_ajax"),
                onSuccess: function(grid) {
                    // execute some code after table records loaded
                },
                onError: function(grid) {
                    // execute some code on network or other general error  
                },
                dataTable: {  // here you can define a typical datatable settings from http://datatables.net/usage/options 
                    /* 
                        By default the ajax datatable's layout is horizontally scrollable and this can cause an issue of dropdown menu is used in the table rows which.
                        Use below "sDom" value for the datatable layout if you want to have a dropdown menu for each row in the datatable. But this disables the horizontal scroll. 
                    */
                    //"sDom" : "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>r>>", 
                    //"bDestroy": true,
                    "aLengthMenu": [
                        [20, 50, 100, 150, -1],
                        [20, 50, 100, 150, "All"] // change per page values here
                    ],
                    "iDisplayLength": 20, // default record count per page
                    "bServerSide": true, // server side processing
                    "sAjaxSource": sUrl, // ajax source
                    "aaSorting": [[ 1, "asc" ]] // set first column as a default sort by asc
                }
            });

            // handle group actionsubmit button click
            grid.getTableWrapper().on('click', '.table-group-action-submit', function(e){
                e.preventDefault();
                var action = $(".table-group-action-input", grid.getTableWrapper());
                if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                    grid.addAjaxParam("sAction", "group_action");
                    grid.addAjaxParam("sGroupActionName", action.val());
                    var records = grid.getSelectedRows();
                    for (var i in records) {
                        grid.addAjaxParam(records[i]["name"], records[i]["value"]);    
                    }
                    grid.getDataTable().fnDraw();
                    grid.clearAjaxParams();
                } else if (action.val() == "") {
                    App.alert({type: 'danger', icon: 'warning', message: 'Please select an action', container: grid.getTableWrapper(), place: 'prepend'});
                } else if (grid.getSelectedRowsCount() === 0) {
                    App.alert({type: 'danger', icon: 'warning', message: 'No record selected', container: grid.getTableWrapper(), place: 'prepend'});
                }
            });            
        
        });
    
    }

    return {

        //main function to initiate the module
        init: function () {

            initPickers();
            handleRecords();
        }

    };

}();