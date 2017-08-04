
<?php 
$title_page = 'Contact Us';
$description_page = 'Reach out for us for more information';
$single_page = true;
include('inc_header.php');
?>
<!-- page content -->
<section class="page">
    <div class="container">
        <div class="row">
        <!-- page content -->
        <div class="span8">
                    

                     <form class="comments-form contact-form">
                                                        
                        <input type="text" name="name" placeholder="Your Name*" class="name" />
                        <input type="text" name="email" class="email" placeholder="Your Email*" /> 
                        <select>
                            <option value="Subject">Subject</option>
                            <option value="web-design">Web Design</option>
                            <option value="web-development">Web Development</option>
                        </select>
                        <textarea class="message" name="message" placeholder="Your Message*"></textarea>
                        <input type="submit" class="mocha-button submit-comment" value="Send Message" />
                    </form>
        </div>
        <!-- end comments form -->
        <!-- content -->
        <div class="post-content fixed-content span4" >
            
                    
                    <!-- content -->
                <div class="content">


                        <h4>Don't hesitate to reach out!</h4>
                        

                        <p class="light-font">Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. <span class="bold">Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc</span>. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>


                        <div class="margin"></div>


                        <!-- item meta -->
                        <div class="item-meta">
                                

                                <dl>
                                    <dt>Address:</dt>
                                    <dd>1 Infinite Loop Cupertino, CA 95014</dd>

                                    <dt>Phone:</dt>
                                    <dd>0039 6923 882 119</dd>

                                    <dt>Email:</dt>
                                    <dd>hello@mocha.com</dd>
                                </dl>


                        </div>
                        <!-- end item meta -->
                </div>
                <!-- end content -->
        </div>
        <!-- end content section  -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end page content -->
<?php include('inc_footer.php');?>
