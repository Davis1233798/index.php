$endocrine_past = get_post("endocrine_past",0);
$blood_past = get_post("blood_past",0);
$liver_past = get_post("liver_past",0);
$other_past = get_post("other_past",0);
$endocrine_past = get_post("endocrine_past",0);
$endocrine_past = get_post("endocrine_past",0);
$endocrine_past = get_post("endocrine_past",0);
$endocrine_past = get_post("endocrine_past",0);


<li style="height:40px;font-size: 25px;font-weight:bold;color: #00CC00;">



            <ul>
                <? foreach($_env['wine'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_other_past_<? echo $k; ?>" name="cb_other_past" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey']['other_past']==''&&$k=='11')||$_SESSION[$_env['site_code'].'_survey']['other_past']=='11')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>