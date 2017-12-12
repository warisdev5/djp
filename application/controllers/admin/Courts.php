<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courts extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->dbutil();

        $this->load->model('admin/courts_model');
        $this->load->model('admin/districts_model');

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_courts'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_courts'), 'admin/courts');
    }

	public function index()
	{		
		// load js files in array
		$this->data['js_files'] = array('/datatables.net/js/jquery.dataTables.min.js', '/datatables.net-bs/js/dataTables.bootstrap.min.js');
		// load css files
		$this->data['css_files'] = array('/datatables.net-bs/css/dataTables.bootstrap.min.css');
				
		/* Breadcrumbs */
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		$this->data['sub_title'] = lang('menu_courts_list');

		/* Data */
		$this->data['judges'] = $this->courts_model->getJudges();
            
//         foreach ($this->data['categories'] as $cat)
//         {
//         	$cat->sub_categories = $this->category_model->getCategoryForParentId($cat->id);
//         }
        
//         echo '<pre>';
//         var_dump($this->data['categories']);
//         die();

		/* Load Template */
		$this->template->admin_render('admin/courts/judges/index', $this->data);
	}
	
	public function judges()
	{
		// load js files in array
		$this->data['js_files'] = array('/datatables.net/js/jquery.dataTables.min.js', '/datatables.net-bs/js/dataTables.bootstrap.min.js');
		// load css files
		$this->data['css_files'] = array('/datatables.net-bs/css/dataTables.bootstrap.min.css');
	
		/* Breadcrumbs */
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
	
		$this->data['sub_title'] = lang('menu_judge');
	
		/* Data */
		$this->data['judges'] = $this->courts_model->getJudges();
	
// 		        echo '<pre>';
// 		        var_dump($this->data['judges']);
// 		        die();
	
		/* Load Template */
		$this->template->admin_render('admin/courts/judges/index', $this->data);
	}
	
	public function add_judge()
	{
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, lang('menu_judge_add'), 'admin/courts/add_judge');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
	
		$this->data['sub_title'] = lang('menu_judge_add');
	
		// load js files in array
		$this->data['custom_js'] = array('/adminlte/js/custom.js','/select2/js/select2.full.min.js','/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
		// load css files
		$this->data['css_files'] = array('/select2/css/select2.min.css','/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
		
		/* Dropdown list */
		$this->data['designations'] = $this->courts_model->getDesignations();
		$this->data['cities'] = $this->districts_model->getCityForParentId($id=0);
		
// 		echo date('d-F-Y', strtotime('2000-11-01'));
// 		die();
	
		/* Load Template */
		$this->template->admin_render('admin/courts/judges/add_judge', $this->data);
	}
	
	public function edit_judge($id = null)
	{
		$this->data['item'] = $this->courts_model->getJudgeForEdit($id);
	
		if ( !$id OR empty($this->data['item']) )
		{
			$this->session->set_flashdata('message','This record not found!');
			$this->session->set_flashdata('message_type','warning');
			redirect('admin/courts/judges', 'refresh');
		}
		else
		{
			/* Breadcrumbs */
			$this->breadcrumbs->unshift(2, lang('menu_judge_edit'), 'admin/courts/edit_judge');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
	
			$this->data['sub_title'] = lang('menu_judge_edit');
	
			// load js files in array
			$this->data['custom_js'] = array('/adminlte/js/custom.js','/select2/js/select2.full.min.js','/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
			// load css files
			$this->data['css_files'] = array('/select2/css/select2.min.css','/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
			
			/* Dropdown list */
			$this->data['designations'] = $this->courts_model->getDesignations();
			$this->data['cities'] = $this->districts_model->getCityForParentId($id=0);
	
			/* Load Template */
			$this->template->admin_render('admin/courts/judges/add_judge', $this->data);
		}
	}
	
	public function save_judge()
	{
		$data = array(
				'judge_id' 			=> strip_tags($this->input->post('judge_id', TRUE)),
				'judge_name' 		=> strip_tags(trim($this->input->post('judge_name', TRUE))),
				'desgn_id'			=> strip_tags(trim($this->input->post('desgn_id', TRUE))),
				'date_of_birth' 	=> strip_tags($this->input->post('date_of_birth', TRUE)),
				'date_of_joining' 	=> strip_tags($this->input->post('date_of_joining', TRUE)),
				'date_of_retirement'=> strip_tags($this->input->post('date_of_retirement', TRUE)),
				'domicile_id'		=> strip_tags($this->input->post('domicile_id', TRUE)),
				'gender'			=> strip_tags($this->input->post('gender', TRUE)),
				'seniority'			=> strip_tags($this->input->post('seniority', TRUE))
		);
	
// 				echo '<pre>';
// 				var_dump($data);
// 				die();
	
// 		$this->form_validation->set_rules('desgn_name', 'designation', 'required|callback_check_unique_designation['.$data['desgn_id'].']');
		$this->form_validation->set_rules('judge_name', 'judge name', 'required');
		$this->form_validation->set_rules('desgn_id', 'designation', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');
	
		if ($this->form_validation->run() == FALSE)
		{
			// 			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
	
			if ($data['judge_id']==0)
			{
				$this->data['sub_title'] = lang('menu_judge_add');
			}
			else
			{
				$this->data['sub_title'] = lang('menu_judge_edit');
			}
	
			// load js files in array
			$this->data['custom_js'] = array('/adminlte/js/custom.js','/select2/js/select2.full.min.js','/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
			// load css files
			$this->data['css_files'] = array('/select2/css/select2.min.css','/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
			
			/* Dropdown list */
			$this->data['designations'] = $this->courts_model->getDesignations();
			$this->data['cities'] = $this->districts_model->getCityForParentId($id=0);
	
			$this->data['item'] = (object) $data;
				
			// 					echo '<pre>';
			// 					var_dump($data);
			// 					die();
	
			/* Load Template */
			$this->template->admin_render('admin/courts/judges/add_judge', $this->data);
		}
		else
		{
			if($this->courts_model->save_judge($data) > 0)
			{
				$this->session->set_flashdata('message','The judge profile have saved!');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','The judge profile could not be saved!');
				$this->session->set_flashdata('message_type','warning');
			}
	
			redirect('admin/courts/add_judge');
		}
	}
	
	public function designations()
	{
		// load js files in array
		$this->data['js_files'] = array('/datatables.net/js/jquery.dataTables.min.js', '/datatables.net-bs/js/dataTables.bootstrap.min.js');
		// load css files
		$this->data['css_files'] = array('/datatables.net-bs/css/dataTables.bootstrap.min.css');
	
		/* Breadcrumbs */
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
	
		$this->data['sub_title'] = lang('menu_desgn');
	
		/* Data */
		$this->data['designations'] = $this->courts_model->getDesignations();
	
		//         echo '<pre>';
		//         var_dump($this->data['categories']);
		//         die();
	
		/* Load Template */
		$this->template->admin_render('admin/courts/designation/index', $this->data);
	}
	
	function check_unique_designation($value, $id)
	{
		$this->form_validation->set_message('check_unique_designation','This designation name is already exist!');
	
		$desgnNames = $this->courts_model->check_unique_designation($id);
	
		if ( array_key_exists ( $value, $desgnNames ) ) {
	
			return false;
	
		} else {
			return true;
		}
	}
	
	public function add_designation()
	{		
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, lang('menu_desgn_add'), 'admin/courts/add_designation');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		
		$this->data['sub_title'] = lang('menu_desgn_add');
		
		// load js files in array
		$this->data['custom_js'] = array('/adminlte/js/custom.js');
		
		/* Load Template */
		$this->template->admin_render('admin/courts/designation/add_desgn', $this->data);
	}
	
	public function edit_designation($id = null)
	{
		$this->data['item'] = $this->courts_model->getDesignationForEdit($id);
	
		if ( !$id OR empty($this->data['item']) )
		{
			$this->session->set_flashdata('message','This record not found!');
			$this->session->set_flashdata('message_type','warning');
			redirect('admin/courts/designations', 'refresh');
		}
		else
		{
			/* Breadcrumbs */
			$this->breadcrumbs->unshift(2, lang('menu_desgn_edit'), 'admin/courts/edit_designation');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
				
			$this->data['sub_title'] = lang('menu_desgn_edit');
				
			// load js files in array
			$this->data['custom_js'] = array('/adminlte/js/custom.js');
				
			/* Load Template */
			$this->template->admin_render('admin/courts/designation/add_desgn', $this->data);
		}
	}
	
	public function save_designation()
	{
		$data = array(
				'desgn_id' 			=> strip_tags($this->input->post('desgn_id', TRUE)),
				'desgn_name' 		=> strip_tags(trim($this->input->post('desgn_name', TRUE))),
				'desgn_short_name'	=> strip_tags(trim($this->input->post('desgn_short_name', TRUE))),
				'active' 			=> strip_tags($this->input->post('active', TRUE)),
				'sorting'			=> strip_tags($this->input->post('sorting', TRUE))
		);
	
// 		echo '<pre>';		
// 		var_dump($data);
// 		die();
	
		$this->form_validation->set_rules('desgn_name', 'designation', 'required|callback_check_unique_designation['.$data['desgn_id'].']');
		$this->form_validation->set_rules('desgn_short_name', 'designation short name', 'required');
	
		if ($this->form_validation->run() == FALSE)
		{
			// 			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
				
			if ($data['desgn_id']==0)
			{
				$this->data['sub_title'] = lang('menu_desgn_add');
			}
			else
			{
				$this->data['sub_title'] = lang('menu_desgn_edit');
			}
				
			// load js files in array
			$this->data['js_files'] = array('/adminlte/js/custom.js');
				
// 			$this->data['cats'] = $this->category_model->get_dropdown_cats_list();
				
			$this->data['item'] = (object) $data;
			
// 					echo '<pre>';
// 					var_dump($data);
// 					die();
			
			
				
			/* Load Template */
			$this->template->admin_render('admin/courts/designation/add_desgn', $this->data);
		}
		else
		{
			if($this->courts_model->save_designation($data) > 0)
			{
				$this->session->set_flashdata('message','The designation have saved!');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','The designation could not be saved!');
				$this->session->set_flashdata('message_type','warning');
			}
				
			redirect('admin/courts/add_designation');
		}
	}
	
	public function add()
	{
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, lang('menu_category_add'), 'admin/category/add');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
	
		$this->data['sub_title'] = lang('menu_desgn_add');
	
		// load js files in array
		$this->data['custom_js'] = array('/adminlte/js/custom.js','/select2/js/select2.full.min.js');
		// load css files
		$this->data['css_files'] = array('/select2/css/select2.min.css');
	
		$this->data['cats'] = $this->category_model->get_dropdown_cats_list();
	
		/* Load Template */
		$this->template->admin_render('admin/category/add_cat', $this->data);
	}
	
	
	
	public function edit($id = null)
	{
		$this->data['item'] = $this->category_model->getCategoryForEdit($id);
		
		if ( !$id OR empty($this->data['item']) )
		{
			$this->session->set_flashdata('message','This record not found!');
			$this->session->set_flashdata('message_type','warning');
			redirect('admin/category', 'refresh');
		}
		else
		{			
			/* Breadcrumbs */
			$this->breadcrumbs->unshift(2, lang('menu_category_edit'), 'admin/category/edit');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			
			$this->data['sub_title'] = lang('menu_category_edit');
			
			// load js files in array
			$this->data['custom_js'] = array('/adminlte/js/custom.js','/select2/js/select2.full.min.js');
			// load css files
			$this->data['css_files'] = array('/select2/css/select2.min.css');
			
			$this->data['cats'] = $this->category_model->get_dropdown_cats_list();
			
			/* Load Template */
			$this->template->admin_render('admin/category/add_cat', $this->data);
		}
	}
	
	public function save()
	{
		$data = array(
				'id' 		=> strip_tags($this->input->post('id', TRUE)),
				'cat_name' 	=> strip_tags(trim($this->input->post('cat_name', TRUE))),
				'case_type_id'	=> strip_tags(trim($this->input->post('case_type_id', TRUE))),
				'cat_id' 	=> strip_tags(trim($this->input->post('cat_id', TRUE))),
				'active' 	=> strip_tags($this->input->post('active', TRUE)),
				'sorting'	=> strip_tags($this->input->post('sorting', TRUE))
		);
		
// 		var_dump($data);
// 		die();
		
		$this->form_validation->set_rules('cat_name', 'category', 'required|callback_check_unique_category['.$data['id'].']');
		$this->form_validation->set_rules('case_type_id', 'category type', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
// 			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			
			if ($data['id']==0)
			{
				$this->data['sub_title'] = lang('menu_category_add');
			}
			else 
			{
				$this->data['sub_title'] = lang('menu_category_edit');
			}
			
			// load js files in array
			$this->data['js_files'] = array('/adminlte/js/custom.js','/select2/dist/js/select2.full.min.js');
			// load css files
			$this->data['css_files'] = array('/select2/dist/css/select2.min.css');
			
			$this->data['cats'] = $this->category_model->get_dropdown_cats_list();
			
			$this->data['item'] = (object) $data;
			
			/* Load Template */
			$this->template->admin_render('admin/category/add_cat', $this->data);
		}
		else 
		{
			if($this->category_model->save($data) > 0)
			{
				$this->session->set_flashdata('message','The category have saved!');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','The category could not be saved!');
				$this->session->set_flashdata('message_type','warning');
			}
			
			redirect('admin/category/add');
		}
	}
	
	function check_unique_category($value, $id)
	{
		$this->form_validation->set_message('check_unique_category','The category name is already exist!');
	
		$catNames = $this->category_model->check_unique_category($id);
	
		if ( array_key_exists ( $value, $catNames ) ) {
	
			return false;
	
		} else {
			return true;
		}
	}
	
}