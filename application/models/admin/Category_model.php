<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

	public function get_dropdown_cats_list()
	{
		$this->db->select('id, cat_name');
		$this->db->from('categories');
		$this->db->where('cat_id', 0);
		$this->db->order_by('case_type_id asc, sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
		
	public function check_unique_category($id)
	{
		$this->db->select('cat_name');
		$this->db->where('id !=', $id);
		$this->db->from('categories');
		$query = $this->db->get();
		$result = $query->result();

		$names =  array();
		foreach ($result as $r){
			$names[$r->cat_name] = $r;
		}
		return $names;
	}
	
	public function save($data)
	{
		//set value by name
		$this->db->set('cat_name', $data['cat_name']);
		$this->db->set('case_type_id', $data['case_type_id']);
		$this->db->set('cat_id', $data['cat_id']);
		$this->db->set('active', $data['active']);
		$this->db->set('sorting', $data['sorting']);
		
		if ($data['id'] == 0 )
		{
			$status = $this->db->insert('categories');
		}
		else
		{
			$this->db->where('id',$data['id']);
			$status = $this->db->update('categories');
		}
		
		$status = $this->db->affected_rows();
		return $status;
	}
	
	function getCategoryForEdit($id)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	function getCategoryForParentId($id)
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
	}
	
	
}
