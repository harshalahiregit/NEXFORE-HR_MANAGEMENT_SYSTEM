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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


<h3>Departments</h3>

<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>

<a href="<?= site_url('departments/create') ?>" class="btn btn-primary mb-3">
    Add Department
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Department Name</th>
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($departments)) : ?>
            <?php foreach ($departments as $dept) : ?>
                <tr>
                    <td><?= $dept->id ?></td>
                    <td><?= $dept->name ?></td>
                    <td>
                        <a href="<?= site_url('departments/delete/'.$dept->id) ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this department?')">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="3">No departments found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
        <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-secondary">Back</a>

<?php $this->load->view('layout/footer'); ?>
