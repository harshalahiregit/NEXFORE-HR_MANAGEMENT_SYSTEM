<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Department_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');

        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        
        $data['total_departments'] = count($this->Department_model->get_all());

        $data['total_employees'] = count($this->Employee_model->get_all());

        $departments = $this->Department_model->get_all();
        $dept_counts = [];
		
		

        foreach ($departments as $dept) {
            $count = $this->db->where('department_id', $dept->id)->count_all_results('employees');
            $dept_counts[] = [
			'id'    => $dept->id,
                'name' => $dept->name,
                'count' => $count
            ];
        }
        $data['dept_counts'] = $dept_counts;

        $this->load->view('dashboard/index', $data);
    }
}
