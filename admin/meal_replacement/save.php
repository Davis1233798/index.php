<?
$_baseenv["page_type"] = "page";
include_once(__DIR__."/local_parameter.php");
include_once(dirname(dirname(__DIR__))."/include/adminclass.php");
include_once($_env["site_admin_path"]."layout/header.php");
include_once($_env["site_admin_path"]."layout/footer.php");

try{

    $fn = get_get("fn");
    switch($fn){
        default:
            throw new exception("功能不存在");
            break;
        case "add":
            $para = array(
                "sort"=>get_post("txt_sort"),
                "category_id"=>get_post("sel_category_id"),
                "question"=>strip_tags($_POST["txt_question"]),
                "answer"=>strip_tags($_POST["txt_answer"]),
                "inuse"=>get_post("rd_inuse", 0)
            );

            if($para["question"]=='') throw new exception("請輸入問題內容");
            if($para["answer"]=='') throw new exception("請輸入問題解答");

            $lastid = $db->doinsert("faq", $para);//寫入資料表，取得id

            $msg = "資料已新增";

            break;
        case "edit":
            $para = array(
                "id"=>get_post("hdf_id", 0),
                "sort"=>get_post("txt_sort"),
                "category_id"=>get_post("sel_category_id"),
                "question"=>strip_tags($_POST["txt_question"]),
                "answer"=>strip_tags($_POST["txt_answer"]),
                "inuse"=>get_post("rd_inuse", 0)
            );

            if($para["question"]=='') throw new exception("請輸入問題內容");
            if($para["answer"]=='') throw new exception("請輸入問題解答");

            $msg = "資料已修改";

            $db->doupdate("faq", "where id = :id", $para, array("id"));

            break;
    }

} catch (exception $e){
    echo '<script>sys_back_message("'.$e->getMessage().'");</script>';
    return;
}

echo '<script>sys_show_message("'.$msg.'", "index.php", true);</script>';

?>