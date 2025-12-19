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

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->

<div class="container mt-5">
    <h3 class="mb-4">Dashboard</h3>

    <div class="row">
        <div class="col-md-4">
            <a href="<?php echo site_url('departments'); ?>" style="text-decoration: none;">
                <div class="card text-white bg-primary">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Departments</h5>
                        <p class="card-text fs-3"><?php echo $total_departments; ?></p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="<?php echo site_url('employees'); ?>" style="text-decoration: none;">
                <div class="card text-white bg-success">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Employees</h5>
                        <p class="card-text fs-3"><?php echo $total_employees; ?></p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <h4 class="mt-4">Employees per Department</h4>
    <div class="row">
        <?php if (!empty($dept_counts)): ?>
            <?php foreach($dept_counts as $dept): ?>
                <div class="col-md-3 mb-3">
                    <a href="<?php echo site_url('employees?department_id='.$dept['id']); ?>" style="text-decoration: none;">
                        <div class="card text-white bg-info">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $dept['name']; ?></h5>
                                <p class="card-text fs-4"><?php echo $dept['count']; ?> Employees</p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No departments found.</p>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('layout/footer'); ?>

</body>
</html>
