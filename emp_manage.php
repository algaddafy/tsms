
<?php include('./constant/layout/head.php');?>
<?php include('./constant/layout/header.php');?>

<?php include('./constant/layout/sidebar.php');?> 

 <?php

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tailor';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Add Employee
if ($_POST['action'] == 'add_employee') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $hire_date = $_POST['hire_date'];
    $main_salary = $_POST['main_salary'];

    $sql = "INSERT INTO employees (first_name, last_name, email, main_salary, hire_date) VALUES ('$first_name', '$last_name', '$email', '$main_salary','$hire_date')";
    mysqli_query($conn, $sql);
}

// Record Attendance
if ($_POST['action'] == 'record_attendance') {
    $employee_id = $_POST['employee_id'];
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO attendance (employee_id, attendance_date, status) VALUES ($employee_id, '$attendance_date', '$status')";
    mysqli_query($conn, $sql);
}

// Manage Salary Payment
if ($_POST['action'] == 'manage_salary') {
    $employee_id = $_POST['employee_id'];
    $salary_amount = $_POST['salary_amount'];
    $salary_type = $_POST['salary_type'];
    $payment_date = $_POST['payment_date'];

    $sql = "INSERT INTO salary (employee_id, salary_amount, salary_type, payment_date) VALUES ($employee_id, '$salary_amount', '$salary_type', '$payment_date')";
    mysqli_query($conn, $sql);
}

?>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        form {
            margin: 20px 0;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        table {
            width: 30%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
    </style>

  
        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Website Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Website Management</li>
                    </ol>
                </div>
            </div>
            
            
            <div class="container-fluid">
                
            <h1>Employee Management System</h1>

    <!-- Add Employee Form -->
    <h1>Add Employee</h1>
    <form action="" method="post">
        <input type="hidden" name="action" value="add_employee">
        First Name: <input type="text" name="first_name"><br>
        Last Name: <input type="text" name="last_name"><br>
        Phone: <input type="text" name="email"><br>
        Main Salary: <input type="text" name="main_salary"><br>
        Hire Date: <input type="date" name="hire_date"><br>
        <input type="submit" value="Add Employee">
    </form>

    <!-- Record Attendance Form -->
<h1>Record Attendance</h1>
<form action="" method="post">
    <input type="hidden" name="action" value="record_attendance">
    Employee: 
    <select name="employee_id">
        <?php
        // Retrieve a list of employees from the database
        $employee_query = "SELECT id, first_name, last_name FROM employees";
        $employee_result = mysqli_query($conn, $employee_query);

        if (mysqli_num_rows($employee_result) > 0) {
            while ($employee_row = mysqli_fetch_assoc($employee_result)) {
                echo "<option value='" . $employee_row['id'] . "'>" . $employee_row['first_name'] . " " . $employee_row['last_name'] . "</option>";
            }
        }
        ?>
    </select><br>
    Attendance Date: <input type="date" name="attendance_date"><br>
    Status: 
    <select name="status">
        <option value="Present">Present</option>
        <option value="Absent">Absent</option>
    </select><br>
    <input type="submit" value="Record Attendance">
</form>


    <!-- Manage Salary Form -->
    <h1>Manage Salary</h1>
    <form action="" method="post">
        <input type="hidden" name="action" value="manage_salary">
        Employee ID:
        <select name="employee_id">
        <?php
        // Retrieve a list of employees from the database
        $employee_query2 = "SELECT id, first_name, last_name FROM employees";
        $employee_result2 = mysqli_query($conn, $employee_query2);

        if (mysqli_num_rows($employee_result2) > 0) {
            while ($employee_row2 = mysqli_fetch_assoc($employee_result2)) {
                echo "<option value='" . $employee_row2['id'] . "'>" . $employee_row2['first_name'] . " " . $employee_row2['last_name'] . "</option>";
            }
        }
        ?>
    </select><br>
        Salary Amount: <input type="text" name="salary_amount"><br>
        <label for="salary_type">Salary Type:</label>

<select name="salary_type" id="salary_type">
  <option value="Advanced">Advanced</option>
</select>
        Payment Date: <input type="date" name="payment_date"><br>
        <input type="submit" value="Manage Salary">
    </form>

    <!-- Link to View Records Page -->
    <a href="view_records_of_emp.php">View Attendance and Salary Records</a>
                
                
                <div class="row">
                    <div class="col-lg-8" style="    margin-left: 10%;">
                        <div class="card">
                            <div class="card-title">
                               
                            
                            </div>
                             
                        </div>
                    </div>
                </div>
                  
            </div>
        </div>
                
              
<?php 
include('./constant/layout/footer.php');

?>

