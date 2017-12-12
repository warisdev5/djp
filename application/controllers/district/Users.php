<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends District_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		/* Title Page */
		$this->page_title->push(lang('menu_dashboard'));
		$this->data['pagetitle'] = $this->page_title->show();
		
		/* Breadcrumbs */
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		
		/* Load Template */
		$this->template->district_render('district/dashboard/index', $this->data);
	}
}
