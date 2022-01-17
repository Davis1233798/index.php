<?php
    global $_env;
    $_env = array(
        //資料庫設定
        'db_host'=>'127.0.0.1',
        'db_port'=>'3306',
        'db_name'=>'899b',
        'db_user'=>'root',
        'db_pass'=>'osun000',

        //ms sql資料庫設定
        'mssqldb_host'=>'127.0.0.1',
        'mssqldb_port'=>'1433',
        'mssqldb_name'=>'osundb_test',
        'mssqldb_user'=>'osun',
        'mssqldb_pass'=>'osun000',

        'site_code'=>'899b',//預設網站代碼
        'site_title'=>'臺北榮民總醫院健康管理中心',//預設網站名稱
        'site_timezone'=>'Asia/Taipei',//預設網站名稱
		'site_url'=>'https://'.$_SERVER['HTTP_HOST'].'/',//網站網址
		'site_path'=>dirname(__dir__).'/',//網站根目錄
		'site_admin_url'=>'https://'.$_SERVER['HTTP_HOST'].'/admin/',//後台網址
		'site_admin_path'=>dirname(__dir__).'/admin/',//後台目錄
		'site_upload_url'=>'https://'.$_SERVER['HTTP_HOST'].'/upload/',//上傳檔案網址
        'site_upload_path'=>dirname(__dir__).'/upload/',//上傳檔案目錄
        
        // 記住帳密碼有效時間
        'setting_login_remember'=>604800,

        // 頁碼設定
        'setting_pagesize'=>10,
        'setting_pagersize'=>5,
        
        // 網站到期提醒
        'deadline_lock'=>false,//是否執行到期檢查
        'deadline_remindday'=>10,//到期前幾天開始顯示通知
        'deadline_expireday'=>7,//到期後幾天封鎖網站
    );
    
?>