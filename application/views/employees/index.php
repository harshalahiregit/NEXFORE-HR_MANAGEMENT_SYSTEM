<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>NEXFORE HR_MANAGEMENT</title>
  </head>
  <body>
  <?php $this->load->view('layout/header'); ?>

<div class="container mt-5">
    <h3>Employees</h3>
    <a href="<?php echo site_url('employees/create'); ?>" class="btn btn-success mb-3">Add Employee</a>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <form method="get" action="<?php echo site_url('employees'); ?>" class="form-inline mb-3">
        <input type="text" name="keyword" class="form-control mr-2"
               placeholder="Search name or email"
               value="<?php echo isset($keyword) ? $keyword : ''; ?>">

        <select name="department_id" class="form-control mr-2">
            <option value="">All Departments</option>
            <?php if(isset($departments) && $departments): ?>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?php echo $dept->id; ?>"
                        <?php echo (isset($department_id) && $department_id == $dept->id) ? 'selected' : ''; ?>>
                        <?php echo $dept->name; ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <button type="submit" class="btn btn-primary">Search</button>
        <a href="<?php echo site_url('employees'); ?>" class="btn btn-secondary ml-2">Reset</a>
    </form>



    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($employees): ?>
            <?php foreach ($employees as $emp): ?>
                <tr>
                    <td><?php echo $emp->id; ?></td>
                    <td><?php echo $emp->name; ?></td>
                    <td><?php echo $emp->email; ?></td>
                    <td><?php echo $emp->department_name; ?></td>
                    <td><?php echo $emp->position; ?></td>
                    <td><?php echo $emp->salary; ?></td>
                    <td>
                        <a href="<?php echo site_url('employees/edit/'.$emp->id); ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="<?php echo site_url('employees/delete/'.$emp->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center">No employees found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
        <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-secondary">Back</a>

<!-- Optional JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
