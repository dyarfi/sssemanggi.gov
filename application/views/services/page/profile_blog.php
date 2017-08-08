<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">    
    <!-- page content -->
    <!-- img header -->   
    <section class="header-halo" style="background: url(<?php echo base_url('assets/public/images/profile_bg.jpg');?>) center center no-repeat; background-size: cover;">
        <div class="black-tint has-button">
            <div id="crumbs" class="abs">
                <div class="eight columns">
                    <h6 class="sub-heading">
                    <a href="<?php echo base_url('services');?>">Home</a>
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="<?php echo base_url('services/profile');?>">Profile</a>                    
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="<?php echo base_url('services/profile/blog');?>">Blog</a>
                </h6>
            </div>
        </div>
        Hi, <?php echo $this->member->fullname;?> 
        <!--span class="sub-lite">Booking service Suzuki</span-->
        </div>
    </section>
    <section class="grey stripe-bg">
        <!-- two third /left side-->
        <div class="two-third white">
            <div id="single-page" class="page">   
                <div class="twelve columns">
                    <div class="row">
                        <div class="twelve columns">
                            <br/>
                            <h5>Blog List</h5>
                            <hr class="thin grey"/>
                            <?php if ($this->member->blog) {?>
                            <table class="row striped twelve">
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Tags</th>                                    
                                    <th>Publish Date</th>
                                    <th>Text</th> 
                                    <th>Status</th>
                                    <th width="15%">Function</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($this->member->blog as $blog) { ?>                                
                                    <tr>                                        
                                        <td><?php echo word_limiter($blog->subject,4); ?></td>
                                        <td><?php echo ucfirst($blog->tags); ?></td>                                        
                                        <td><?php echo date('D, d-M-Y', strtotime($blog->publish_date)); ?></td>
                                        <td><?php echo word_limiter(strip_tags($blog->text),5); ?></td>
                                        <td><?php echo ($blog->status == 'unpublish') ? 'Not Approved' : '<strong>Approved</strong>'; ?></td>                                        
                                        <td>
                                            <?php if ($blog->status == 'publish') { ?>
                                            <a href="#" class="blog-edit switch" rel="<?php echo $this->encrypt->encode($blog->id);?>" gumby-trigger="#modal1"> 
                                                <span class="purple small">
                                                    Edit
                                                </span>
                                            </a>
                                            &nbsp;
                                            <a href="#" class="blog-unpublish" rel="<?php echo $this->encrypt->encode($blog->id);?>"> 
                                                <span class="purple small">
                                                    Cancel
                                                </span>
                                            </a> 
                                            <?php } else { ?>
                                            Waiting Approval
                                            <?php } ?>                                          
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tbody>
                            </table>
                            <hr class="thin grey"/>                            
                            <a href="#" class="blog-add purple small fill-button switch" gumby-trigger="#modal1">Tambah Blog <span class="fa fa-plus" aria-hidden="true"></span></a>
                            <?php } else { ?>
                            <div class="twelve columns">
                                <h5>Belum ada Blog</h5>
                                <hr class="thin grey"/>
                                <a href="#" class="blog-add purple small fill-button switch" gumby-trigger="#modal1">Tambah Blog <span class="fa fa-plus" aria-hidden="true"></span></a>
                            </div>
                            <?php } ?>
                        <br/><br/>
                        <br/><br/>
                        <br/><br/>
                        <br/><br/>
                        <br/><br/>
                        <br/><br/>
                        <br/><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- sidebar -->
        <aside class="one-third grey">
        <div id="sidebar">
            <!-- category widget -->
            <div class="widget">
                <h5 class="stripe-heading">Hi, <?php echo word_limiter($this->member->fullname,2,'');?></h5>
                <div class="widget-content">
                    <ul class="categories">
                        <li><a href="<?php echo base_url('services/profile');?>">Profile</a></li>
                        <li><a href="javascript:;">Inbox</a></li>
                        <li><a href="<?php echo base_url('services/profile/blog');?>">Blog</a></li>
                        <li><a href="<?php echo base_url('services/profile/booking');?>">List Booking</a></li>
                    </ul>
                </div>
            </div>            
        </div>
        </aside>
        <!-- clear floats -->
        <div class="clear"></div>
    </section>
</div>

<?php $this->load->view('services/page/blog'); ?>