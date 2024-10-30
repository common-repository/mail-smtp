<?php
/**
 * Plugin Name: Mail SMTP
 * Plugin URI: https://wordpress.org/plugins/mail-smtp/
 * Description: Simply configure your SMTP server and send email directly from WordPress site.
 * Version: 1.0
 * Author: Sirius Pro
 * Author URI: https://siriuspro.pl
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

add_action( 'admin_menu', 'sp_smtp_options_page' );

function sp_smtp_options_page() {

	add_options_page(
		'Mail SMTP', // page <title>Title</title>
		'Mail SMTP', // menu link text
		'manage_options', // capability to access the page
		'smtp_slug', // page URL slug
		'sp_smtp_server_content', // callback function with content,
		'dashicons-upload',
		99 // priority
	);

}


function sp_smtp_server_content(){

	echo '<div class="wrap">
	<h1>Mail SMTP configuration</h1>
	<form method="post" action="options.php">';
			
		settings_fields( 'sp_smtp_server_settings' ); // settings group name
		do_settings_sections( 'smtp_slug' ); // just a page slug
		submit_button();

	echo '</form></div>';

}

add_action( 'admin_init',  'sp_smtp_server_register_setting' );

function sp_smtp_server_register_setting(){

	register_setting(
		'sp_smtp_server_settings', // settings group name
		'smtp_host', // option name
		'sanitize_text_field' // sanitization function
	);
	
	register_setting(
		'sp_smtp_server_settings', // settings group name
		'smtp_port', // option name
		'sanitize_text_field' // sanitization function
	);	
	
	register_setting(
		'sp_smtp_server_settings', // settings group name
		'smtp_username', // option name
		'sanitize_text_field' // sanitization function
	);	
	
	register_setting(
		'sp_smtp_server_settings', // settings group name
		'smtp_password', // option name
		'sanitize_text_field' // sanitization function
	);	
	
	register_setting(
		'sp_smtp_server_settings', // settings group name
		'smtp_from', // option name
		'sanitize_text_field' // sanitization function
	);	
	
	register_setting(
		'sp_smtp_server_settings', // settings group name
		'smtp_fromname', // option name
		'sanitize_text_field' // sanitization function
	);
	
	register_setting(
		'sp_smtp_server_settings', // settings group name
		'smtp_replyto', // option name
		'sanitize_text_field' // sanitization function
	);	
	register_setting(
		'sp_smtp_server_settings', // settings group name
		'smtp_ssl', // option name
		'sanitize_text_field' // sanitization function
	);		

	add_settings_section(
		'sp_smtp_server_settings_section', // section ID
		'', // title (if needed)
		'', // callback function (if needed)
		'smtp_slug' // page slug
	);

	add_settings_field(
		'smtp_host',
		'Server name (hostname)',
		'sp_smtp_server_host_field', // function which prints the field
		'smtp_slug', // page slug
		'sp_smtp_server_settings_section', // section ID
		array( 
			'label_for' => 'smtp_host',
			'class' => 'sp_smtp_server_host_class', // for <tr> element
		)
	);
	
	add_settings_field(
		'smtp_port',
		'Server port (port)',
		'sp_smtp_server_port_field', // function which prints the field
		'smtp_slug', // page slug
		'sp_smtp_server_settings_section', // section ID
		array( 
			'label_for' => 'smtp_port',
			'class' => 'sp_smtp_server_port_class', // for <tr> element
		)
	);
	
	add_settings_field(
		'smtp_username',
		'User name (username)',
		'sp_smtp_server_username_field', // function which prints the field
		'smtp_slug', // page slug
		'sp_smtp_server_settings_section', // section ID
		array( 
			'label_for' => 'smtp_username',
			'class' => 'sp_smtp_server_username_class', // for <tr> element
		) 
	);
	
	add_settings_field(
		'smtp_password',
		'User password (password)',
		'sp_smtp_server_password_field', // function which prints the field
		'smtp_slug', // page slug
		'sp_smtp_server_settings_section', // section ID
		array( 
			'label_for' => 'smtp_password',
			'class' => 'sp_smtp_server_pasword_class', // for <tr> element
		)
	);
	
	add_settings_field(
		'smtp_from',
		'Email address (from)',
		'sp_smtp_server_from_field', // function which prints the field
		'smtp_slug', // page slug
		'sp_smtp_server_settings_section', // section ID
		array( 
			'label_for' => 'smtp_from',
			'class' => 'sp_smtp_server_from_class', // for <tr> element
		)
	);
	
	add_settings_field(
		'smtp_fromname',
		'Display name (fromname)',
		'sp_smtp_server_fromname_field', // function which prints the field
		'smtp_slug', // page slug
		'sp_smtp_server_settings_section', // section ID
		array( 
			'label_for' => 'smtp_fromname',
			'class' => 'sp_smtp_server_fromname_class', // for <tr> element
		)
	);

	add_settings_field(
		'smtp_replyto',
		'Reply address (reply-to)',
		'sp_smtp_server_replyto_field', // function which prints the field
		'smtp_slug', // page slug
		'sp_smtp_server_settings_section', // section ID
		array( 
			'label_for' => 'smtp_replyto',
			'class' => 'sp_smtp_server_replyto_class', // for <tr> element
		)
	);
	add_settings_field(
		'smtp_ssl',
		'Server encryption (protocol)',
		'sp_smtp_server_ssl_field', // function which prints the field
		'smtp_slug', // page slug
		'sp_smtp_server_settings_section', // section ID
		array( 
			'label_for' => 'smtp_ssl',
			'class' => 'sp_smtp_server_ssl_class', // for <tr> element
		)
	);

}


function sp_smtp_server_host_field(){

	$smtp_host = get_option( 'smtp_host' );

	printf(
		'<input type="text" id="smtp_host" name="smtp_host" value="%s" placeholder="mail.com"/>',
		esc_attr( $smtp_host )
	);

}

function sp_smtp_server_port_field(){

	$smtp_port = get_option( 'smtp_port' );

	printf(
		'<input type="text" id="smtp_port" name="smtp_port" value="%s" placeholder="25, 465 or 587"/>',
		esc_attr( $smtp_port )
	);

}

function sp_smtp_server_username_field(){

	$smtp_username = get_option( 'smtp_username' );

	printf(
		'<input type="text" id="smtp_username" name="smtp_username" value="%s" placeholder="your@mail.com"/>',
		esc_attr( $smtp_username )
	);

}

function sp_smtp_server_password_field(){

	$smtp_password = get_option( 'smtp_password' );

	printf(
		'<input type="text" id="smtp_password" name="smtp_password" value="%s" placeholder="yourpassword"/>',
		esc_attr( $smtp_password )
	);

}

function sp_smtp_server_from_field(){

	$smtp_from = get_option( 'smtp_from' );

	printf(
		'<input type="text" id="smtp_from" name="smtp_from" value="%s" placeholder="your@mail.com"/>',
		esc_attr( $smtp_from )
	);

}

function sp_smtp_server_fromname_field(){

	$smtp_fromname = get_option( 'smtp_fromname' );

	printf(
		'<input type="text" id="smtp_fromname" name="smtp_fromname" value="%s" placeholder="other@mail.com"/>',
		esc_attr( $smtp_fromname )
	);

}

function sp_smtp_server_replyto_field(){

	$smtp_replyto = get_option( 'smtp_replyto' );

	printf(
		'<input type="text" id="smtp_replyto" name="smtp_replyto" value="%s" placeholder="my@mail.com"/>',
		esc_attr( $smtp_replyto )
	);

}

function sp_smtp_server_ssl_field(){

	$smtp_ssl = get_option( 'smtp_ssl' );
	$ssl_value = 'ssl';
    $ssl_title = 'SSL';
    $tls_value = 'tls';
    $tls_title = 'TLS';
	$slected_ssl = $selected_tls = '';
	if($smtp_ssl ==  'ssl'){
  	  $slected_ssl = ' selected ';
	}
	if($smtp_ssl ==  'tls'){
  	  $selected_tls = ' selected ';
	}
    echo '<select id="smtp_ssl" name="smtp_ssl"/>';
    echo '<option value="'. esc_attr($ssl_value).'"  ' . esc_attr($slected_ssl) . ' >' . esc_html($ssl_title)  . '</option>';
    echo '<option value="'. esc_attr($tls_value).'"  ' . esc_attr($selected_tls) . ' >' . esc_html($tls_title)  . '</option>';
    echo '</select>';
}

add_action( 'phpmailer_init', 'sp_phpmailer_smtp' );
function sp_phpmailer_smtp( $phpmailer ) {

	$host = get_option( 'smtp_host' );
	$port = get_option( 'smtp_port' );
	$username = get_option( 'smtp_username' );
	$password = get_option( 'smtp_password' );
	$from = get_option( 'smtp_from');	
	$fromname = get_option( 'smtp_fromname' );
	$replyto = get_option( 'smtp_replyto' );
	$ssl = get_option( 'smtp_ssl' );
	
    $phpmailer->isSMTP();     
    $phpmailer->Host = $host;  
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = $port;
    $phpmailer->Username = $username;
    $phpmailer->Password = $password;
    $phpmailer->SMTPSecure = $ssl;
    if (!empty($from)) {
    $phpmailer->From = $from;
    }
    $phpmailer->FromName = $fromname;
    if (!empty($replyto)) {
	$phpmailer->AddReplyTo($replyto,$phpmailer->FromName);
	}
}