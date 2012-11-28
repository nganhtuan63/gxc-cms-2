<?php  
  $link = $data->getObjectLink();
?>
<div class="half">
	<p style="margin-top:0">
		<strong><a href="<?php echo $link; ?>"><?php echo CHtml::encode($data->object_name); ?></a></strong>
		<span><?php echo date("m/d/Y H:i", $data->object_date); ?></span>
		<br />
		<?php echo CHtml::encode($data->object_excerpt); ?>
	</p>
</div>