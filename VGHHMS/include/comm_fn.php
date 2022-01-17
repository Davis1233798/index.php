<?

// 取得POST參數，若無值則代入預設值
function get_post($field, $def_val=''){
	if(!empty($_POST[$field])) return stripslashes(strip_tags(trim($_POST[$field])));
	else return $def_val;
}

// 取得GETT參數，若無值則代入預設值
function get_get($field, $def_val=''){
	if(!empty($_GET[$field])) return stripslashes(strip_tags(trim($_GET[$field])));
	else return $def_val;
}

// 檢查是否date
function chk_is_date($val){
	$data = strtotime($val);
	if($data == '') return false;
	else return true;
}

// 檢查是否int
function chk_is_int($val){
	if (!is_numeric($val)||strpos($val, '.')>-1) return false;
	else return true;
}

// 檢查是否mail
function chk_is_mail($val){
	if (!filter_var($val, FILTER_VALIDATE_EMAIL)) return false;
	else return true;
}

// 檢查是否電話
function chk_is_tel($val){
	$val = str_replace('-', '', $val);
	$val = str_replace(' ', '', $val);
	$val = str_replace('(', '', $val);
	$val = str_replace(')', '', $val);
	
	$len = strlen($val);
	
	if(!preg_match('/^[0][0-9]{8,9}/', $val)||$len<9||$len>10){
		return false;
	} else {
		return true;
	}
}

// 檢查是否手機
function chk_is_mobile($val){
	if (substr($val, 0, 2)!='09'||strlen($val)!=10) return false;
	else return true;
}

// 產生驗證碼圖形
function create_confirmcode($session_name, $num_max=4, $img_width=103, $img_height=35, $font_size=15){


	$mass = 1500;  // 雜點的數量，數字愈大愈不容易辨識

    //自訂義認證碼表,刪除時請連同後面的逗號一起刪除
    $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
         'j', 'k', 'm', 'n', 'p', 'q', 'r', 's',
        't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D',
        'E', 'F', 'G', 'H',  'J', 'K', 'M', 'N',
        'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z',
        '2', '3', '4', '5', '6', '7', '8', '9');
    // 驗證碼
	$num = '';
	$keys = array_rand($chars, $num_max); //從chars array中取出1個字串
    for ($a = 0; $a<$num_max; $a++) {
        $num .=$chars[$keys[$a]] ;    //將keys字串寫入num中
    }


	if($session_name!='') $_SESSION[$session_name] = $num;//驗證碼存入Session

	// 創造圖片，定義圖形和文字顏色
	header('Content-type: image/PNG');
	srand((float) microtime() * 1000000);
	$im = imagecreate($img_width, $img_height);
	$color_word = imagecolorallocate($im, 150, 150, 200);    // 文字顏色
	$color_point = imagecolorallocate($im, 160, 155, 215);    // 雜訊顏色
	$color_bg = imagecolorallocate($im, 236, 233, 214); // 背景顏色
    $color_bg_point_1 = imagecolorallocate($im, 233, 232, 212);//第二種雜點顏色
    $color_bg_point_2 = imagecolorallocate($im, 240, 233, 214);//第三種雜點顏色
    $color_bg_point_3 = imagecolorallocate($im, 236, 233, 215);//第四種雜點顏色
    $color_bg_point_4 = imagecolorallocate($im, 232, 233, 214);//第五種雜點顏色
	imagefill($im, 0, 0, $color_bg);

	// 隨機給予兩條虛線，起干擾作用
	$style = array($color_point, $color_point, $color_point, $color_point, $color_point, $color_bg, $color_bg, $color_bg, $color_bg, $color_bg);
	imagesetstyle($im, $style);
    $y1 = rand(0, $img_height);
    $y2 = rand(0, $img_height);
    $y3 = rand(0, $img_height);
    $y4 = rand(0, $img_height);
    $y5 = rand(0, $img_height);
    $y6 = rand(0, $img_height);
    imageline($im, 0, $y1, $width, $y3, IMG_COLOR_STYLED);
    imageline($im, 0, $y2, $width, $y4, IMG_COLOR_STYLED);
    imageline($im, 0, $y5, $width, $y6, IMG_COLOR_STYLED);


	// 在圖形產上黑點，起干擾作用;
	for ($i = 0; $i < $mass; $i++) {
		imagesetpixel($im, rand(0, $img_width), rand(0, $img_height), $color_point);
	}
    //形成第二種顏色的黑點
    for ($i = 0; $i < $mass; $i++) {
        imagesetpixel($im, rand(0, $img_width), rand(0, $img_height), $color_bg_point_1);
    }
    for ($i = 0; $i < $mass; $i++) {
        imagesetpixel($im, rand(0, $img_width), rand(0, $img_height), $color_bg_point_2);
    }
    for ($i = 0; $i < $mass; $i++) {
        imagesetpixel($im, rand(0, $img_width), rand(0, $img_height), $color_bg_point_3);
    }
    for ($i = 0; $i < $mass; $i++) {
        imagesetpixel($im, rand(0, $img_width), rand(0, $img_height), $color_bg_point_4);
    }
	// 將數字隨機顯示在圖形上,文字的位置都按一定波動範圍隨機生成
	$padding = ($img_width-$num_max*10-10)/$num_max;//計算字與字間最大間隔
	$strx = rand(5, $padding);
	for ($i = 0; $i < $num_max; $i++) {
		$strpos = rand($font_size+10, $img_height-10);
		imagettftext($im, $font_size, rand(-30, 30), $strx, $strpos, $color_word, __dir__.'/arial.ttf', substr($num, $i, 1));
		//imagettftext($im, $font_size, rand(-30, 30), $strx, $strpos, $color_word, $font, substr($num, $i, 1));
		$strx += rand($font_size+5, $padding+5);
	}
	imagepng($im);
	imagedestroy($im);
}

