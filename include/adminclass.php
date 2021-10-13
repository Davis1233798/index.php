<?
	include(__DIR__.'/baseclass.php');

	// 判斷登入
	switch($_baseenv['page_type']){
		case 'page':
			page_check_login();
			$_sidebar = load_sidebar_data(false);
			page_check_auth(array_key_exists('fn_c_code', $_pageenv)?$_pageenv['fn_c_code']:$_pageenv['fn_code']);//檢查功能權限，若為子功能則以子功能代碼檢查
			break;
		case 'ajax':
			ajax_check_login();
			ajax_check_auth(array_key_exists('fn_c_code', $_pageenv)?$_pageenv['fn_c_code']:$_pageenv['fn_code']);//檢查功能權限，若為子功能則以子功能代碼檢查
			break;
		case 'home':
			page_check_login();
			$_sidebar = load_sidebar_data(false);
			break;
		case 'login':
			page_check_login();
			break;
		default:
			break;
	}

	// 檢查是否登入，若未登入則導至登入頁
	function page_check_login(){
		global $_env;
		
		$now_url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$arr_login_url = array(
			$_env['site_admin_url'],
			$_env['site_admin_url'].'index.php',
		);
		
		// 檢查登入狀態
		$login = do_check_login();
	
		// 檢查網站是否到期
		$deadline = do_check_deadline();
		switch($deadline['status']){
			default:
				break;
			case 2:
			case 3:
				if(in_array($now_url, $arr_login_url)) echo '<script>alert("', $deadline['msg'], '")</script>';
				break;
			case 4:
				if(in_array($now_url, $arr_login_url)){
					// 在登入畫面，顯示訊息
					echo '<script>alert("', $deadline['msg'], '")</script>';
					break;
				} else {
					// 不在登入畫面，執行登出後導到登入頁
					if($login) do_logout();
					header('Location: '.$_env['site_admin_url']);
					return;
				}
		}
		
		if(!$login&&!in_array($now_url, $arr_login_url)){
			header('Location: '.$_env['site_admin_url'].'logout.php');//未登入且不在登入畫面，則導到登出頁
			exit;
		}
		if($login&&in_array($now_url, $arr_login_url)){
			header('Location: '.$_env['site_admin_url'].'home.php');//已登入但在登入畫面，則導到後台首頁
			exit;
		}
	}
	
	// 檢查是否登入，若未登入回傳JSON
	function ajax_check_login(){
		if(!do_check_login()){
			header('Content-Type: application/json');
			echo json_encode(array('ok'=>'l'));
			exit;
		}
	}
	
	// 判斷是否登入
	function do_check_login($acc='', $psd=''){
		global $_env;
		global $db;
		$sql = 'SELECT `id`, `acc`, `psd`, `name`, `auth` FROM `sys_manager` WHERE `inuse` = 1 AND `deled` = 0 ';
		
		if($acc==''&&$psd==''){
			// 從SESSION檢查登入狀態
			if($_SESSION[$_env['site_code'].'_manager_login']){
				
				$input = array(
					'acc'=>$_SESSION[$_env['site_code'].'_manager_login']['acc'],
					'psd'=>$_SESSION[$_env['site_code'].'_manager_login']['psd'],
				);
				$sql .= 'AND `acc` = :acc AND `psd` = :psd ';
				$manager = $db->doselect_first($sql, $input);
			}
		} else {
			// 由輸入的帳密判斷是否登入
			$input = array(
				'acc'=>$acc,
				'psd'=>$psd,
			);
			$sql .= 'AND `acc` = :acc AND `psd` = md5(:psd) ';
			$manager = $db->doselect_first($sql, $input);
		}
		
		if($manager==null) return false;
		else {
			$_SESSION[$_env['site_code'].'_manager_login'] = $manager;
			if($manager['auth']=='') $_SESSION[$_env['site_code'].'_manager_auth'] = array();
			else $_SESSION[$_env['site_code'].'_manager_auth'] = explode('||', substr($manager['auth'], 1, -1));
			return true;
		}
	}
	
	// 登出
	function do_logout(){
		global $_env;
		unset($_SESSION[$_env['site_code'].'_manager_login']);
	}
	
	// 判斷網站到期狀況
	function do_check_deadline(){
		global $_env;
	
		if($_env['deadline_lock']===true){
			global $db;
	
			$para = array(
				'remindday'=>$_env['deadline_remindday'],
				'expireday'=>$_env['deadline_expireday'],
			);
			$sql = 'SELECT IFNULL(site_deadline, \'\') AS deadline, 
						ADDDATE(site_deadline, INTERVAL - :remindday DAY) AS remindday, 
						ADDDATE(site_deadline, INTERVAL + :expireday DAY) AS expireday 
					FROM sys_config';
			$data = $db->doselect_first($sql, $para);
	
			if($data['deadline']!=''){
				$today = strtotime(DATE('Y-m-d', time()));
				$deadline = strtotime($data['deadline']);
				$remindday = strtotime($data['remindday']);
				$expireday = strtotime($data['expireday']);
	
				if($today>=$remindday&&$today<$deadline){
					// 顯示即將到期提醒
					return array(
						'status'=>2,
						'msg'=>'您的網站即將於 '.date('Y/m/d', $deadline).' 到期，請儘快與我們聯絡',
					);
				} else if($today>=$deadline&&$today<$expireday){
					// 顯示即將封鎖後台提醒
					return array(
						'status'=>3,
						'msg'=>'您的網站已於 '.date('Y/m/d', $deadline).' 到期，系統將在 '.date('Y/m/d', $expireday).' 封鎖後台，請儘快與我們聯絡',
					);
				} else if($today>=$expireday){
					// 顯示後台已被封鎖提醒
					return array(
						'status'=>4,
						'msg'=>'您的網站已於 '.date('Y/m/d', $deadline).' 到期，系統已封鎖後台，請儘快與我們聯絡',
					);
				}
			}
		}
	
		return array(
			'status'=>1,
			'msg'=>'',
		);
	}

	// 取得網站功能清單
	function load_sidebar_data($get_all=true){
		global $db;
		global $_env;
		
		$sql = 'SELECT fn.id AS fn_id, fn.fn_code AS fn_code, fn.fn_icon AS fn_icon, fn.fn_name AS fn_name, 
				IFNULL(c.id, \'\') AS c_id, IFNULL(c.fn_code, \'\') AS c_code, IFNULL(c.fn_name, \'\') AS c_name 
			FROM sys_auth fn 
			LEFT JOIN sys_auth c ON fn.id = c.p_id AND c.inuse = 1
			WHERE fn.p_id = 0 AND fn.inuse = 1 ';
		if($get_all===false){
			$sql .= 'AND (
				fn.id IN ('.implode(',', $_SESSION[$_env['site_code'].'_manager_auth']).') 
				OR c.id IN ('.implode(',', $_SESSION[$_env['site_code'].'_manager_auth']).')
			) ';
		}

		$sql .= 'ORDER BY fn.sort, fn.id, c.sort, c.id';
		return $db->doselect($sql);
	}

	// 檢查是否有功能權限，若未沒有則導至後台首頁
	function page_check_auth($fn_code){
		global $_env;
		
		// 檢查功能權限
		$auth = do_check_auth($fn_code);
		
		if(!$auth) {
			//沒有功能權限，則導至後台首頁
			echo '<script>alert("您沒有操作此功能的權限");location.replace("', $_env['site_admin_url'], 'home.php")</script>';
			exit;
		}
	}
	
	// 檢查是否有功能權限，若沒有功能權限回傳JSON
	function ajax_check_auth($fn_code){
		if(!do_check_auth($fn_code)){
			header('Content-Type: application/json');
			echo json_encode(array('ok'=>'a'));
			exit;
		}
	}

	// 判斷登入者是否有此功能權限
	function do_check_auth($fn_code){
		global $db;
		global $_env;
		
		$para = array(
			'fn_code'=>$fn_code
		);
		$sql = 'SELECT fn.id AS fn_id, IFNULL(p.inuse, \'1\') AS p_inuse 
			FROM sys_auth fn 
			LEFT JOIN sys_auth p ON fn.p_id = p.id 
			WHERE fn.inuse = 1 AND fn.fn_code = :fn_code ';
			
		$data = $db->doselect_first($sql, $para);
		if(!$data||$data['p_inuse']!='1'||!in_array($data['fn_id'], $_SESSION[$_env['site_code'].'_manager_auth'])) return false;
		else return true;
	}
	
	// 產生頁碼
	function create_pager($pager_para){
		
		if($pager_para['total_pages']>1){
			echo '<nav>';
			echo '<ul class="pagination">';
			
			if($pager_para['page']>1) echo '<li class="page-item"><a class="page-link" href="javascript:index_go_page(1)">第一頁</a></li>';
			if($pager_para['page']>1) echo '<li class="page-item"><a class="page-link" href="javascript:index_go_page(', ($pager_para['page']-1), ')">上一頁</a></li>';
			
			global $_env;
			$min = $pager_para['page'] - (($_env['setting_pagersize']-1)/2);
			if($_env['setting_pagersize']%2==1) $max = $pager_para['page'] + (($_env['setting_pagersize']-1)/2);
			else $max = $pager_para['page'] + ($_env['setting_pagersize']/2);
			if($min<1) $min = 1;
			if($pager_para['total_pages']-$_env['setting_pagersize']+1<$min){
				if($pager_para['total_pages']-$_env['setting_pagersize']+1<1) $min = 1;
				else $min = $pager_para['total_pages']-$_env['setting_pagersize']+1;
			}
			if($max>$pager_para['total_pages']) $max = $pager_para["total_pages"];
			if($max<=$_env['setting_pagersize']) {
				if($_env['setting_pagersize']>=$pager_para['total_pages'])$max = $pager_para['total_pages'];
				else $max = $_env['setting_pagersize'];
			}
	
			if($pager_para['page']>10) echo '<li><a class="page-link" href="javascript:index_go_page(', ($pager_para['page']-10), ')">', ($pager_para['page']-10), '</a></li>';
			if($min>1) echo '<li><a class="page-link" href="javascript:index_go_page(', ($min-1), ')">...</a></li>';
			for($i=$min;$i<=$max;$i++){
				echo '<li';
				if($i==$pager_para['page']) echo ' class="page-item active"';
				echo '><a class="page-link" href="javascript:index_go_page(', $i, ')">', $i, '</a></li>';
			}
			if($max<$pager_para['total_pages']) echo '<li><a class="page-link" href="javascript:index_go_page(', ($max+1), ')">...</a></li>';
			if($pager_para['page']+10<=$pager_para['total_pages']) echo '<li><a class="page-link" href="javascript:index_go_page(', ($pager_para['page']+10), ')">', ($pager_para['page']+10), '</a></li>';
			if($pager_para['page']<$pager_para['total_pages']) echo '<li class="page-item"><a class="page-link" href="javascript:index_go_page(', ($pager_para['page']+1), ')">下一頁</a></li>';
			if($pager_para['page']<$pager_para['total_pages']) echo '<li class="page-item"><a class="page-link" href="javascript:index_go_page(', $pager_para['total_pages'], ')">最後一頁</a></li>';
			
			echo '</ul>';
			echo '</nav>';
		}
	}
?>