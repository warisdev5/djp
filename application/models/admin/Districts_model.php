<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Districts_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

	public function get_dropdown_city_list()
	{
		$this->db->select('id, city_name');
		$this->db->from('districts');
		$this->db->where('city_id', 0);
		$this->db->order_by('sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function check_unique_city($id)
	{
		$this->db->select('city_name');
		$this->db->where('id !=', $id);
		$this->db->from('districts');
		$query = $this->db->get();
		$result = $query->result();

		$names =  array();
		foreach ($result as $r){
			$names[$r->city_name] = $r;
		}
		return $names;
	}
	
	public function save($data)
	{
		//set value by name
		$this->db->set('city_name', $data['city_name']);
		$this->db->set('city_id', $data['city_id']);
		$this->db->set('active', $data['active']);
		$this->db->set('sorting', $data['sorting']);
		
		if ($data['id'] == 0 )
		{
			$status = $this->db->insert('districts');
		}
		else
		{
			$this->db->where('id',$data['id']);
			$status = $this->db->update('districts');
		}
		
		$status = $this->db->affected_rows();
		return $status;
	}
	
	function getCityForEdit($id)
	{
		$this->db->select('*');
		$this->db->from('districts');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	function getCityForParentId($id)
	{
		$this->db->select('id, city_name, city_id');
		$this->db->from('districts');
		$this->db->where('city_id', $id);
		$this->db->order_by('sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}
