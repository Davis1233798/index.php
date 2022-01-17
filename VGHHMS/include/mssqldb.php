<?php

class myMSSQLPDO {

    public $obj_pdo;
    protected $obj_query;
    
    protected $pagesize;
    protected $pagersize;

    /**
     * 
     */
    function __construct(){
        global $_env;
        $this->obj_pdo = new PDO('sqlsrv:Server='.$_env['mssqldb_host'].', '.$_env['mssqldb_port'].';Database='.$_env['mssqldb_name'], $_env['mssqldb_user'], $_env['mssqldb_pass']);
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

        $data = $this->obj_query->fetchall();
        $this->obj_query = null;
        
        return $data;
    }
    
    /**
     * 取得第一筆資料
     */
    function doselect_first($sql, $para=array()){
        $this->doexe($sql, $para);

        $result = $this->obj_query->fetchall();
        $data = count($result)>0?$result[0]:array();
        $this->obj_query = null;
        
        return $data;
    }
    
    /**
     * 新增資料
     */
    function doinsert($tbname, $para){
        
        $sql_col = '';
        $sql_val = '';
        foreach ($para as $k=>$v) {
            $sql_col .= $k.',';
            $sql_val .= ':'.$k.',';
        }

        $sql = 'INSERT INTO '.$tbname.' ('.substr($sql_col, 0, -1).') VALUES ('.substr($sql_val, 0, -1).')';

        $this->doexe($sql, $para);

		$newid = $this->obj_pdo->lastInsertId();
		$this->obj_query = null;
		
		return $newid;
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

global $mssqldb;
$mssqldb = new myMSSQLPDO();

?>