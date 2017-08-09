

<!-- Primary Navigation
============================================= -->
<nav id="primary-menu">
	<ul>
		<!--li class="current"><a href="<?php echo base_url();?>"><div>Home</div></a></li-->
		<?php foreach ($this->menus as $menus => $menu) { 
			$url = ($menu->is_system == 1) ? base_url() : base_url($menu->url);
			$url = ($menu->pages) ? '#' : $url;
			?>
			<li><a href="<?php echo $url;?>" title="<?php echo $menu->subject;?>"><div><?php echo $menu->subject;?></div></a>
				<?php 
				if ($menu->pages && is_array($menu->pages)) { ?>
				<ul>
					<?php foreach ($menu->pages as $page) { ?>
					<li><a href="<?php echo base_url('page/'.$page->url);?>" title="<?php echo $page->subject;?>"><div><?php echo $page->subject;?></div></a></li>
					<?php 
					}
					?>
				</ul>
				<?php
				} ?>
			</li>	
		<?php } ?>
	</ul>						
	<!-- Top Search
	============================================= -->
	<div id="top-search">
		<a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
		<form action="<?php echo base_url();?>" method="get">
			<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
		</form>
	</div><!-- #top-search end -->
</nav><!-- #primary-menu end -->






<?php /*

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
    </ul>
</nav>

*/
?>
