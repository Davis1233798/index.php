<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
</head>

<body class="grey">
<?php include('layout/menu.php');?> 
<img src="images/top/enbanner.png" class="img-responsive">

<div class="wrapper">
<div class="container">

    <div class="home-title">其他自費加選項目<span class="border"></span></div>
    <p class="check-style-2">加選項目</p>
    <?
        // 取得類別列表
        $sql = 'SELECT id, name FROM self_pay_item_class ORDER BY sort, id';
        $data_class = $db->doselect($sql);
        foreach($data_class as $row_class){
            $sql = 'SELECT name, price FROM self_pay_item WHERE class_id = :class_id AND inuse = 1 ORDER BY sort, id';
            $data = $db->doselect($sql, array('class_id'=>$row_class['id']));
    ?>
        <div class="table-responsive">
            <ul class="reserve-1">
                <li>
                    <p class="r-15">No.</p>
                    <p class="r-70"><? echo $row_class['name']; ?></p>
                    <p class="r-15">費用</p>
                </li>
            </ul>
            <ul class="reserve-2">
                <?
                    $max = count($data);
                    for($i=0;$i<$max;$i++){
                ?>
                    <li>
                        <p class="r-15"><? echo $i+1; ?></p>
                        <p class="r-70"><? echo $data[$i]['name']; ?></p>
                        <p class="r-15"><? echo $data[$i]['price']; ?></p>
                    </li>
                <? }?>
            </ul>
        </div>
    <? } ?>
    
    <br><br>

</div>
</div>


<?php include('layout/footer.php');?>
</body>
</html>
