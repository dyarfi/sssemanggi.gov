<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<!-- sidebar -->
<aside class="one-third grey">
    <div id="sidebar">        
        <div class="widget">
            <h5 class="stripe-heading">BERITA TERKINI</h5>
            <div class="widget-content">
                <ul class="recent-posts">
                    <?php foreach ($other_news as $news) { 
                        if ($news->type == 'promo') {
                            $url = base_url('promo/'.$news->url);
                        } else {                            
                            $url = base_url('news/'.$news->url);
                        }
                        ?>
                    <li><a href="<?php echo $url;?>"><?php echo $news->subject;?></a>
                    <span><?php echo date('M d, Y',strtotime($news->publish_date));?></span></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</aside>