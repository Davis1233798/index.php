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
             <p class="doctor">'.$data["name"].'<span>'.$data["division"].'</span></p>
             <ul class="block">';
    if(!empty($data['edu'])){
      $html .= '<li>學歷：</li>
              <li>
               <p>'.nl2br($data['edu']).'</p>
              </li>';
    }
    if(!empty($data['exp'])){
      $html .= '<li>經歷：</li>
              <li>
               <p>'.nl2br($data['exp']).'</p>
              </li>';
    }
    if(!empty($data['spec'])){
      $html .= '<li>專長：</li>
              <li>
               <p>'.nl2br($data['spec']).'</p>
              </li>';
    }
    if(!empty($data['job'])){
      $html .= '<li>現職：</li>
              <li>
               <p>'.nl2br($data['job']).'</p>
              </li>';
    }
    if(!empty($data['license'])){
      $html .= '<li>證照：</li>
              <li>
               <p>'.nl2br($data['license']).'</p>
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