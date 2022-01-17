<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
</head>

<body class="grey">
<?php include('layout/menu.php');?> 
<img src="images/top/cbanner.png" class="img-responsive">

<div class="wrapper">
<div class="container inner">
    <div id='div_title' class="title">健檢項目/價格</div>

    <?
        $class = get_get('class', '1');
        if(!in_array($class, array('1', '2', '3', '4', '5', '6'))) $class = '1';

        // 取得類別列表
        $sql = 'SELECT id, name, type, show_pdf, pdfname FROM health_package_class ORDER BY sort, id';
        $data_class = $db->doselect($sql);

        // 取得此類別套組
        $sql = 'SELECT id, name, workday, price, show_flow FROM health_package WHERE class_id = :class_id AND inuse = 1 ORDER BY sort, id';
        $data_package = $db->doselect($sql, array('class_id'=>$class));

        $class_settings = array(
          'name'=>'',
          'type'=>1,
          'show_pdf'=>0,
          'pdfname'=>'',
        );
    ?>
    <div class="c01-left">
        <p class="c0l-title">健檢組套</p>
        <ul class="c01-menu">
            <?
                foreach($data_class AS $row){
                    if($row['id']==$class){
                        $class_settings = array(
                            'name'=>$row['name'],
                            'type'=>$row['type'],
                            'show_pdf'=>$row['show_pdf'],
                            'pdfname'=>$row['pdfname'],
                        );
                    }
                    echo '<li><a href="c01.php?class=', $row['id'], '#div_title">', $row['name'], '</a></li>';
                }
            ?>
        </ul>
    </div>

    <select class="c01-select" onchange="go_class(this)">
        <?
            foreach($data_class AS $row){
                echo '<option value="', $row['id'], '"', ($row['id']==$class?' selected':''),'>', $row['name'], '</option>';
            }
        ?>
    </select>

    <div class="c01-right">
        <!-- <div class="col-gradient"><p>健檢推薦<a href="c04.php"><img src="images/click.png"></a></p></div> -->
		<div class="col-gradient"><p>健檢推薦<a href="javascript:;" onClick="alert('維護中！！');"><img src="images/click.png"></a></p></div>
        <p class="check-style-2"><? echo $_env['package_type'][$class_settings['type']] ?></p>
        <ul class="reserve-1">
            <li>
                <p class="c-1">No.</p>
                <p class="c-2"><? echo $class_settings['name']; ?></p>
                <p class="c-3">執行日期</p>
                <p class="c-4">費用</p>
                <p class="c-5">&nbsp;</p>
            </li>
        </ul>
        <ul class="reserve-2">
            <?
                $max = count($data_package);
                for($i=0;$i<$max;$i++){
                    $row = $data_package[$i];
                    echo '<li>';
                    echo '<p class="c-1">', ($i+1), '</p>';
                    echo '<p class="c-2">', $row['name'], '</p>';
                    echo '<p class="c-3">', $row['workday'], '</p>';
                    echo '<p class="c-4">', $row['price'], '</p>';
                    echo '<p class="c-5 zoom">', ($row['show_flow']=='1'?'<a href="c03.php?id='.$row['id'].'">more</a>':''), '</p>';
                    echo '</li>';
                }
            ?>
        </ul>
        
        <?
            if($class_settings['show_pdf']=='1'&&$class_settings['pdfname']!=''){
                $file_path = 'health_package_class/'.$class.'/'.$class_settings['pdfname'];
                if(file_exists($_env['site_upload_path'].$file_path))
                    echo '<div class="btn-1"><a href="', $_env['site_upload_url'], $file_path, '" target="_blank">健檢比較</a></div>';
            }
        ?>
    </div>

    <div class="clearfix"></div>
</div>
</div>


<?php include('layout/footer.php');?> 
</body>
</html>
<script>
function go_class(obj){
    location.href = 'c01.php?class='+obj.value+'#div_title';
}
</script>