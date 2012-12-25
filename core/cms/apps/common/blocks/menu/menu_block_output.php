<?php $count = 0; ?>
<?php if($this->beginCache('menu-render-header'.$this->menu_id, array('duration'=>7200))) { ?>
<div id="header-menu">
<div class="container">
<ul>
            <?php foreach ($menus as $menu) :?>
                <li><a href="<?php echo $menu['link'];?>" title="<?php echo $menu['name'];?>" <?php echo isset($_GET['slug'])&&$_GET['slug']==$menu['link']?'class="active"':'';?>><span><span> <?php echo $menu['name'];?> </span></span></a> </li>  
            <?php endforeach;?>
</ul>
</div>
</div>
<?php $this->endCache(); } ?>
