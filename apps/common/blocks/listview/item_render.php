<?php  
  $link = $data->getObjectLink();
?>
<div class="half">
	<p style="margin-top:0">
		<h2 class="post-title"><a href="<?php echo $link; ?>"><?php echo CHtml::encode($data->object_name); ?></a></h2>
		<div class="date-author">Posted on <?php echo date("m/d/Y H:i", $data->object_date); ?> by <?php echo  $data->object_author_name; ?></div>
		<br /><br />
		<div class="desc">
		<?php echo CHtml::encode($data->object_excerpt); ?>
		</div>
	</p>
</div>