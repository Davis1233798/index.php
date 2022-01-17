<?
include('include/baseclass.php');

try{
    $id = get_post('id');
    $sql = 'SELECT * FROM team WHERE inuse = 1 AND id = :id ';
    $data = $db->doselect_first($sql, array("id"=>$id));
    $file = $_env["site_upload_url"].'team/'.$data['filename'];
    if(!empty($data['filename'])/*file_exists($file)&&is_file($file)*/){
      $img = $file;
    }else{
      if($data['gender']==1){
        $img = 'images/02/d00.jpg';
      }else{
        $img = 'images/02/d0.jpg';
      }
    }
    $html = '<div class="block_detail">
             <img src="'.$img.'" class="img-responsive">
             <p class="doctor">'.$data["en_name"].'<span>'.$data["en_division"].'</span></p>
             <ul class="block-en">';
    if(!empty($data['en_edu'])){
      $html .= '<li>Education：</li>
              <li>
               <p>'.nl2br($data['en_edu']).'</p>
              </li>';
    }
    if(!empty($data['en_exp'])){
      $html .= '<li>Professional experience：</li>
              <li>
               <p>'.nl2br($data['en_exp']).'</p>
              </li>';
    }
    if(!empty($data['en_spec'])){
      $html .= '<li>Specialty：</li>
              <li>
               <p>'.nl2br($data['en_spec']).'</p>
              </li>';
    }
    if(!empty($data['en_job'])){
      $html .= '<li>Current job：</li>
              <li>
               <p>'.nl2br($data['en_job']).'</p>
              </li>';
    }
    if(!empty($data['en_license'])){
      $html .= '<li>Medical licenses：</li>
              <li>
               <p>'.nl2br($data['en_license']).'</p>
              </li>';
    }
    $html .= '</ul>
            </div>';

    $result = array(
      'ok'=>'t',
      'html'=>$html
    );
} catch (exception $e){
  $result = array(
    "ok"=>"e",
    "msg"=>$e->getMessage()
  );
}

header('Content-Type: application/json');
echo json_encode($result);

?>