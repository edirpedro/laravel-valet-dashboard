	
	</div><!-- .content -->

	<div class="info">
		<a href="/" class="info__tool">
			<div class="info__name">Valet</div>
			<div class="info__version"><?php echo get_valet_version() ?></div>
		</a>
		<a href="/nginx.php" class="info__tool">
			<div class="info__name">Nginx</div>
			<div class="info__version"><?php echo get_nginx_version() ?></div>
		</a>
		<a href="/logs.php" class="info__tool">
			<div class="info__name">PHP</div>
			<div class="info__version"><?php echo phpversion() ?></div>
		</a>
	</div>

	<div class="legends">
		<?php

		$chart = [
			'http' => 0,
			'https' => 0,
			'simple' => 0,
			'isolated' => 0,
			'proxy' => 0,
		];

		foreach ( $sites as $site ) {
			$chart[ $site->ssl ? 'https' : 'http' ] += 1;
			$chart[ $site->type ] += 1;
		}

		$total = count($sites); 

		?>
		<ul>
			<li>Secure <?php echo leading_zero($chart['https']) ?></li>
			<li>Isolated <?php echo leading_zero($chart['isolated']) ?></li>
			<li>Proxy <?php echo leading_zero($chart['proxy']) ?></li>
		</ul>
		<div class="legends__chart">
			<?php if ( $chart['http'] > 0 ) : ?>
			<div class="simple" style="width: <?php echo round( $chart['http'] / $total * 100 ) ?>%"></div>
			<?php endif; ?>
			<?php if ( $chart['https'] > 0 ) : ?>
			<div class="ssl" style="width: <?php echo round( $chart['https'] / $total * 100 ) ?>%"></div>
			<?php endif; ?>
		</div>
		<div class="legends__chart">
			<?php if ( $chart['simple'] > 0 ) : ?>
			<div class="simple" style="width: <?php echo round( $chart['simple'] / $total * 100 ) ?>%"></div>
			<?php endif; ?>
			<?php if ( $chart['isolated'] > 0 ) : ?>
			<div class="isolated" style="width: <?php echo round( $chart['isolated'] / $total * 100 ) ?>%"></div>
			<?php endif; ?>
			<?php if ( $chart['proxy'] > 0 ) : ?>
			<div class="proxy" style="width: <?php echo round( $chart['proxy'] / $total * 100 ) ?>%"></div>
			<?php endif; ?>
		</div>
	</div>

	<div class="aside">
		<div class="aside__total"><?php echo leading_zero( count( $sites ) ) ?></div>
		<div class="aside__groups"><?php echo leading_zero( count( get_groups($sites) ) ) ?></div>
	</div>

</div>

<script src="/assets/js/theme.min.js"></script>

</body>
</html>