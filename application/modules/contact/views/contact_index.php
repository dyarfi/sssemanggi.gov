<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid">   
    <div class="col-lg-12 clearfix">
        <h3 class="block">Subject: <?php echo $contact->subject;?></h3>
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab_<?php echo $contact->url;?>" data-toggle="tab">Reply Contact</a>
            </li>   
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab_<?php echo $contact->url;?>">
                <?php echo form_open_multipart('',['id'=>'form-reply','method'=>'POST']);?>
                <input type="hidden" value="<?php echo $contact->id;?>" name="contact_id"/>
                <div class="col-lg-12">
                    <div class="input-group">
                        <label for="email">To</label>
                        <input type="text" readonly="readonly" id="email" name="email" value="<?php echo $contact->email;?>" class="form-control"/>
                    </div>
                    <div class="input-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" value="RE: <?php echo $contact->subject;?>" class="form-control"/>
                    </div>
                    <div class="input-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" cols="70" rows="10" class="form-control"><?php echo '<br><br><hr/>'.nl2br($contact->message);?></textarea>
                    </div>  
                    <div class="clearfix"></div><hr/>
                    <button type="submit" class="btn btn-primary" id="submit" name="submit" value="submit"><span class="fa fa-check"></span> <?php echo lang('Submit');?></button>                  
                </div>
                <?php echo form_close();?>
            </div>  
        </div>
    </div>
    <div class="col-lg-12 clearfix">
        <?php if ($contactvariants) { ?>    
            <h3 class="block">Variants</h3>
            <?php foreach ($contactvariants as $contact) { ?>
            <div class="col-md-3">
                <div class="img-thumbnail">
                    <img src="<?php echo base_url($contact->media);?>" class="img-responsive"/>             
                </div>
                <span class="grey"><button class="btn btn-default btn-block"><?php echo $contact->subject;?></button></span>
            </div>
            <?php } ?>
        <?php } else { ?><?php } ?>
        <div class="clearfix"></div><hr/>
    </div>
</div>