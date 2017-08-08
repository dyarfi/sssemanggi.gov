<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey_Dashboard extends Admin_Controller {

    /**
     * Index Media for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct() {
        parent::__construct();

        // Load Media model
        $this->load->model('service/SurveyQuestions');
        $this->load->model('service/SurveyAnswers');
        $this->load->model('service/SurveyRespondents');

        // Load Grocery CRUD
        //$this->load->library('grocery_CRUD');

        // Set priviledge
        $class       = 'Service';// get_class();
        //$this->class = strtolower(get_class());
        $this->class = strtolower($class);
        $this->module_function_list[$class];
        $this->is_allowed = $this->module_function_list[$class];
        $this->notes->media = [
            'ext' => 'jpg|jpeg',
            'dimension' => '800x400'
        ];

    }

    public function index() {

        // Get checked if ajax requested and quest_id_period is exists
        /*
        if ($this->input->is_ajax_request() && $this->input->post('quest_id_period')) {

            // Get post params
            $post = $this->input->post();

            $date_start  = $post['date_start'];
            $date_end    = $post['date_end'];

            $this->view($post['quest_id_period'], $post['date_start'], $post['date_end']);

            exit;
        }
        */

        // Set if selected or not
        $data['quest_id']        = $this->input->get('quest_id');

        // Set main product
        $data['survey_questions'] = $this->SurveyQuestions->get_all(); //$this->SurveyQuestions->with('survey_answers')->get_all();

        // Load js for administrator login
        $data['css_files'] = array(base_url('assets/admin/plugins/jquery.jqplot/jquery.jqplot.min.css'));

        // Load js for administrator login
        $data['js_files'] = array(
                            base_url('assets/admin/plugins/jquery.jqplot/jquery.jqplot.1.0.9.js'),
                            base_url('assets/admin/plugins/jquery.jqplot/plugins/jqplot.barRenderer.min.js'),
                            base_url('assets/admin/plugins/jquery.jqplot/plugins/jqplot.categoryAxisRenderer.min.js'),
                            base_url('assets/admin/plugins/jquery.jqplot/plugins/jqplot.donutRenderer.min.js'),
                            base_url('assets/admin/plugins/jquery.jqplot/plugins/jqplot.json2.min.js')
                            );

        //$js = '';
        //$js_inline = $this->input->get('quest_id') ?

        // Load JS inpage execution
        $data['js_inline'] = "

                            if (App.getURLParameter('data_id')) {
                                // Get URL parameter
                                // console.log(App.getURLParameter('data_id'));
                                var data_id = App.getURLParameter('data_id');
                                $('#chart-survey').find('option[value='+data_id+']');
                            }

                            /****************** jQuery Plot ***********************/
                            jQuery.jqplot.config.enablePlugins = true;
                            $('#chart-survey').bind('change',function() {
                                var inti = new Array();
                                inti.push([0, 0, 0]);
                                var plot2 = $.jqplot('pie_chart', inti, null);
                                plot2.destroy();
                                //var plot3 = $.jqplot('pie_chart2', inti, null);
                                //plot3.destroy();

                                var data_id   = $(this).val();
                                var quest_type = $('option:selected').attr('data-type');
                                var quest_text = $('option:selected').attr('data-rel');
                                var jsonurl = base_ADM + '/survey_dashboard/view/' + data_id;

                                    // console.log(ret);
                                    if (quest_type == 'boolean') {
                                        var ajaxDataRenderer = function(url, plot, options) {
                                            var ret = null;
                                            var jsondata = $.ajax({
                                              // have to use synchronous here, else the function
                                              // will return before the data is fetched
                                              async: false,
                                              url: url,
                                              dataType:'JSON',
                                              sortData:true,
                                              method:'POST',
                                              data : { quest_id : data_id},
                                              success: function(data) {
                                                ret = data;
                                              }
                                            });
                                            $('#date-holder').show();
                                            $('input[name=quest_id_period]').val(data_id).attr('rel',quest_text);
                                            return ret;
                                        };
                                        var plot1 = jQuery.jqplot('pie_chart',jsonurl, {
                                            title: quest_text,
                                            dataRenderer: ajaxDataRenderer,
                                            grid: {
                                              drawBorder: false,
                                              drawGridlines: false,
                                              background: '#ffffff',
                                              shadow:false
                                            },
                                            seriesDefaults: {
                                              shadow: false,
                                              //renderer: jQuery.jqplot.PieRenderer,
                                              renderer: $.jqplot.DonutRenderer,
                                              rendererOptions: { padding: 2, sliceMargin: 2, startAngle: -90, showDataLabels: true},
                                            },
                                            legend: { show:true, location: 'w', rowSpacing:2, placement:'outsideGrid', border:'0px',fontSize:'1.0em'}
                                        });
                                    } else if (quest_type == 'range') {
                                        var ajaxDataRenderer1 = function(url, plot, options) {
                                            var ret = null;
                                            var jsondata = $.ajax({
                                              // have to use synchronous here, else the function
                                              // will return before the data is fetched
                                              async: false,
                                              url: url,
                                              dataType:'JSON',
                                              //sortData:true,
                                              method:'POST',
                                              data : { quest_id : data_id},
                                              success: function(data) {
                                                ret = data;
                                                return ret;
                                              }
                                            });
                                            $('#date-holder').show();
                                            $('input[name=quest_id_period]').val(data_id).attr('rel',quest_text);
                                            return ret;
                                        };
                                        //var s1 = [10, 20, 40, 10];
                                        //var ticks = ['a', 'b', 'c', 'd'];
                                        var plot2 = jQuery.jqplot('pie_chart',jsonurl, {
                                            title: quest_text + ' Range [1 - 10]',
                                            dataRenderer: ajaxDataRenderer1,
                                            dataRendererOptions: {
                                              unusedOptionalUrl: jsonurl
                                            },
                                            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
                                            animate: !jQuery.jqplot.use_excanvas,
                                            seriesDefaults:{
                                                renderer:jQuery.jqplot.BarRenderer,
                                                shadow:false,
                                                pointLabels: { show: true }
                                            },
                                            grid:{
                                                shadow:false
                                            },
                                            axes: {
                                                xaxis: {
                                                    renderer: jQuery.jqplot.CategoryAxisRenderer,
                                                    // ticks: ticks
                                                }
                                            },
                                            highlighter: { show: false }
                                        });

                                    } else if (quest_type == 'freetext') {
                                        var jsondata = $.ajax({
                                          // have to use synchronous here, else the function
                                          // will return before the data is fetched
                                          async: false,
                                          url: jsonurl,
                                          dataType:'JSON',
                                          //sortData:true,
                                          method:'POST',
                                          data : { quest_id : data_id},
                                          success: function(data) {
                                            var result = data.pop();
                                            var html = '';
                                            $.each(result,function(key, value) {
                                                html += '<div class=\"col-lg-12 clearfix\">' + (value.ssa_value ? value.ssa_value : '-') + '<hr/></div>';
                                            });
                                            $('#pie_chart').empty().html('<h4>'+ quest_text +'</h4><br/>').append(html);
                                          }
                                        });
                                        $('#date-holder').show();
                                        $('input[name=quest_id_period]').val(data_id).attr('rel',quest_text);
                                    } else if (quest_type == 'objective') {
                                        var ajaxDataRenderer = function(url, plot, options) {
                                            var ret = null;
                                            var jsondata = $.ajax({
                                              // have to use synchronous here, else the function
                                              // will return before the data is fetched
                                              async: false,
                                              url: url,
                                              dataType:'JSON',
                                              sortData:true,
                                              method:'POST',
                                              data : { quest_id : data_id},
                                              success: function(data) {
                                                ret = data;
                                              }
                                            });
                                            $('#date-holder').show();
                                            $('input[name=quest_id_period]').val(data_id).attr('rel',quest_text);
                                            return ret;
                                        };
                                        var plot1 = jQuery.jqplot('pie_chart',jsonurl, {
                                            title: quest_text,
                                            dataRenderer: ajaxDataRenderer,
                                            grid: {
                                              drawBorder: false,
                                              drawGridlines: false,
                                              background: '#ffffff',
                                              shadow:false
                                            },
                                            seriesDefaults: {
                                              shadow: false,
                                              //renderer: jQuery.jqplot.PieRenderer,
                                              renderer: $.jqplot.DonutRenderer,
                                              rendererOptions: { padding: 2, sliceMargin: 2, startAngle: -90, showDataLabels: true},
                                            },
                                            legend: { show:true, location: 'w', rowSpacing:2, placement:'outsideGrid', border:'0px',fontSize:'1.0em'}
                                        });
                                    }
                            });
    /*
    if (!$.jqplot.use_excanvas) {
        $('div.jqplot-target').each(function(){
            var outerDiv = $(document.createElement('div'));
            var header = $(document.createElement('div'));
            var div = $(document.createElement('div'));

            outerDiv.append(header);
            outerDiv.append(div);

            outerDiv.addClass('jqplot-image-container');
            header.addClass('jqplot-image-container-header');
            div.addClass('jqplot-image-container-content').attr('style','border:0px solid #666666;background:#f2f2f2; margin:20px');

            header.html('Right Click to Save Image As...');

            var close = $(document.createElement('a'));
            close.addClass('jqplot-image-container-close');
            close.html('Close');
            close.attr('href', '#');
            close.click(function() {
                $(this).parents('div.jqplot-image-container').hide(500);
            })
            header.append(close);

            $(this).after(outerDiv);
            outerDiv.hide();

            outerDiv = header = div = close = null;

            if (!$.jqplot._noToImageButton) {
                var btn = $(document.createElement('button'));
                btn.text('View Plot Image');
                btn.addClass('jqplot-image-button');
                btn.bind('click', {chart: $(this)}, function(evt) {
                    var imgelem = evt.data.chart.jqplotToImageElem();
                    var div = $(this).nextAll('div.jqplot-image-container').first();
                    div.children('div.jqplot-image-container-content').empty();
                    div.children('div.jqplot-image-container-content').append(imgelem);
                    div.show(500);
                    div = null;
                });

                $(this).after(btn);
                btn.after('<br />');
                btn = null;
            }
        });
    }
    */

                            var startDate = new Date(2012,1,20);
                            var endDate = new Date(2012,1,25);
                            $('#dp4').datepicker()
                                .on('changeDate', function(ev){
                                    if (ev.date.valueOf() > endDate.valueOf()){
                                        $('#alert').show().find('strong').text('The start date can not be greater then the end date');
                                    } else {
                                        $('#alert').hide();
                                        startDate = new Date(ev.date);
                                    }
                                    $('#dp4').datepicker('hide');
                            });
                            $('#dp5').datepicker()
                                .on('changeDate', function(ev){
                                    if (ev.date.valueOf() < startDate.valueOf()){
                                        $('#alert').show().find('strong').text('The end date can not be less then the start date');
                                    } else {
                                        $('#alert').hide();
                                        endDate = new Date(ev.date);
                                    }
                                    $('#dp5').datepicker('hide');
                            });

                            $('form#period_survey').submit(function() {
                                jQuery.jqplot.config.enablePlugins = true;
                                var inti = new Array();
                                inti.push([0, 0, 0]);
                                var plot2 = $.jqplot('pie_chart', inti, null);
                                plot2.destroy();
                                var quest_type   = $('#chart-survey option:selected').attr('data-type');
                                var date_start  = $(this).find('input[name=date_start]').val();
                                var date_end    = $(this).find('input[name=date_end]').val();
                                var quest_id    = $(this).find('input[name=quest_id_period]').val();
                                var quest_text  = $(this).find('input[name=quest_id_period]').attr('rel');
                                var url = base_ADM + '/survey_dashboard/view/' + quest_id + '/' + date_start + '/' + date_end;
                                var ret = null;

                                    if (quest_type == 'boolean') {
                                        var ajaxDataRenderer = function(url, plot, options) {
                                            var ret = null;
                                            var jsondata = $.ajax({
                                              // have to use synchronous here, else the function
                                              // will return before the data is fetched
                                              async: false,
                                              url: url,
                                              dataType:'JSON',
                                              sortData:true,
                                              method:'POST',
                                              data : { quest_id : quest_id, date_start : date_start, date_end: date_end},
                                              success: function(data) {
                                                ret = data;
                                                return ret;
                                              }
                                            });
                                            return ret;
                                        };
                                        var plot1 = jQuery.jqplot('pie_chart',url, {
                                            title: quest_text + '<br/>['+date_start+' - '+date_end+'] ',
                                            dataRenderer: ajaxDataRenderer,
                                            grid: {
                                              drawBorder: false,
                                              drawGridlines: false,
                                              background: '#ffffff',
                                              shadow:false
                                            },
                                            seriesDefaults: {
                                              shadow: false,
                                              //renderer: jQuery.jqplot.PieRenderer,
                                              renderer: $.jqplot.DonutRenderer,
                                              rendererOptions: { padding: 2, sliceMargin: 2, startAngle: -90, showDataLabels: true},
                                            },
                                            legend: { show:true, location: 'w', rowSpacing:2, placement:'outsideGrid', border:'0px',fontSize:'1.0em'}
                                        });
                                    } else if (quest_type == 'range') {
                                        var ajaxDataRenderer1 = function(url, plot, options) {
                                            var ret = null;
                                            var jsondata = $.ajax({
                                              // have to use synchronous here, else the function
                                              // will return before the data is fetched
                                              async: false,
                                              url: url,
                                              dataType:'JSON',
                                              sortData:true,
                                              method:'POST',
                                              data : { quest_id : quest_id, date_start : date_start, date_end: date_end},
                                              success: function(data) {
                                                ret = data;
                                              }
                                            });
                                            return ret;
                                        };
                                        var plot2 = jQuery.jqplot('pie_chart', url, {
                                            title: quest_text + ' Range [1 - 10]' + '<br/>['+date_start+' - '+date_end+'] ',
                                            dataRenderer: ajaxDataRenderer1,
                                            dataRendererOptions: {
                                              unusedOptionalUrl: url
                                            },
                                            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
                                            animate: !jQuery.jqplot.use_excanvas,
                                            seriesDefaults:{
                                                renderer:jQuery.jqplot.BarRenderer,
                                                shadow:false,
                                                pointLabels: { show: true }
                                            },
                                            grid:{
                                                shadow:false
                                            },
                                            axes: {
                                                xaxis: {
                                                    renderer: jQuery.jqplot.CategoryAxisRenderer,
                                                }
                                            },
                                            highlighter: { show: false }
                                        });
                                    } else if (quest_type == 'freetext') {
                                        var jsondata = $.ajax({
                                          // have to use synchronous here, else the function
                                          // will return before the data is fetched
                                          async: false,
                                          url: url,
                                          dataType:'JSON',
                                          //sortData:true,
                                          method:'POST',
                                          data : { quest_id : quest_id, date_start : date_start, date_end: date_end },
                                          success: function(data) {
                                            var result = data.pop();
                                            var html = '';
                                            $.each(result,function(key, value) {
                                                var time = moment.unix(value.added).format(\"YYYY/MM/DD\");
                                                html += '<div class=\"col-lg-12 clearfix\">' + (value.ssa_value ? value.ssa_value : '-') + ' - ' +time+ '<hr/></div>';
                                            });
                                            $('#pie_chart').empty().html('<h4>'+ quest_text +'</h4><br/>').append(html);
                                          }
                                        });
                                    } else if (quest_type == 'objective') {
                                        var ajaxDataRenderer = function(url, plot, options) {
                                            var ret = null;
                                            var jsondata = $.ajax({
                                              // have to use synchronous here, else the function
                                              // will return before the data is fetched
                                              async: false,
                                              url: url,
                                              dataType:'JSON',
                                              sortData:true,
                                              method:'POST',
                                              data : { quest_id : quest_id, date_start : date_start, date_end: date_end},
                                              success: function(data) {
                                                ret = data;
                                              }
                                            });
                                            return ret;
                                        };
                                        var plot1 = jQuery.jqplot('pie_chart',url, {
                                            title: quest_text + '<br/>['+date_start+' - '+date_end+'] ',
                                            dataRenderer: ajaxDataRenderer,
                                            grid: {
                                              drawBorder: false,
                                              drawGridlines: false,
                                              background: '#ffffff',
                                              shadow:false
                                            },
                                            seriesDefaults: {
                                              shadow: false,
                                              //renderer: jQuery.jqplot.PieRenderer,
                                              renderer: $.jqplot.DonutRenderer,
                                              rendererOptions: { padding: 2, sliceMargin: 2, startAngle: -90, showDataLabels: true},
                                            },
                                            legend: { show:true, location: 'w', rowSpacing:2, placement:'outsideGrid', border:'0px',fontSize:'1.0em'}
                                        });

                                    }

                                    //console.log(plot1);

                                return false;
                            });
                        ";

        // Set main template
        $data['main'] = 'service/surveydashboard_index';

        // Set module with URL request
        $data['module_title'] = $this->module;

        // Set admin title page with module menu
        $data['page_title'] = lang($this->module_menu);

        // Load admin template blank
        //$this->load->view('template/admin/blank', $this->load->vars($data));

        // Load admin template
        $this->load->view('template/admin/template', $this->load->vars($data));
    }

    public function view ($id='',$date_start='',$date_end='') {

        // Check if the request via AJAX
        //if ($this->input->is_ajax_request() && $this->input->post()) {

            // Set main template

            //$data['json'] = array($this->SurveyQuestions->count_user_answer_by_questions($id));
            $response = array($this->SurveyQuestions->count_user_answer_by_questions($id, $date_start, $date_end));
            //print_r($response);
            //exit;
            // Load admin template
            //$this->load->view('json', $this->load->vars($data));

             $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));

        //}

    }
}

/* End of file media.php */
/* Location: ./application/module/media/controllers/media.php */
