 <div class="row">
    <?php if (!isset($single_page)) { ?>
    <div class="home-slider span12">
        <div class="m-slider flexslider">
            <ul class="slides">
                <li>
                    <div class="slide" style="background-image: url('../images/slider/boxed/2.jpg');">
                    <!-- <div class="slide"> -->
                        <h2>Built On Creativity</h2>
                        <p>We work with individuals and businesses of all sizes to bring ideas to life through thoughtful client-oriented design solutions.</p>
                         <div class="clearfix"></div>
                         <a href="projects.php" class="button">Go To Portfolio</a>
                    </div>
                    <!-- end slide -->
                </li>
                <li>
                    <div class="slide" style="background-image: url('../images/slider/boxed/3.jpg');">
                    <!-- <div class="slide"> -->
                        <h2>Mocha Portfolio Theme</h2>
                        <p>Curabitur hendrerit pretium ornare. Vivamus sed nulla sapien, eu pulvinar dolor. Donec odio est, vestibulum at pulvinar.</p>
                         <div class="clearfix"></div>
                         <a href="projects.php" class="button">Go To Portfolio</a>
                    </div>
                    <!-- end slide -->
                </li>
                <li>
                    <div class="slide" style="background-image: url('../images/slider/boxed/4.jpg');">
                    <!-- <div class="slide"> -->
                        <h2>Mocha Portfolio Theme</h2>
                        <p>Curabitur hendrerit pretium ornare. Vivamus sed nulla sapien, eu pulvinar dolor. Donec odio est, vestibulum at pulvinar.</p>
                         <div class="clearfix"></div>
                         <a href="projects.php" class="button">Go To Portfolio</a>
                    </div>
                    <!-- end slide -->
                </li>
                 <li>
                     <div class="slide" style="background-image: url('../images/slider/boxed/5.jpg');">
                    <!-- <div class="slide"> -->
                        <h2>Mocha Portfolio Theme</h2>
                        <p>Curabitur hendrerit pretium ornare. Vivamus sed nulla sapien, eu pulvinar dolor. Donec odio est, vestibulum at pulvinar.</p>
                        <a href="projects.php" class="button">Go To Portfolio</a>
                    </div>
                    <!-- end slide -->
                </li>
            </ul>
        </div><!-- end m slider -->
    </div><!-- end home slider -->
    <?php } else { ?>
     <div class="span12 teaser">           
        <h2><?php echo ($title_page) ? $title_page : 'Page';?></h2>
        <p><?php echo ($description_page) ? $description_page : 'Your awesome subtitle goes here.';?></p>
    </div>
    <!-- end span12 -->
    <?php } ?>
</div>
<!-- end row 2