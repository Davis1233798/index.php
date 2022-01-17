<!DOCTYPE html>
<head>
	<?php include('layout/common.php');?> 
</head>

<body>
<?php include('layout/menu.php');?> 
<img src="images/top/cbanner.png" class="img-responsive">

<div class="wrapper">
<div class="container inner">

    <?
        $id = get_get('id', '0');
        $para = array(
            'id'=>$id
        );

        // 取得健檢細目pdf
        $sql = 'SELECT class_id, name, show_flow, pdfname FROM health_package WHERE id = :id AND inuse = 1';
        $data = $db->doselect_first($sql, $para);
        if(!$data||$data['show_flow']!='1'){
            echo '<script>location.replace("c01.php?class=', $data['class_id'], '")</script>';
            return;
        }

        // 取得流程項目
        $sql = 'SELECT f_id, inuse FROM health_package_with_flow WHERE p_id = :id ORDER BY f_id';
        $data_flow = $db->doselect($sql, $para);
        $settings = array();
        foreach($data_flow AS $row){
            $settings[$row['f_id']] = $row['inuse'];
        }

        $lv3_1 = array();
        $lv3_2 = array();
        if($settings['2']=='1'){
            if($settings['5']=='1') array_push($lv3_1, '超音波');
            if($settings['6']=='1') array_push($lv3_1, '胸腹部X光');
            if($settings['24']=='1') array_push($lv3_1, '胸部X光');
            if($settings['8']=='1') array_push($lv3_2, '血液');
            if($settings['9']=='1') array_push($lv3_2, '尿液');
            if($settings['10']=='1') array_push($lv3_2, '糞便');
        }
    ?>
    <div class="home-title"><? echo $data['name']; ?>健檢流程<span class="border"></span></div>

    <ul class="c02-list">
        <? if($settings['1']=='1'){ ?>
            <li>
                <div class="circle circlebg">報到</div>
            </li>
            <li class="c02-bg-1">
                <p class="style-1"><span class="t-green">確認身份</span>確認受檢者身份及檢查組套是否相符</p>
                <p class="style-1"><span class="t-green">資料確認</span>確認受檢者資料填寫之完整性</p>
            </li>
        <?
            }
            
            if($settings['2']=='1'){
                $i = 0;
        ?>
                <li>
                    <div class="circle circlebg">檢查</div>
                </li>
                <li>
                    <ul class="c03-list">
                        <?
                            if($settings['3']=='1'){
                                $i++;
                        ?>
                            <li><img src="images/03/v01.png" class="img-responsive"></li>
                            <li><p class="style-2">一般檢查</p></li>
                        <?
                            }
                            if($settings['4']=='1'){
                                $i++;
                        ?>
                                <li><img src="images/03/v02.png" class="img-responsive"></li>
                                <li><p class="style-2">影像檢查<? echo count($lv3_1)>0?'<br>('.implode('、', $lv3_1).')':''; ?></p></li>
                        <?
                            }
                            if($settings['7']=='1'){
                                $i++;
                        ?>
                                <li><img src="images/03/v03.png" class="img-responsive"></li>
                                <li><p class="style-2">檢體採檢<? echo count($lv3_2)>0?'<br>('.implode('、', $lv3_2).')':''; ?></p></li>
                        <?
                            }
                            if($settings['12']=='1'){
                                $i++;
                        ?>
                                <li><img src="images/03/v04.png" class="img-responsive"></li>
                                <li><p class="style-2">內視鏡檢查</p></li>
                        <?
                            }
                            if($settings['13']=='1'){
                                $i++;
                        ?>
                                <li><img src="images/03/v05.png" class="img-responsive"></li>
                                <li><p class="style-2">內科理學檢查</p></li>
                        <?
                            }
                            if($settings['11']=='1'){
                                $i++;
                        ?>
                                <li><img src="images/03/v10.png" class="img-responsive"></li>
                                <li><p class="style-2">心電圖</p></li>
                        <?
                            }
                            if($i%2!=0){
                                // 若項目為奇數，補空li避免跑版
                                echo '<li></li><li></li>';
                            }
                        ?>
                    </ul>
                </li>
        <?
            }
            
            if($settings['14']=='1'){
                $i = 0;
        ?>
                <li>
                    <div class="circle circlebg">會診</div>
                </li>
                <li>
                    <ul class="c03-list">
                            <?
                                if($settings['15']=='1'){
                                    $i++;
                            ?>
                                    <li><img src="images/03/v06.png" class="img-responsive"></li>
                                    <li><p class="style-2">眼、耳鼻喉牙醫師會診</p></li>
                            <?
                                }
                                if($settings['16']=='1'){
                                    $i++;
                            ?>
                                    <li><img src="images/03/v07.png" class="img-responsive"></li>
                                    <li><p class="style-2">婦產科會診</p></li>
                            <?
                                }
                                if($settings['17']=='1'){
                                    $i++;
                            ?>
                                    <li><img src="images/03/v08.png" class="img-responsive"></li>
                                    <li><p class="style-2">肺功能檢查</p></li>
                            <?
                                }
                                if($settings['18']=='1'){
                                    $i++;
                            ?>
                                    <li><img src="images/03/v09.png" class="img-responsive"></li>
                                    <li><p class="style-2">諮詢解說</p></li>
                            <?
                                }
                                if($i%2!=0){
                                    // 若項目為奇數，補空li避免跑版
                                    echo '<li></li><li></li>';
                                }
                            ?>
                    </ul>
                </li>
        <?
            }
            
            if($settings['19']=='1'){
        ?>
                <li>
                    <div class="circle circlebg">高階影像<br>檢查</div>
                </li>
                <li class="c02-bg-3">
                    <? if($settings['20']=='1'){ ?>
                        <p class="style-1">多切面電腦斷層心臟血管檢查</p>
                    <? } ?>
                    <? if($settings['21']=='1'){ ?>
                        <p class="style-1">低劑量電腦斷層肺部結節檢查</p>
                    <? } ?>
                    <? if($settings['22']=='1'){ ?>
                        <p class="style-1">(自費加選)核磁共振影像檢查(全身、腦血管、乳房、心臟...)</p>
                    <? } ?>
                    <? if($settings['25']=='1'){ ?>
                        <p class="style-1">(自費加選)多切面電腦斷層心臟血管檢查</p>
                    <? } ?>
                    <? if($settings['26']=='1'){ ?>
                        <p class="style-1">(自費加選)低劑量電腦斷層肺部結節檢查</p>
                    <? } ?>
                </li>
        <?
            }
            
            if($settings['23']=='1'){
        ?>
                <li>
                    <div class="circle circlebg">報告</div>
                </li>
                <li class="c02-bg-2">
                    <p class="style-1"><span class="t-green">報告</span>14個工作日之內寄出報告</p>
                    <p class="style-1"><span class="t-green">補檢</span>補檢完成後14個工作日之內寄出報告</p>
                    <p class="style-1"><span class="t-green">通知</span>懷疑重大疾病將主動以電話或簡訊方式告知本人及協助轉診</p>
                </li>
        <?
            }
        ?>
    </ul>
    
    <?
        $file_path = 'health_package/'.$data['pdfname'];
        if($data['pdfname']!=''&&file_exists($_env['site_upload_path'].$file_path))
            echo '<div class="btn-1"><a href="', $_env['site_upload_url'], $file_path, '" target="_blank">檢查細項表下載</a></div>';
    ?>
    
    <div class="clearfix"></div>

</div>
</div>


<?php include('layout/footer.php');?> 
</body>
</html>
