<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="modal modal-blog" id="modal1">
    <div class="content">
    <a class="close switch btn medium" gumby-trigger="|#modal1"><i class="icon-cancel" /></i></a>
        <div class="twelve columns text-left">
            <div class="field white">
                <?php echo form_open_multipart(base_url('xhr/blog'),['id'=>'blog-user']); ?>
                    <input type="hidden" name="blog_member_id" value="<?php echo $this->session->userdata('member_session')->id;?>" style="display:none">
                    <input type="hidden" name="blog_id" value="<?php echo $blog->id;?>" style="display:none">
                    <input type="hidden" name="blog_type" value="<?php echo $this->member == 'Service' ? 'usr-blog' : 'svc-artc';?>" style="display:none">                    
                    <input type="hidden" name="base64" value="">
                    <div>
                        <label for="blog_subject">Subject</label>
                        <input class="input" type="text" id="blog_subject" name="blog_subject" value="<?php echo $blog->subject;?>">
                    </div>
                    <div class="field">
                        <label for="blog_tags">Tags</label>
                        <?php //echo $blog->tags;?>
                        <div class="picker six columns">
                            <select name="blog_tags" class="picker" id="blog_tags">
                                <option readonly value="">Select Tags</option>                                                            
                                <option value="automobile">Automobile</option>
                                <option value="motorcycle">Motorcycle</option>                                                            
                                <option value="marine">Marine</option>
                            </select>
                        </div>
                    </div>                                                    
                    <div>
                        <label for="blog_text">Text</label>
                        <textarea class="input textarea MiniBasic" id="blog_text" name="blog_text"><?php echo $blog->text;?></textarea>
                    </div>
                    <div>
                        <label for="blog_media">Image</label>
                        <div class="image photo">
                            <div class="fileUpload-handler">
                                <img src="" alt="" width="150">
                            </div>
                            <input type="file" name="blog_media">                            
                        </div>         
                    </div>
                    <hr class="thin grey"/>
                    <div>
                        <button class="purple small fill-button" type="submit" id="blog_submit" name="blog_submit" value="SIMPAN">SIMPAN <span class="fa fa-check"></span></button>
                    </div>
                <?php echo form_close();?>
            </div>
            <!--p class="btn primary medium"><a href="#" class="switch" gumby-trigger="|#modal1">Close Modal</a></p-->
        </div>
    </div>
</div>