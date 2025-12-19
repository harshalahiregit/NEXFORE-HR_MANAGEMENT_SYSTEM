<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Employee_model');
        header('Content-Type: application/json');

        $this->check_token();
    }


    // GET /api/employees
    public function index()
    {
        $employees = $this->Employee_model->get_all();

        echo json_encode([
            'status' => true,
            'data'   => $employees
        ]);
    }

    // GET /api/employees/{id}
    public function show($id)
    {
        $employee = $this->Employee_model->get($id);

        if ($employee) {
            echo json_encode([
                'status' => true,
                'data'   => $employee
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message'=> 'Employee not found'
            ]);
        }
    }

    //************************************************ * POST /api/employees *****************************************************************************************
public function store()
{
    // Read input
    $input = json_decode(trim(file_get_contents('php://input')), true);

    if (
        empty($input['name']) ||
        empty($input['email']) ||
        empty($input['department_id']) ||
        empty($input['position']) ||
        empty($input['salary'])
    ) {
        echo json_encode([
            'status' => false,
            'message' => 'All fields are required'
        ]);
        return;
    }

    $data = [
        'name'          => $input['name'],
        'email'         => $input['email'],
        'department_id'=> $input['department_id'],
        'position'      => $input['position'],
        'salary'        => $input['salary']
    ];

    $insert = $this->Employee_model->insert($data);

    if ($insert) {
					echo json_encode([
						'status' => true,
						'message'=> 'Employee added successfully'
					]);
    } else {
        echo json_encode([
            'status' => false,
            'message'=> 'Insert failed'
        ]);
    }
}


//******************************************************************** PUT /api/employees/{id}******************************************************************************* * 
public function update($id)
{
    $input = json_decode(trim(file_get_contents('php://input')), true);

    if (!$input) {
        echo json_encode([
            'status' => false,
            'message' => 'Invalid input'
        ]);
        return;
    }

    $data = [
        'name'          => $input['name'] ?? null,
        'email'         => $input['email'] ?? null,
        'department_id' => $input['department_id'] ?? null,
        'position'      => $input['position'] ?? null,
        'salary'        => $input['salary'] ?? null
    ];

    $data = array_filter($data, fn($v) => $v !== null);

    $updated = $this->Employee_model->update($id, $data);

    if ($updated) {
        echo json_encode([
            'status' => true,
            'message' => 'Employee updated successfully'
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Update failed or no changes'
        ]);
    }
}

//****************************************************************************** * DELETE /api/employees/{id} ********************************************************************
public function delete($id)
{
    $deleted = $this->Employee_model->delete($id);

    if ($deleted) {
				echo json_encode([
					'status' => true,
					'message' => 'Employee deleted successfully'
				]);
    } 
	else {
				echo json_encode([
            'status' => false,
            'message' => 'Delete failed'
        ]);
    }
}


//****************************************************************************************** *TOKEN*******************************************************************************
private function check_token()
{
    $headers = $this->input->request_headers();

    if (
        !isset($headers['Api-Key']) || $headers['Api-Key'] !== 'NEXFORE123456'
    ) {
        echo json_encode([
            'status' => false,
            'message' => 'Unauthorized access'
        ]);
        exit;
    }
}


}
