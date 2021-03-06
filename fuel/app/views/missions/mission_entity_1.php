


<h3 class="text-center"><?php echo $entity['title'] ;?></h3>
<?php echo isset($entity['running']) ? '<h5 class="text-center">running</h5>' : ''; ?>

<br/>
<?php if (!$entity['security']): ?>
	<div class="well select">
		<?php if ($entity['content']): ?>
			<div style="white-space:pre;"><?php if ($entity['type'] == 1) echo html_entity_decode(nl2br($entity['content'])); else echo nl2br($entity['content']); ?></div>
		<?php else: ?>
			No human-readable content
		<?php endif; ?>
	</div>
	<?php if ($entity['type'] == 3): ?>
		<?php if (isset($entity['running'])): ?>
			<form method="post" class="text-center">
			<button type="submit" class="btn btn-default" name="action" value="kill">kill</button>
		</form>
		<?php else: $can_run = true; ?>
			<?php if ($entity['required_running']): ?>
				<h3>execution requirements</h3>
				<?php foreach($entity['required_running'] as $rr): ?>
					<p><?php echo $mission['entities'][$rr[0]]['title']; ?>

						<?php if(isset($rr[1])): ?>
							on <?php echo $mission['servers'][$mission['services'][$rr[1]]['quest_server_id']]['ip']; ?>:<?php echo $mission['services'][$rr[1]]['port']; ?>
								<?php if (isset($mission['entities'][$rr[0]]['running']) && (!isset($rr[1]) || $mission['entities'][$rr[0]]['service_id'] == $rr[1])): ?>
								  yes
								<?php else: $can_run = false; ?>
								no
								<?php endif; ?>
						<?php endif; ?>
					</p>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if ($can_run): ?>
				<form method="post" class="text-center">
	  			<button type="submit" class="btn btn-default" name="action" value="execute">execute</button>
				</form>
	  		<?php endif; ?>
  		<?php endif ;?>
	<?php endif;?>
	<?php echo View::forge('components/modal', array('id' => 'erase', 'title' => 'Are you sure?', 'content' => View::forge('missions/missions_erase'))); ?>

	<form method="post" class="text-center">
		<?php if (!isset($entity['running'])): ?>
			<a data-toggle="collapse" href="#transfer" class="btn btn-default" aria-expanded="false">transfer</a>
		<?php endif; ?>

		<a data-toggle="modal" href="#erase" class="btn btn-default btn-danger">erase</a>
	</form>
	<?php if (!isset($entity['running'])): ?>
		<div id="transfer" class="collapse">
			<div class="well">
				<?php echo View::forge('missions/mission_entity_1_transfer', array('mission' => $mission, 'entity' => $entity)); ?>
			</div>
		</div>
	<?php endif; ?>
<?php else: ?>
	<form method="post" class="text-center">
		<input type="text" name="password" placeholder="Password" class="form-control" />
		<button type="submit" class="btn btn-default" name="action" value="password">try pass</button>
		or
		<button type="submit" class="btn btn-default" name="action" value="crack">crack/decrypt</button>
	</form>
<?php endif; ?>
