<h3 class="text-center"><?php echo $entity['title'] ;?></h3>
<h5 class="text-center"><?php echo $entity['sender_receiver'] ;?></h5>
<br/>
<form method="post">

<?php if (!$entity['security']): ?>

		<div class="well select">
			<?php echo html_entity_decode(nl2br($entity['content'])); ?>
		</div>
		<div class="text-center">
			<?php echo View::forge('components/modal', array('id' => 'erase', 'title' => 'Are you sure?', 'content' => View::forge('missions/missions_erase'))); ?>
			<a data-toggle="modal" href="#erase" class="btn btn-default btn-danger">erase</a>

</div>
<?php else: ?>
	<?php if ($entity['security']): ?>
		<div class="text-center">

  	<button type="submit" class="btn btn-default" name="action" value="crack">crack</button>
	</div>
  <?php endif; ?>

<?php endif; ?>

</form>
