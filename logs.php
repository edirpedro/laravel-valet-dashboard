<?php include 'header.php'; $file = 'php-fpm.log' ?>

<div class="list logs">
	<ul>
		<?php foreach ( get_logs($file) as $key => $log ) :
			$type = 'other'; 
			if ( strstr($log, 'PHP Fatal error:') )	$type = 'error';
			elseif ( strstr($log, 'PHP Notice:') )	$type = 'notice';
			elseif ( strstr($log, 'PHP Warning:') )	$type = 'warning';
		?>
		<li style="--order:<?php echo $key ?>">
			<pre class="list__item is-<?php echo $type ?>">
				<div><?php echo $log ?></div>
			</pre>
		</li>
		<?php endforeach; ?>
		<li><pre class="list__item is-other">More at <?php echo LOGS . "/$file" ?></pre></li>
	</ul>
</div>

<?php include 'footer.php'; ?>