// 上傳檔案
function upload_file($post_file, $des_dir, $rename=true){
	
	if(is_uploaded_file($post_file['tmp_name'])){
		if(!is_dir($des_dir)){
			mkdir($des_dir, 0777);
		}
		if(!is_writable($des_dir)){
			return false;
		}
		// 是否要重新命名檔案
		if($rename){
			$ext = explode('.', $post_file['name']); 
			$new_filename = date('YmdHis').rand(0,9).rand(0,9).rand(0,9);//產生新圖檔名
			$new_filename .= '.'.$ext[count($ext)-1];//新圖檔名+副檔名
			move_uploaded_file($post_file['tmp_name'] , $des_dir.$new_filename);
			@chmod($des_dir.$new_filename, 0777);
			return $new_filename;
		} else {
			$new_filename = mb_convert_encoding($post_file['name'], 'big5', 'utf8');
			move_uploaded_file($post_file['tmp_name'] , $des_dir.$new_filename);
			@chmod($des_dir.$new_filename, 0777);
			return $post_file['name'];
		}
		
	} else {
		return false;
	}
}

// 上傳檔案並調整尺寸
function upload_resize_img($post_file, $des_dir, $width, $height, $resize_type){
	
	if(is_uploaded_file($post_file['tmp_name'])){
		if(!is_dir($des_dir)){
			mkdir($des_dir, 0777);
		}
		if(!is_writable($des_dir)){
			return false;
		}
		
		// 上傳檔案
		$ext = explode('.', $post_file['name']); 
		$tmp_filename = $des_dir.date('YmdHis').rand(0,9).rand(0,9).rand(0,9);//產生新圖檔名
		$tmp_filename .= '.'.$ext[count($ext)-1];//新圖檔名+副檔名
		move_uploaded_file($post_file['tmp_name'] , $tmp_filename);
		@chmod($tmp_filename, 0777);
		
		if($resize_type=='f'){
			// 將圖檔另存成指定的大小
			$new_filename = resize_img_fix($tmp_filename, $des_dir, $width, $height);
		} else if($resize_type=='r'){
			// 將圖檔裁成指定比例
			$new_filename = resize_img_ratio($tmp_filename, $des_dir, $width, $height);
		}
		unlink($tmp_filename);
		
		return $new_filename;
	} else {
		return false;
	}
}

