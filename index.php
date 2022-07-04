<?php include 'header.php' ?>

<div class="list">
	<ul id="sites">
		<?php foreach ( $sites as $key => $site ) : ?>
		<li data-group="<?php echo $site->group ?>" style="--order:<?php echo $key ?>">
			<a class="list__item type-<?php echo $site->type ?><?php echo $site->ssl ? '-ssl' : null ?>" href="<?php echo $site->url ?>">
				<div class="list__name">
					<?php echo $site->site ?>
					<small><?php echo $site->path ?></small>
				</div>
				<div class="list__tags">
					<?php if ( $site->ssl ) : ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18 10v-4c0-3.313-2.687-6-6-6s-6 2.687-6 6v4h-3v14h18v-14h-3zm-10 0v-4c0-2.206 1.794-4 4-4s4 1.794 4 4v4h-8z"/></svg>
					<?php endif; ?>
					<?php if ( $site->php ) : ?>
					<span><?php echo $site->php ?></span>
					<?php endif; ?>
					<?php if ( $site->type == 'proxy' ) : ?>
					<span>proxy</span>
					<?php endif; ?>
				</div>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
</div>

<div class="menu">
	<ul id="groups">
		<?php foreach ( get_groups($sites) as $name ) : ?>
		<li><a><?php echo $name ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>

<?php include 'footer.php'; ?>