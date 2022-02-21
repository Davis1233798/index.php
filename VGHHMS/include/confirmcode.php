<?
	include_once(__DIR__.'/baseclass.php');
	$page = get_get('p');
	switch($page){
		default:
			create_confirmcode('');
			break;
		case 'admin_login':
			create_confirmcode($_env['site_code'].'_admin_login', 4, 150, 50, 15);
			break;
		case 'contact':
			create_confirmcode($_env['site_code'].'_contact', 5, 150, 50, 15);
			break;
	}
	
?>