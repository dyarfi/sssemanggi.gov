<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="container-fluid">	
			<div class="col-lg-12 clearfix">
				<h3 class="block">Survey Dashboard</h3>
				<?php echo form_open('',['method'=>'POST']);?>
				<select class="form-control" id="chart-survey" name="quest_id">
				<option></option>	
				<?php foreach ($survey_questions as $survey_question) { ?>
					<option data-rel="<?php echo strip_tags($survey_question->ssq_subject);?>" value="<?php echo $survey_question->ssq_id;?>" <?php echo $quest_id == $survey_question->ssq_id ? 'selected' :''; ?> data-type="<?php echo $survey_question->ssq_type;?>"><?php echo $survey_question->ssq_subject;?></option>
				<?php } ?>
				</select>
				<?php echo form_close();?>
				<div class="form-group" id="date-holder" style="display:none">
					<h4>Period Date</h4>
					<form class="form-horizontal" id="period_survey" action="<?php echo base_url(ADMIN);?>/service/survey_dashboard/index" method="POST">
						<input type="hidden" name="quest_id_period" value=""> 
						<div id="alert" class="alert alert-error" style="display: block;"><strong></strong></div>
						<div class="row">
							<div class="col-md-4">
								<input class="form-control" name="date_start" id="dp4" value="" data-date="<?php echo date('Y');?>-02-1" data-date-format="yyyy-mm-dd" placeholder="Start Date">
							</div>
							<div class="col-md-4">						
								<input class="form-control" name="date_end" id="dp5" value="" data-date="<?php echo date('Y');?>-02-25" data-date-format="yyyy-mm-dd" placeholder="End Date">
							</div>		
							<button class="btn btn-primary" class="submit-chart">SUBMIT</button>
						</div>
					</form>
				</div>				
			</div>
			<div class="clearfix"></div>
			<div id="pie_chart" style="padding:0px 0px;margin:40px 0 0 0; clear: both; position: relative;" class="jqplot-target"></div>
			<!--div id="pie_chart2" style="padding:0px 0px;margin:0px 0 0 0; clear: both; position: relative;" class="jqplot-target"></div-->
			<div class="clearfix"></div>
		</div>
	</div>
</div>		