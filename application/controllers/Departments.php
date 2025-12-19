<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('admin_logged_in')) 
		{
            redirect('auth/login');
        }

        $this->load->model('Department_model');
        $this->load->helper(['url', 'form']);
    }

    public function index()
    {
        $data['departments'] = $this->Department_model->get_all();
        $this->load->view('departments/index', $data);
    }

    public function create()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Department Name', 'required');
    
            if ($this->form_validation->run() == TRUE) {
    
                $insert = $this->Department_model->insert([
                    'name'        => $this->input->post('name'),
                    'description' => $this->input->post('description')
                ]);
    
                if ($insert) {
                    $this->session->set_flashdata('success', 'Department added successfully.');
                    redirect('departments');
                }
            }
        }
    
        $this->load->view('departments/create');
    }
    
    public function edit($id)
    {
        $data['department'] = $this->Department_model->get($id);
        if (!$data['department']) {
            redirect('departments');
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Department Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->Department_model->update($id, [
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description')
                ]);

                $this->session->set_flashdata('success', 'Department updated successfully.');
                redirect('departments');
            }
        }

        $this->load->view('departments/edit', $data);
    }

    public function delete($id)
    {
        if (empty($id)) {
            redirect('departments');
        }
    
        $deleted = $this->Department_model->delete($id);
    
        if ($deleted) {
            $this->session->set_flashdata('success', 'Department deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Unable to delete department.');
        }
    
        redirect('departments');
    }
    
}
