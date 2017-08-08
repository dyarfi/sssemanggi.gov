<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<ul class="search_field">
	<li class="append field">
		<?php echo form_open(base_url('search'));?>
			<input class="wide input" type="text" name="search" placeholder="Search">
			<button class="medium primary btn">Go</button>
		<?php echo form_close();?>
	</li>
</ul>
<nav class="main-nav">
    <ul class="site-nav" style="padding-bottom:40px;">


		<?php
		$c = count($this->menu_groups);
		$i = 1;
		$d = 1;
		foreach ($this->menu_groups as $groups => $group) {
			if ($i == $c) { ?><li><h5>&nbsp;</h5></li>
			<?php } ?>
			<li><h5><?php echo $groups;?></h5></li>
			<?php
			foreach ($group as $menu) {
				$menu_name = (is_null($menu->name) && $menu->type !='' ) ? $menu->type : base_url($menu->name);
				$url_type  = ($menu->ext_url == 1) ? $menu->url : $menu_name;
				?>
				<li>
					<?php if ($menu->ext_url !=1 && (array) $menu->pages) { ?>
					<a href="<?php echo base_url($menu->name);?>" class="toggle" gumby-trigger="#corp-sub-<?php echo $d;?>"><i class="fa fa-blank"><img class="valignmid" src="<?php echo base_url('uploads/static/icons/'.$menu->media);?>"/></i><?php echo $menu->subject;?></a>
					<ul id="corp-sub-<?php echo $d;?>" class="drawer">
						<?php foreach ($menu->pages as $page) {
							$url_page = ($page->name) ? $page->name : $page->url;
							$urlptype = ($page->type == 'page-listing' && is_null($page->name)) ? base_url($menu->name.'/'.$page->name) : base_url($menu->name.'/'.$url_page);
							?>
							<li><a class="odrawer" href="<?php echo $urlptype;?>"><?php echo $page->subject;?></a></li>
						<?php } ?>
					</ul>
					<?php } else { ?>
					<a href="<?php echo $url_type;?>"><i class="fa fa-blank"><img class="valignmid" src="<?php echo base_url('uploads/static/icons/'.$menu->media);?>"/></i><?php echo $menu->subject;?></a>
					<?php } ?>
				</li>
			<?php
			$d++;
			}
			if ($i == $c) { ?><li><h5>&nbsp;</h5></li>
			<?php }
			$i++;
		}
		?>
    	<?php
		/*
    	$i = 1;
    	foreach ($this->menus as $types => $menus) {
    		if($types == 'product') {  ?>
    			<li><h5>Product</h5></li>
    			<?php
    			foreach ($menus as $menu) {
    				$url_type = ($menu->ext_url == 1) ? $menu->url : base_url($menu->name);?>
				 	<li>
			        	<a href="<?php echo $url_type;?>"><i class="fa fa-blank"><img class="valignmid" src="<?php echo base_url('uploads/static/icons/'.$menu->media);?>"/></i><?php echo $menu->subject;?></a>
			        </li>
    			<?php
    			}
    		} else
    		if($types == 'sales-service') {  ?>
    			<li><h5>Penjualan & Layanan</h5></li>
    			<?php
    			foreach ($menus as $menu) {
    				$url_type = ($menu->ext_url == 1) ? $menu->url : base_url($menu->name);
        			?>
				 	<li>
			        	<a href="<?php echo $url_type;?>"><i class="fa fa-blank"><img class="valignmid" src="<?php echo base_url('uploads/static/icons/'.$menu->media);?>"/></i><?php echo $menu->subject;?></a>
			        </li>
    			<?php
    			}
    		} else
    		if($types == 'auto-value') {  ?>
				<li><h5>&nbsp;</h5></li>
				<li><h5>Autovalue</h5></li>
    			<?php
    			foreach ($menus as $menu) {
    				$url_type = ($menu->ext_url == 1) ? $menu->url : base_url($menu->name);
        			?>
				 	<li>
			        	<a href="<?php echo $url_type;?>"><i class="fa fa-blank"><img class="valignmid" src="<?php echo base_url('uploads/static/icons/'.$menu->media);?>"/></i><?php echo $menu->subject;?></a>
			        </li>
    			<?php
    			}
    		} else if($types == 'corporate') {  ?>
    		<li><h5>&nbsp;</h5></li>
    		<?php
    			foreach ($menus as $menu) { ?>
				 	<li>
			        	<?php if ((array) $menu->pages ) { ?>
			        	<a href="<?php echo base_url($menu->name);?>" class="toggle" gumby-trigger="#corp-sub"><i class="fa fa-blank"><img class="valignmid" src="<?php echo base_url('uploads/static/icons/'.$menu->media);?>"/></i><?php echo $menu->subject;?></a>
			        	<ul id="corp-sub" class="drawer">
			        		<?php foreach ($menu->pages as $page) {
			        			$url_type = ($page->type == 'page-listing' && $page->name != NULL) ? base_url('corporate/'.$page->name) : base_url('corporate/'.$page->url);?>
			        			<li><a href="<?php echo $url_type;?>"><?php echo $page->subject;?></a></li>
			        		<?php } ?>
				        </ul>
				        <?php } else { ?>
				        <a href="<?php echo base_url($menu->name);?>"><i class="fa fa-blank"><img class="valignmid" src="<?php echo base_url('uploads/static/icons/'.$menu->media);?>"/></i><?php echo $menu->subject;?></a>
				        <?php } ?>
			        </li>
				<?php
				}
			} else {
				$f=0;
				foreach ($menus as $menu) { ?>
				 	<li>
				 		<?php if ((array) $menu->pages ) { ?>
			        	<a href="<?php echo base_url($menu->name);?>" class="toggle" gumby-trigger="#suzuki-corner<?php echo $f;?>"><i class="fa fa-blank"><img class="valignmid" src="<?php echo base_url('uploads/static/icons/'.$menu->media);?>"/></i><?php echo $menu->subject;?></a>
			        	<ul id="suzuki-corner<?php echo $f;?>" class="drawer">
			        		<?php foreach ($menu->pages as $page) {
			        			$url_type = ($page->name != NULL) ? base_url($page->name) : base_url($page->url);?>
			        			<li><a href="<?php echo $url_type;?>"><?php echo $page->subject;?></a></li>
			        		<?php } ?>
				        </ul>
				        <?php } else if ($menu->type != ''){
				        	$url_type = ($menu->ext_url == 1) ? $menu->url : base_url($menu->type);
			        	?>
				        <a href="<?php echo $url_type;?>"><i class="fa fa-blank"><img class="valignmid" src="<?php echo base_url('uploads/static/icons/'.$menu->media);?>"/></i><?php echo $menu->subject;?></a>
				        <?php } else {
				        	$url_type = ($menu->ext_url == 1) ? $menu->url : base_url($menu->name);
			        	?>
				        <a href="<?php echo $url_type;?>"><i class="fa fa-blank"><img class="valignmid" src="<?php echo base_url('uploads/static/icons/'.$menu->media);?>"/></i><?php echo $menu->subject;?></a>
				        <?php }?>
			        </li>
				<?php
				$f++;
				}
			}
    		$i++;
	 	}
		*/
	 	?>
    </ul>
	<ul class="site-nav" style="padding-bottom:100px;">
		<li><h5>MEDIA SOCIAL</h5></li>
		<?php foreach ($this->socials as $socials => $social) { ?>
			<li><a href="#"><?php echo $socials; ?></a></li>
			<?php foreach ($social as $value) {?>
				<li><a href="<?php echo $value->url; ?>" target="_blank"><img class="valignmid" src="<?php echo base_url('uploads/static/icons/'.$value->media);?>"><?php echo $value->name; ?></a></li>
			<?php } ?>
		<?php } ?>
	</ul>
</nav>
