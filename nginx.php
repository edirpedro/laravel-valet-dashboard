<?php include 'header.php'; $file = 'nginx-error.log'; ?>

<div class="list logs">
	<ul>
		<?php foreach ( get_logs($file) as $key => $log ) : ?>
		<li style="--order:<?php echo $key ?>">
			<pre class="list__item is-other">
				<div><?php echo $log ?></div>
			</pre>
		</li>
		<?php endforeach; ?>
		<li><pre class="list__item is-other">More at <?php echo LOGS . "/$file" ?></pre></li>
	</ul>
</div>

<?php include 'footer.php'; ?>