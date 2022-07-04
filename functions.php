<?php

// Return the list of linked folders

function get_sites() {

	// Isolated

	$isolated = [];
	$output = explode( "\n", shell_exec('valet isolated') );
	foreach ( $output as $line ) {
		if ( strpos( $line, '|' ) === false )
			continue;
		$data = array_map( 'trim', explode( '|', $line ) );
		$isolated[] = str_replace( '.test', '', $data[1] );
	}

	// Links
	
	$links = [];
	$output = explode( "\n", shell_exec('valet links') );
	foreach ( $output as $key => $line ) {
		if ( strpos( $line, '|' ) === false || $key == 1 )
			continue;
		$data = array_map( 'trim', explode( '|', $line ) );
		$path = str_replace( $_SERVER['HOME'], '', $data[4] );
		$links[] = (object) [
			'site' => $data[1] . '.test',
			'ssl' => $data[2],
			'url' => $data[3],
			'path' => $path,
			'php' => $data[5],
			'type' => in_array( $data[1], $isolated ) ? 'isolated' : 'simple',
			'group' => get_group_name( $path )
		];
	}

	// Proxies

	$output = explode( "\n", shell_exec('valet proxies') );
	foreach ( $output as $key => $line ) {
		if ( strpos( $line, '|' ) === false || $key == 1 )
			continue;
		$data = array_map( 'trim', explode( '|', $line ) );
		$links[] = (object) [
			'site' => $data[1] . '.test',
			'ssl' => $data[2],
			'url' => $data[3],
			'path' => $data[4],
			'php' => '',
			'type' => 'proxy',
			'group' => 'Proxies'
		];
	}

	// return json_decode(file_get_contents('sites.json')); // Debuging
	return $links;

}

// Return group name from path

function get_group_name( $path ) {
	$path = explode( '/', $path );
	return $path[GROUP];
}

// Return groups

function get_groups( $sites ) {
	$groups = [];
	if ( GROUP == 0 ) return $groups;
	foreach ( $sites as $site ) {
		if ( $site->group == 'valet' )
			continue;
		if ( ! in_array( $site->group, $groups ) )
			$groups[] = $site->group;
	}
	natsort($groups);
	return $groups;
}

// Leading zeros

function leading_zero( $number, $n = 2 ) {
	return str_pad( $number, $n, 0, STR_PAD_LEFT );
}

// Dashboad body options

function body() {
	switch ( BODY ) {
		case 'wallpaper':
			echo 'style="background-image:url(' . get_random_wallpaper() . ')"';
			break;
		case 'bing':
			echo 'style="background-image:url(' . get_bing_wallpaper() . ')"';
			break;
		default:
			if ( strstr(BODY, '#') ) echo 'style="background-color:' . BODY . '"';
			break;
	}
}

// Bing Daily Wallpaper

function get_bing_wallpaper( $mkt = 'pt-BR' ) {
	$json = file_get_contents('https://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=' . $mkt);
	$json= json_decode($json);
	return 'https://www.bing.com' . $json->images[0]->url;
}

// Random wallpaper

function get_random_wallpaper() {
	$images = glob( 'assets/wallpaper/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE );
	$key = array_rand( $images, 1 );
	return '/' . $images[$key];
}

// Get log information

function get_logs( $file ) {
	$pattern = "\n[";
	if ( $file == 'nginx-error.log' ) $pattern = "\n";
	$content = file_get_contents(LOGS . "/$file");
	$content = explode( $pattern, $content );
	$logs = array_slice( $content, -25 );
	rsort($logs);
	return $logs;
}

// Return Nginx version

function get_nginx_version() {
	return str_replace( 'nginx/', '', $_SERVER['SERVER_SOFTWARE'] );
}

// Return Valet version

function get_valet_version() {
	return str_replace('Laravel Valet ', '', shell_exec('valet -V') );
}