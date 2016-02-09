<?php defined('_NOAH') or die('Restricted access'); ?>
<div id='checkconf'>
  <h1><?php echo $this->get("title") ?></h1>
  <?php foreach($this->get("report") as $report): ?>
    <p class='<?php echo $report[1] ?>'><?php echo $report[0] ?></p>
  <?php endforeach; ?>
</div>