// 將圖檔另存成指定的大小，回傳檔名
function resize_img_fix($filename, $des_dir, $width, $height){
	$ext = explode('.', $filename);
	$img_info = getimagesize($filename);
		
	switch($img_info['mime']){
		case 'image/jpeg':
			$src = imagecreatefromjpeg($filename);
			break;
		case 'image/png':
			$src = imagecreatefrompng($filename);
			break;
		case 'image/gif':
			$src = imagecreatefromgif($filename);
			break;
		default:
			return false;
	}
	
	$x = imagesx($src);
	$y = imagesy($src);

	// 將圖存成指定的大小
	$dest = imagecreatetruecolor($width, $height);
	imagecopyresized($dest, $src, 0, 0, 0, 0, $width, $height, $x, $y);
	
	$new_filename = 'Rf'.date('YmdHis').rand(0,9).rand(0,9).rand(0,9);//產生新圖檔名
	$new_filename .= '.'.$ext[count($ext)-1];//新圖檔名+副檔名
	
	
	switch($img_info['mime']){
		case 'image/jpeg':
			imagejpeg($dest, $des_dir.$new_filename, 100);
			break;
		case 'image/png':
			imagepng($dest, $des_dir.$new_filename);
			break;
		case 'image/gif':
			imagegif($dest, $des_dir.$new_filename);
			break;
	}
	@chmod($des_dir.$new_filename, 0777);
	
	return $new_filename;
}

// 將圖檔裁成指定比例，回傳檔名
function resize_img_ratio($filename, $des_dir, $width, $height){
	$ext = explode('.', $filename);
	$img_info = getimagesize($filename);
		
	switch($img_info['mime']){
		case 'image/jpeg':
			$src = imagecreatefromjpeg($filename);
			break;
		case 'image/png':
			$src = imagecreatefrompng($filename);
			break;
		case 'image/gif':
			$src = imagecreatefromgif($filename);
			break;
		default:
			return false;
	}
	
	$x = imagesx($src);
	$y = imagesy($src);
	
	if($x/$y==$width/$height){
		// 原圖比例和裁切比例相同
		$nx = $x;
		$ny = $y;
		$tmp_dest = imagecreatetruecolor($x, $y);
		imagecopyresized($tmp_dest, $src, 0, 0, 0, 0, $x, $y, $x, $y);
	}
	if($x/$y<$width/$height){
		// 原圖寬不變，裁掉高
		$nx =$x;
		$ny = $x*$height/$width;
		$tmp_dest = imagecreatetruecolor($nx, $ny);
		imagecopy($tmp_dest, $src, 0, 0, 0, ($y-$ny)/2, $nx, $ny);
	}
	if($x/$y>$width/$height){
		// 原圖高不變，裁掉寬
		$nx = $y*$width/$height;
		$ny = $y;
		$tmp_dest = imagecreatetruecolor($nx, $ny);
		imagecopy($tmp_dest, $src, 0, 0, ($x-$nx)/2, 0, $nx, $ny);
	}
	
	// 將圖存成指定的大小
	$dest = imagecreatetruecolor($width, $height);
	imagecopyresized($dest, $tmp_dest, 0, 0, 0, 0, $width, $height, $nx, $ny);
	
	$new_filename = 'Rr'.date('YmdHis').rand(0,9).rand(0,9).rand(0,9);//產生新圖檔名
	$new_filename .= '.'.$ext[count($ext)-1];//新圖檔名+副檔名
	
	
	switch($img_info['mime']){
		case 'image/jpeg':
			imagejpeg($dest, $des_dir.$new_filename, 100);
			break;
		case 'image/png':
			imagepng($dest, $des_dir.$new_filename);
			break;
		case 'image/gif':
			imagegif($dest, $des_dir.$new_filename);
			break;
	}
	@chmod($des_dir.$new_filename, 0777);
	
	return $new_filename;
}

// 刪除資料夾
function remove_dir($dir_path){
	if(substr($dir_path, strlen($dir_path)-1, 1)!='/') $dir_path .= '/';
	
	if(is_dir($dir_path)) {
		$files = glob($dir_path . '*', GLOB_MARK);
		foreach ($files as $file) unlink($file);
		
		rmdir($dir_path);
	}
}

