<?php
/**
 * This is a sample config for local development. wp-config.php will
 * load this file if you're not in a Pantheon environment. Simply edit/copy
 * as needed and rename to wp-config-local.php.
 *
 * Be sure to replace YOUR LOCAL DOMAIN below too.
 */

define( 'WP_HOME', 'http://d2tweb.docksal' );
define( 'WP_SITEURL', 'http://d2tweb.docksal' );

define( 'WP_AUTO_UPDATE_CORE', false );

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define( 'SCRIPT_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );
ini_set( 'display_errors', 1 );

# Docksal DB connection settings for wordpress.
define( 'DB_NAME', getenv('MYSQL_DATABASE') );
define( 'DB_USER', getenv('MYSQL_USER') );
define( 'DB_PASSWORD', getenv('MYSQL_PASSWORD') );
define( 'DB_HOST', getenv('MYSQL_HOST') );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', 'utf8_general_ci' );

# Authentication Unique Keys and Salts.
define('AUTH_KEY',         '=[Q1Sy4C:?r^#GS@l-3MK2ahDijq~2[Ic%y 3%aFHH|5>-5k+jn;o<<vuZy+M*5$');
define('SECURE_AUTH_KEY',  '!%SISD$BVhB2n|Xl5m5EI}}|KTP5]O^P,KI<VypVC6uh!5;qw,[/5+}zpu ?$`Rm');
define('LOGGED_IN_KEY',    'rtO1AII-+{|~SVtNKn?:R@iiQi#hwCLJ^l5{`r otlk9uoDH;QkSlH^iX@3dUA(*');
define('NONCE_KEY',        '=`G#I`gJ7|+bdQCI(p5jSL%.~U4XFz9Y$^| ;6fM#IL<24Da(]uQ@N/fZ)CLNg3$');
define('AUTH_SALT',        'cfdXJWR<BM|8%M(d>ug=OPtL#X<NmWe,xN77*f,yW5,cS,7MgoHSw/VG=cZv}pDz');
define('SECURE_AUTH_SALT', '^o87XJ w62&?D.QNqknd}uz^S!p$J1]T^2Y?wauT/<W>)i3fov0}_s|8^-U]p);^');
define('LOGGED_IN_SALT',   's}mw1IFevO[/vnv~WD! TkS|2#8xT8b-We<RP#mL7&icw0G}pS_H;2 TU|qaLL=~');
define('NONCE_SALT',       'Urz&3e(~#C7Hc=b?K>U;S|}JDek-/3Fw}D<zrk;9Vp&Z|U,YFg;Ni@`U)AR2SaLp');

function download($source, $destination) {
	$ch = curl_init();
	$fp = fopen ($destination, 'w+');
	curl_setopt($ch, CURLOPT_URL, $source);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSLVERSION,0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

	$res = curl_exec($ch);
	curl_close($ch);
	fclose($fp);
}

function startsWith ($string, $startString) {
	$len = strlen($startString);
	return (substr($string, 0, $len) === $startString);
}

$url = '.'.$_SERVER["REQUEST_URI"];
$file = urldecode(strtok($url, '?'));
if (startsWith($file,'./wp-content/uploads') &&!file_exists($file)) {
	$dir = dirname($file);
	if (!file_exists($dir)) {
		mkdir($dir, 0777, true);
	}
	$link = str_replace('./','https://dev-d2tweb.pantheonsite.io/', $url);
	download($link, $file);
	exit;
}
