<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model');
        $this->load->model('Department_model');
        $this->load->helper('url');
        $this->load->library(['session', 'form_validation']);

        if (!$this->session->userdata('admin_logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $keyword = $this->input->get('keyword');
        $department_id = $this->input->get('department_id');
    
        $data['employees'] = $this->Employee_model->search($keyword, $department_id);
        $data['departments'] = $this->Department_model->get_all();
    
        $data['keyword'] = $keyword;
        $data['department_id'] = $department_id;
    
        $this->load->view('employees/index', $data);
    }

    public function create()
    {
        $data['departments'] = $this->Department_model->get_all();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('department_id', 'Department', 'required');
        $this->form_validation->set_rules('position', 'Position', 'required');
        $this->form_validation->set_rules('salary', 'Salary', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('employees/create', $data);
        } else {
            $insert = [
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'department_id' => $this->input->post('department_id'),
						'position' => $this->input->post('position'),
						'salary' => $this->input->post('salary')
            ];
            $this->Employee_model->insert($insert);
            $this->session->set_flashdata('success', 'Employee added successfully');
            redirect('employees');
        }
    }

    public function edit($id)
    {
        $data['employee'] = $this->Employee_model->get($id);
        $data['departments'] = $this->Department_model->get_all();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('department_id', 'Department', 'required');
        $this->form_validation->set_rules('position', 'Position', 'required');
        $this->form_validation->set_rules('salary', 'Salary', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('employees/edit', $data);
        } else {
            $update = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'department_id' => $this->input->post('department_id'),
                'position' => $this->input->post('position'),
                'salary' => $this->input->post('salary')
            ];
            $this->Employee_model->update($id, $update);
            $this->session->set_flashdata('success', 'Employee updated successfully');
            redirect('employees');
        }
    }

    public function delete($id)
    {
        $this->Employee_model->delete($id);
        $this->session->set_flashdata('success', 'Employee deleted successfully');
        redirect('employees');
    }
}
