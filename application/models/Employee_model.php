<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model
{
    protected $table = 'employees';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select('employees.*, departments.name as department_name');
        $this->db->from('employees');
        $this->db->join('departments', 'employees.department_id = departments.id', 'left');
        return $this->db->get()->result();
    }
	//for id
    public function get($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }

    public function search($keyword = null, $department_id = null)
    {
        $this->db->select('employees.*, departments.name as department_name');
        $this->db->from('employees');
        $this->db->join('departments', 'departments.id = employees.department_id', 'left');

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('employees.name', $keyword);
            $this->db->or_like('employees.email', $keyword);
            $this->db->group_end();
        }

        if (!empty($department_id)) {
            $this->db->where('employees.department_id', $department_id);
        }

        return $this->db->get()->result();
    }

}
