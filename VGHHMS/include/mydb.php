<?php

class myPDO {

    public $obj_pdo;
    protected $obj_query;
    
    protected $pagesize;
    protected $pagersize;

    /**
     * 
     */
    function __construct(){
        global $_env;
        $this->obj_pdo = new PDO('mysql:host='.$_env['db_host'].';port='.$_env['db_port'].';dbname='.$_env['db_name'], $_env['db_user'], $_env['db_pass']);
        $this->obj_pdo->exec('set names utf8');
        
        $this->pagesize = $_env['setting_pagesize'];
        $this->pagersize = $_env['setting_pagersize'];
    }
    
    /**
     * 執行sql
     */
    function doexe($sql, $para=array()){
        $this->obj_query = $this->obj_pdo->prepare($sql);
        $this->bind_para($para);
        $this->obj_query->execute();
        
        return $this->obj_query;
    }
    
    /**
     * 取得所有資料
     */
    function doselect($sql, $para=array()){
        $this->doexe($sql, $para);

        $data = array();
        if($this->obj_query->rowCount()>0) $data = $this->obj_query->fetchall();
        $this->obj_query = null;
        
        return $data;
    }
    
    /**
     * 取得第一筆資料
     */
    function doselect_first($sql, $para=array()){
        $this->doexe($sql, $para);

        $data = array();
        if($this->obj_query->rowCount()>0) $data = $this->obj_query->fetch();
        $this->obj_query = null;
        
        return $data;
    }
    
    /**
     * 取得第一筆帶索引的資料
     */
    function doselect_first_with_sn($sql, $para=array(), $order=array()){
        
        $do_sql = 'SELECT tb2.* FROM (
                    SELECT @a:=@a+1 mydb_sn, tb.* FROM (';
        $do_sql .= $sql;
        
        if(count($order)>0){
            $do_sql .= ' ORDER BY ';
            foreach ($order as $k => $v) {
                $do_sql .= $k. ' '.(strtolower($v)=='d'?'desc':'asc').',';
            }
            $do_sql = substr($do_sql, 0, -1).' ';
        }

        $do_sql .= ') tb, (SELECT @a:= 0) AS a ';
        $do_sql .= ') tb2 WHERE 1 = 1 ';
        if(count($para)>0){
            foreach ($para as $k => $v) {
                $do_sql .= 'AND tb2.'.$k.' = :'.$k.' ';
            }
        }

        $this->doexe($do_sql, $para);

        $data = array();
        if($this->obj_query->rowCount()>0) $data = $this->obj_query->fetch();
        $this->obj_query = null;
        
        return $data;
    }
    
    /**
     * 依頁數取得資料
     */
    function doselect_page($sql, $para=array(), $order=array(), $page=0, $pagesize=0){
        if($page<=0||!chk_is_int($page)) $page = 1;
        if($pagesize<=0||!chk_is_int($pagesize)) $pagesize = $this->pagesize;

        $this->doexe($sql, $para);
        $total_rows = $this->obj_query->rowCount();
        $this->obj_query = null;
        
        // 有傳入排序欄位，則加上排序條件
        if(count($order)>0){
            $sql .= ' ORDER BY ';
            foreach ($order as $k => $v) {
                $sql .= $k. ' '.(strtolower($v)=='d'?'desc':'asc').',';
            }
            $sql = substr($sql, 0, -1);
        }

        // 計算頁碼
        $total_pages = ceil($total_rows/$pagesize);
        if($total_pages>0&&$page>$total_pages) $page = $total_pages;

        $sql .= ' limit '.(($page-1)*$pagesize).', '.$pagesize;
        
        $data = array(
            'data'=>$this->doselect($sql, $para),
			'pager'=>array(
				'page'=>$page,
				'pagesize'=>$pagesize,
				'total_pages'=>$total_pages
			)
        );
        
        return $data;
    }

    /**
     * 
     */
    function docheckexist($tbname, $para=array(), $where='') {
		
		$sql = 'SELECT COUNT(*) AS count FROM '.$tbname.' ';
		if($where==''){
			$sql .= 'WHERE 1 = 1 ';
			foreach($para as $k=>$v){
				$sql .= 'AND '.$k.' = :'.$k.' ';
			}
		} else {
			$sql .= $where;
        }
        
        $data = $this->doselect_first($sql, $para);
		if($data['count']>0) return true;
		else return false;
    }
    
    /**
     * 新增資料
     */
    function doinsert($tbname, $para){
        
        $sql_col = '';
        $sql_val = '';
        foreach ($para as $k=>$v) {
            $sql_col .= '`'.$k.'`,';
            $sql_val .= ':'.$k.',';
        }

        $sql = 'INSERT INTO '.$tbname.' ('.substr($sql_col, 0, -1).') VALUES ('.substr($sql_val, 0, -1).')';

        $this->doexe($sql, $para);

		$newid = $this->obj_pdo->lastInsertId();
		$this->obj_query = null;
		
		return $newid;
    }
    
    /**
     * 修改資料
     */
    function doupdate($tbname, $where, $para, $ntup=array()){

        $sql = 'UPDATE `'.$tbname.'` SET ';
		foreach($para as $k=>$v){
			if(!in_array($k, $ntup)) $sql .= $k.' = :'.$k.',';
        }
        $sql = substr($sql, 0, -1).' '.$where.' ';

        $this->doexe($sql, $para);
        $this->obj_query = null;
    }
    
    /**
     * 刪除資料
     */
    function dodelete($tbname, $colname, $para){

        if($colname!=''&&count($para)>0){
            $sql = 'DELETE FROM `'.$tbname.'` WHERE '.$colname.' in (?'.str_repeat(',?', count($para)-1).')';
            $this->obj_query = $this->obj_pdo->prepare($sql);
            $this->obj_query->execute($para);
            $this->obj_query = null;
        }
    }

    /**
     * 修改排序
     */
    function dosort($tbname, $keyname, $sortname, $key, $diff, $groupname='', $groupval=''){
        
        $sql = 'SELECT '.$sortname.' FROM '.$tbname.' WHERE '.$keyname.' = :id';
		$data = $this->doselect_first($sql, array('id'=>$key));
		
		if($data&&$key!='0'){
			$ori_sort = $data[$sortname];
			
			// 更新受影響的其它資料
			if($diff<0){
				// 排序數字變小
				$sql = 'UPDATE '.$tbname.' SET '.$sortname.' = '.$sortname.' + 1 WHERE '.$sortname.' between :min AND :max AND '.$keyname.' <> :id ';
				$para = array(
					'id'=>$key,
					'min'=>$ori_sort+$diff,
					'max'=>$ori_sort,
                );
			} else {
				// 排序數字變大
				$sql = 'UPDATE '.$tbname.' SET '.$sortname.' = '.$sortname.' - 1 WHERE '.$sortname.' between :min AND :max AND '.$keyname.' <> :id ';
				$para = array(
					'id'=>$key,
					'min'=>$ori_sort,
					'max'=>$ori_sort+$diff,
				);
			}
            if($groupname!=''){
                $sql .= 'AND '.$groupname.' = :group';
                $para['group'] = $groupval;
            }
            $this->doexe($sql, $para);
            $this->obj_query = null;
			
			$para = array(
				$keyname=>$key,
				$sortname=>$ori_sort+$diff,
			);
			$this->doupdate($tbname, 'WHERE '.$keyname.' = :id', $para, array($keyname));
		}
    }

    /**
     * 
     */
    function bind_para($para){
        foreach($para as $k=>$v){
            $this->obj_query->bindValue(':'.$k, $v);
        }
    }
}

global $db;
$db = new myPDO();

?>