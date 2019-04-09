<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {
	public function getTableRowDataOrder($table,$where,$column=null,$order=null)
	{
		if(@$column !='' && @$order !='')
		{
			$this->db->order_by($column,$order);
		}
		$this->db->select("*")->from($table)->where($where);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getTableRowDataOrderByLimit($table,$where,$column=null,$order=null,$start=null,$end=null)
	{
		if(@$column !='' && @$order !='')
		{
			$this->db->order_by($column,$order);
		}
		$this->db->select("*")->from($table)->where($where);
		$this->db->limit($end, $start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	public function getAllMainInfo($table,$orderby=null)
	{
		if($orderby !='')
		{
			$this->db->order_by($orderby,"ASC");
		}
		$query = $this->db->select("*")->from($table)->where(array("status" => 1))->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return array();
		}
	}
	public function storeItems($table,$params)
	{
		$query = $this->db->insert($table,$params);
		//echo $this->db->last_query();
		if($query)
		{
			return $this->db->insert_id();
		}
		else{
			return 0;
		}
	}
	public function getMainInfobyType($table,$coloumn,$type)
	{
		$this->db->where(array($coloumn => $type));
		$query = $this->db->select("*")->from($table)->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return array();
		}
	}
	public function updateItems($table,$params,$where)
	{
		$query=$this->db->update($table,$params,$where);
		if($query)
		{
			return 1;
		}
		else{
			return 0;
		}
	}
	public function getInfo($table)
	{
		$query = $this->db->select("*")->from($table)->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else{
			return array();
		}
	}
	public function getArtTotalRecords($journalsId,$keywords=null,$volumeId=null,$start=null,$end=null)
	{
		$this->db->select("*")->from("55web_z_articles")->where(array("status"=>1,"journalId"=>$journalsId))->order_by("id","DESC");		
		if(@$keywords !='' && @$keywords !="0")
		{
			$this->db->group_start();
			$this->db->or_like("artTitle",@$keywords);
			$this->db->or_like("artshortTitle",@$keywords);
			$this->db->or_like("bmc",@$keywords);
			$this->db->or_like("copyRights",@$keywords);
			$this->db->or_like("doi",@$keywords);
			$this->db->group_end();
		}
		if(@$volumeId !='' && @$volumeId !="0")
		{
			$this->db->where(array("volume_id" => @$volumeId));
		}
		if(@$start !='' && @$end !='')
		{
			$this->db->limit($end, $start);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function updateCnt($articleId)
	{
		$table = '55web_z_articles';
		$this->db->select("*")->from($table)->where(array('id'=>$articleId));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result =  $query->result();
			$cnt = @$result[0]->viewsCnt+1;
			$params = array(
			'viewsCnt'=>$cnt,
			);
			$update = $this->db->update($table,$params,array("id" => $articleId));
			//echo $this->db->last_query();
			if($update){
				return 1;
			}else{
				return 0;
			}
		}
	}
}