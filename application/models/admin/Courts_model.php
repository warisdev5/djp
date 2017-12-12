<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courts_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function save_judge($data)
    {
    	//set value by name
    	$this->db->set('judge_name', $data['judge_name']);
    	$this->db->set('desgn_id', $data['desgn_id']);
    	$this->db->set('date_of_birth', $data['date_of_birth']);
    	$this->db->set('date_of_joining', $data['date_of_joining']);
    	$this->db->set('date_of_retirement', $data['date_of_retirement']);
    	$this->db->set('domicile_id', $data['domicile_id']);
    	$this->db->set('gender', $data['gender']);
    	$this->db->set('seniority', $data['seniority']);
    
    	if ($data['judge_id'] == 0 )
    	{
    		$status = $this->db->insert('judges');
    	}
    	else
    	{
    		$this->db->where('judge_id',$data['judge_id']);
    		$status = $this->db->update('judges');
    	}
    
    	$status = $this->db->affected_rows();
    	return $status;
    }
    
    function getJudgeForEdit($id)
    {
    	$this->db->select('*');
    	$this->db->from('judges');
    	$this->db->where('judge_id', $id);
    	$query = $this->db->get();
    	$result = $query->row();
    	return $result;
    }
    
    function getJudges()
    {
    	$this->db->select('a.judge_id, a.judge_name, a.date_of_birth, a.date_of_joining, a.date_of_retirement, a.gender, a.seniority, d.desgn_name as designation, c.city_name as domicile');
    	$this->db->from('judges as a');
    	$this->db->join('designation as d', 'd.desgn_id = a.desgn_id', 'left');
    	$this->db->join('districts as c', 'c.id = a.domicile_id', 'left');
    	$this->db->order_by('a.desgn_id asc, a.seniority asc');
    	$query = $this->db->get();
    	$result = $query->result();
    	return $result;
    }
	
	public function check_unique_designation($id)
	{
		$this->db->select('desgn_name');
		$this->db->where('desgn_id !=', $id);
		$this->db->from('designation');
		$query = $this->db->get();
		$result = $query->result();

		$names =  array();
		foreach ($result as $r){
			$names[$r->desgn_name] = $r;
		}
		return $names;
	}
	
	public function save_designation($data)
	{
		//set value by name
		$this->db->set('desgn_name', $data['desgn_name']);
		$this->db->set('desgn_short_name', $data['desgn_short_name']);
		$this->db->set('active', $data['active']);
		$this->db->set('sorting', $data['sorting']);
		
		if ($data['desgn_id'] == 0 )
		{
			$status = $this->db->insert('designation');
		}
		else
		{
			$this->db->where('desgn_id',$data['desgn_id']);
			$status = $this->db->update('designation');
		}
		
		$status = $this->db->affected_rows();
		return $status;
	}
	
	function getDesignationForEdit($id)
	{
		$this->db->select('*');
		$this->db->from('designation');
		$this->db->where('desgn_id', $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	function getDesignations()
	{
		$this->db->select('*');
		$this->db->from('designation');
		$this->db->order_by('sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	/* public function get_dropdown_cats_list()
	{
		$this->db->select('id, cat_name');
		$this->db->from('categories');
		$this->db->where('cat_id', 0);
		$this->db->order_by('case_type_id asc, sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	} */
	
	/* function getCategoryForEdit($id)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	} */
	
	/* function getCategoryForParentId($id)
	{
		$this->db->select('a.id, a.cat_name, a.cat_id, b.case_type as cat_type');
		$this->db->from('categories as a');
		$this->db->join('type_of_cases as b', 'a.case_type_id = b.case_type_id', 'left');
		$this->db->where('cat_id', $id);
		$this->db->order_by('cat_type desc, sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result; 

// 		$categories = array();
		
// 		$query = $this->db->query("SELECT * FROM categories WHERE cat_id='".$parent_id."' ORDER BY cat_name asc;");
		
// 		foreach ($query->result() as $row)
// 		{
// 			$category = array();
			
// 			$category['id'] = $row->id . '<br>';
// 			$category['name'] = $row->cat_name . '<br>';
// 			$category['parent_id'] = $row->cat_id .'<br>';
// 			$category['sub_categories'] = $this->getCategoryForParentId($category['id']);
// 			$categories[$row->id]=  $category;
// 		}
		
// 		return $categories;
	} */
	
	
}