// 讀取mail html
function read_mail_html($fname, $arr_v){
	global $_env;
	try{
		$file = $_env['site_path'].'include/template/'.$fname.'.html';
		$html = file_get_contents($file);
		foreach($arr_v as $key=>$val) $html = str_replace('{@'.$key.'}', $val, $html);
		return $html;
	} catch(exception $e){
		return '';
	}
}

// 發送mail
function send_mail($mail_data){
	/* $mail_data = array(
		"subject"=>"主旨",
		"body"=>"內容",
		"receive"=>array(
						array("address"=>"收件信箱", "name"=>"收件人姓名"),
					),
	); */
	try{
		global $db;
		include_once(__DIR__.'/PHPMailer/class.phpmailer.php');
		
		// 從資料庫取得發信設定
		$sql = 'SELECT `site_title`, `mail_auth`, `mail_secure`, `mail_host`, `mail_port`, `mail_account`, `mail_password`, `mail_receive`, `mail_sendaddress`, `mail_sendname` FROM `sys_config`';
		$mail_setting = $db->doselect_first($sql);
		
		//使用PHPMailer
		$mail= new PHPMailer();
		
		$mail->IsSMTP();
		$mail->CharSet = 'UTF-8';
		$mail->SMTPSecure = $mail_setting['mail_secure'];
		$mail->Host = $mail_setting['mail_host'];
		$mail->Port = $mail_setting['mail_port'];
		
		if($mail_setting['mail_auth']=='1'){
			$mail->SMTPAuth = true;
			$mail->Username = $mail_setting['mail_account'];
			$mail->Password = $mail_setting['mail_password'];
		}
		$mail->From = $mail_setting['mail_sendaddress'];
		
		$mail->FromName = '=?UTF-8?B?'.base64_encode($mail_setting['mail_sendname']).'?=';
		$mail->Subject = '=?UTF-8?B?'.base64_encode($mail_setting['site_title'].'-'.$mail_data['subject']).'?=';		//設定郵件標題
		$mail->Body = $mail_data['body'];
		$mail->IsHTML(true);

		// 加入收件人
		if(count($mail_data['receive'])>0){
			foreach($mail_data['receive'] as $row){
				if(chk_is_mail($row['address'])) $mail->AddAddress($row['address'], $row['name']);
			}
		}
		
		if(count($mail_data['receive'])>0||$mail_data['send_mis']==true){
			$arr_receives = explode('||', $mail_setting['mail_receive']);
			foreach($arr_receives as $row){
				if(chk_is_mail($row)) $mail->AddAddress($row, '網站管理員');
			}
		}
		
		$mail->Send();

		if(!empty($mail->ErrorInfo)) throw new exception($mail->ErrorInfo);
		
	} catch(exception $e){
		return $e->getMessage();
	}
	
	return true;
}

// 匯出excel
function export_excel($filename, $ext, $setting, $data){

	include(__DIR__.'/Classes/PHPExcel.php');

	$objPHPExcel = new PHPExcel();

	$objPHPExcel->setActiveSheetIndex(0);

	$data_count = count($data);
	foreach ($setting as $k => $v) {
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($k.'1', $v['title']);
		for ($i=0;$i<$data_count;$i++) {
			if($v['field']!='')
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($k.($i+2), $data[$i][$v['field']]);
			else
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($k.($i+2), $v['value']);
		}
	}
	
	$objPHPExcel->getActiveSheet()->setTitle('工作表1');
	$objPHPExcel->setActiveSheetIndex(0);

	switch($ext){
		default:
		case 'xls':
			$header = 'Content-Type: application/vnd.ms-excel';
			$writer = 'Excel5';
			break;
		case 'xlsx':
			$header = 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
			$writer = 'Excel2007';
			break;

	}
	header($header);
	header('Content-Disposition: attachment;filename="'.$filename.'.'.$ext.'"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $writer);
	$objWriter->save('php://output');
}

?>