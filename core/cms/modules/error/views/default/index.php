<?php if($error['code']==404): ?>
<div class="alert alert-block">  
  <h4><?php echo $error['code']; ?></h4>
  <p><?php echo $error['message']; ?></p>
</div>
<?php else: ?>
<div class="alert alert-error">
   <h4><?php echo $error['code']; ?></h4>
  <p><?php echo $error['message']; ?></p>
<?php endif; ?>