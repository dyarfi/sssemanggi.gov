<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- middle -->
<section class="banner">
	<div class="wrapper">
      <div class="image"><?php if ($detail->media) { ?><img src="<?php echo base_url($upload_path.str_replace($detail->media, 'thumb__1920x342'.$detail->media, $detail->media));?>"/><?php } ?></div>
   </div>
</section>
<section class="content-page">
	<div class="mid-wrapper  afterclear">
    	<div id="trigger-submenu" class="submenu-mobile">
            <h3><?php echo $detail->subject;?></h3>
        </div><!--end.submenu-mobile-->
        <div class="submenu-m-slide">
            <ul class="main-sub">
              <?php if ((array) $pages) {
                    $i=1;
                    foreach ($pages as $mpage) { 
                        $url_type = ($mpage->type == 'page-listing' && $mpage->name != NULL) ? base_url('page/'.$detail->url.'/'.$mpage->name.'/'.$mpage->prefix) : base_url('page/'.$detail->url.'/post/'.$mpage->url.'/'.$mpage->prefix);                            
                        if ($i == 1) { ?>
                            <li class="active">
                                <a href="<?php echo base_url('page/'.$detail->url.'/'.$detail->prefix);?>"><?php echo $mpage->subject;?></a>
                            </li>
                        <?php } else { ?>
                            <li class="<?php echo ($this->uri->segment(2) == $mpage->url  && $i != 1) ? 'active': '';?>">
                                <a href="<?php echo $url_type;?>"><?php echo $mpage->subject;?></a>
                            </li>  
                        <?php
                        }
                    $i++; 
                    } 
                } else { ?>
                    <li><?php echo lang('unavailable');?></li>
                <?php } ?>
            </ul>
        </div>
    	<aside class="relative">
        	<div class="title-ban"><h3><?php echo $detail->subject;?></h3></div>        	
            <?php if ((array) $pages) { ?>
            <div class="left-menu">
            	<ul>
                    <?php
                        $i = 1;
                        $list = '';
                        $catid ='';
                        $url_type = '';
                        foreach ($pages as $page) {
                            $url_type = ($page->type == 'page-listing' && $page->name != NULL) ? base_url('page/'.$detail->url.'/'.$page->name.'/'.$page->prefix) : base_url('page/'.$detail->url.'/post/'.$page->url.'/'.$page->prefix);
                            if ($i == 1) { 
                                $catid = $page->field_id;                            
                                $list  = $page;
                            ?>
                            <li class="active">
                                <a href="<?php echo base_url('page/'.$detail->url.'/'.$detail->prefix);?>"><?php echo $page->subject;?></a>
                            </li>
                            <?php } else { ?>
                            <li class="<?php echo ($this->uri->segment(2) == $page->url  && $i != 1) ? 'active': '';?>">
                                <a href="<?php echo $url_type;?>"><?php echo $page->subject;?></a>
                            </li>    
                            <?php
                            }
                            ?><!--end.items-->                
                        <?php
                        $i++;
                        } 
                    ?>                   
                </ul>
            </div><!--end.left-menu-->
            <?php } else {
                $list = $detail;
            }   
            ?>
            <?php $this->load->view('ext_link');?>
        </aside> 
        <section class="main-content">
        	<nav id="breadcumb"><a href="<?php echo base_url();?>"><?php echo lang('home');?></a> <a href="<?php echo base_url('page/'.$detail->url.'/'.$detail->prefix);?>"><?php echo $detail->subject;?></a> <a href="#"><?php echo $list->subject;?></a></nav>
        	<article>
                <h1 class="title"><?php echo $list->subject;?></h1>
                <h3><?php echo $list->synopsis;?></h3>	        	
                <?php echo $list->text;?>
                <?php 
                if ($list->type == 'page-listing' && $list->name != '') { 
                    // Hate to doing this but hey, this is fir the future heads up
                    $rows = $this->Content->find('template_pages',['type'=>str_replace('page-', '', $list->name), 'status'=>'publish'],['added'=>'DESC'],99999);
                ?>
                <div class="list-row">
                    <?php foreach ($rows as $row) { ?>
                    <div class="item">
                        <?php if ($row->cover && $row->media) { ?>
                        <div class="image">
                            <a href="<?php echo base_url('uploads/pages/'.$row->media);?>" class="unduh fancybox" data-fancybox-type="iframe"><img alt="<?php echo $row->subject;?>" src="<?php echo base_url('uploads/pages/'.$row->cover);?>" /></a>
                        </div>
                        <?php } ?>
                        <div class="caption">
                            <p><?php echo $row->subject;?></p>
                            <?php 
                                //print_r( get_file_info('uploads/pages/'.$row->media) );
                                $file_read = get_file_info('uploads/pages/'.$row->media);
                                $file_size = byte_format($file_read['size']);
                                $file_exts = strtoupper(pathinfo($file_read['name'], PATHINFO_EXTENSION));
                            ?>
                            <?php if ($row->media) { ?>
                            <a href="<?php echo base_url('uploads/pages/'.$row->media);?>" class="unduh fancybox" data-fancybox-type="iframe" title="<?php echo $row->subject;?>"><?php echo $file_exts;?>  File</a>
                            <?php } ?>
                        </div>
                    </div><!--end.item-->
                    <?php } ?>                    
                </div><!--end.row-->
                <?php } ?>
			</article>
        </section>
    </div><!--end.wrapper-->
</section><!--end.content-page-->
<!-- end of middle -->