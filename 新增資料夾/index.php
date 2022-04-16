              <option value="0.5">0.5</option>
              <option value="1">1</option>
              <option value="1.5">1.5</option>
              <option value="2">2</option>
              <option value="2.5">2.5</option>
              <option value="3">3</option>
              <option value="3.5">3.5</option>
              <option value="4">4</option>
              <option value="4.5">4.5</option>
              <option value="5">5</option>
              <option value="5.5">5.5</option>
              


            <li>內分泌系統</li>
            <ul>
                <? foreach($_env['endocrine_self'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_endocrine_self_<? echo $k; ?>" name="cb_endocrine_self" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey']['endocrine_self']==''&&$k=='11')||$_SESSION[$_env['site_code'].'_survey']['endocrine_self']=='11')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li>血液系統</li>
            <ul>
                <? foreach($_env['blood_self'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_blood_self_<? echo $k; ?>" name="cb_blood_self" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey']['blood_self']==''&&$k=='11')||$_SESSION[$_env['site_code'].'_survey']['blood_self']=='11')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li>呼吸系統</li>
            <ul>
                <? foreach($_env['breathe_self'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_breathe_self_<? echo $k; ?>" name="cb_breathe_self" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey']['breathe_self']==''&&$k=='11')||$_SESSION[$_env['site_code'].'_survey']['breathe_self']=='11')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>
            <li>其他</li>
            <ul>
                <? foreach($_env['other_self'] as $k=>$v){ ?>
                    <label><input type="checkbox" id="cb_other_self_<? echo $k; ?>" name="cb_other_self" value="<? echo $k ?>" <? echo (($_SESSION[$_env['site_code'].'_survey']['other_self']==''&&$k=='11')||$_SESSION[$_env['site_code'].'_survey']['other_self']=='11')?'checked':''; ?> /><? echo $v ?></label>
                <? } ?>
            </ul>

            <input style="color: #1e7e34; width: 156px; height: 28px;font-size: 80%;" type="text" placeholder="其他" id="txt_id_other_self_name" value="<? echo ($_SESSION[$_env['site_code'].'_survey']['blood_past']=='3'&&$_SESSION[$_env['site_code'].'_survey']['id_other_self_name']!='')?$_SESSION[$_env['site_code'].'_survey']['id_other_self_name']:''; ?>" <? echo $_SESSION[$_env['site_code'].'_survey']['other_self']=='3'?'':'disabled'; ?>>