<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Districts extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->dbutil();
//         $this->load->model('admin/districts_model');

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_districts'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_districts'), 'admin/districts');
    }

	public function index()
	{
		// load js files in array
		$this->data['js_files'] = array('/datatables.net/js/jquery.dataTables.min.js', '/datatables.net-bs/js/dataTables.bootstrap.min.js');
		// load css files
		$this->data['css_files'] = array('/datatables.net-bs/css/dataTables.bootstrap.min.css');
		
		/* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        
        $this->data['sub_title'] = lang('menu_city_list');
        
        /* Data */
        $this->data['cities'] = $this->districts_model->getCityForParentId($id=0);
        
        foreach ($this->data['cities'] as $city)
        {
        	$city->tehsils = $this->districts_model->getCityForParentId($city->id);
        }
        
		/* Load Template */
		$this->template->admin_render('admin/districts/index', $this->data);
	}
	
	public function add()
	{
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, lang('menu_city_add'), 'admin/districts/add');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		
		$this->data['sub_title'] = lang('menu_city_add');
		
		// load js files in array
		$this->data['custom_js'] = array('/select2/js/select2.full.min.js');
		// load css files
		$this->data['css_files'] = array('/select2/css/select2.min.css');
		
		$this->data['cities'] = $this->districts_model->get_dropdown_city_list();
		
		/* Load Template */
		$this->template->admin_render('admin/districts/add_city', $this->data);
	}
	
	public function edit($id = null)
	{
		$this->data['item'] = $this->districts_model->getCityForEdit($id);
	
		if ( !$id OR empty($this->data['item']) )
		{
			$this->session->set_flashdata('message','This record not found!');
			$this->session->set_flashdata('message_type','warning');
			redirect('admin/districts', 'refresh');
		}
		else
		{				
			/* Breadcrumbs */
			$this->breadcrumbs->unshift(2, lang('menu_city_edit'), 'admin/districts/edit');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			
			$this->data['sub_title'] = lang('menu_city_edit');
				
			// load js files in array
			$this->data['custom_js'] = array('/select2/js/select2.full.min.js');
			// load css files
			$this->data['css_files'] = array('/select2/css/select2.min.css');
				
			$this->data['cities'] = $this->districts_model->get_dropdown_city_list();
				
			/* Load Template */
			$this->template->admin_render('admin/districts/add_city', $this->data);
		}
	}
	
	public function save()
	{
		$data = array(
				'id' 		=> strip_tags($this->input->post('id', TRUE)),
				'city_name' => strip_tags(trim($this->input->post('city_name', TRUE))),
				'city_id' => strip_tags(trim($this->input->post('city_id', TRUE))),
				'active' 	=> strip_tags($this->input->post('active', TRUE)),
				'sorting'	=> strip_tags($this->input->post('sorting', TRUE))
		);
		
		$this->form_validation->set_rules('city_name', 'city name', 'required|callback_check_unique_city['.$data['id'].']');
		
		if ($this->form_validation->run() == FALSE)
		{
// 			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			
			// load js files in array
			$this->data['custom_js'] = array('/select2/js/select2.full.min.js');
			// load css files
			$this->data['css_files'] = array('/select2/css/select2.min.css');
			
			$this->data['cities'] = $this->districts_model->get_dropdown_city_list();
			
			$this->data['item'] = (object) $data;
			
			/* Load Template */
			$this->template->admin_render('admin/districts/add_city', $this->data);
		}
		else 
		{
			if($this->districts_model->save($data) > 0)
			{
				$this->session->set_flashdata('message','The city name have saved!');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','The city name could not be saved!');
				$this->session->set_flashdata('message_type','danger');
			}
			
			redirect('admin/districts/add');
		}
	}
	
	function check_unique_city($value, $id)
	{
		$this->form_validation->set_message('check_unique_city','The city name is already exist!');
	
		$cityNames = $this->districts_model->check_unique_city($id);
	
		if ( array_key_exists ( $value, $cityNames ) ) {
	
			return false;
	
		} else {
			return true;
		}
	}
	
}