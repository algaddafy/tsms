<?php include('./constant/layout/head.php');?>
<?php include('./constant/layout/header.php');?>

<?php include('./constant/layout/sidebar.php');?> 

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    .page-wrapper {
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ccc;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #83c2d5 !important;
        color: #ffffff !important;
    }

    a {
        text-decoration: none;
        color: #333;
    }

    a:hover {
        color: #555;
    }

    @media (max-width: 768px) {
        table {
            width: 100%;
            overflow-x: auto;
        }
    }
</style>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Employee Attendance and Salary Records</h3>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Display Attendance Records -->
        <h1>Attendance Records</h1>
        <table id="attendanceTable" class="display">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Attendance Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
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

                // Fetch and display attendance records
                $sql = "SELECT a.attendance_date, a.status, e.first_name, e.last_name
                FROM attendance a INNER JOIN employees e ON a.employee_id = e.id";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                        echo "<td>" . $row['attendance_date'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No attendance records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Display Advanced Salary Records -->
        <h1>Advanced Salary Records</h1>
        <table id="advancedSalaryTable" class="display">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Phone Number</th>
                    <th>Payment Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch and display advanced salary records with email
                $sql = "SELECT e.first_name, e.last_name, e.email, s.payment_date
                        FROM salary s
                        INNER JOIN employees e ON s.employee_id = e.id
                        WHERE s.salary_type = 'Advanced'";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    // Debugging: Print any MySQL errors
                    echo "MySQL Error: " . mysqli_error($conn);
                }

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['payment_date'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No advanced salary records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Attendance and Salary Records for Each Employee -->
        <h1>Attendance and Salary Records for Each Employee</h1>
        <table id="employeeRecordsTable" class="display">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Attendance Count</th>
                    <th>Salary Count</th>
                    <th>Given Salary</th>
                    <th>Main Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection (reopen the connection)
                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch the count of attendance records for each employee
                $attendanceCountSQL = "SELECT e.first_name, e.last_name, COUNT(a.id) AS attendance_count
                                        FROM employees e
                                        LEFT JOIN attendance a ON e.id = a.employee_id
                                        GROUP BY e.id";
                $attendanceCountResult = mysqli_query($conn, $attendanceCountSQL);

                // Fetch the count of salary records for each employee
                $salaryCountSQL = "SELECT *, e.first_name, e.last_name, COUNT(s.id) AS salary_count, SUM(s.salary_amount) AS salary_given
                                    FROM employees e
                                    LEFT JOIN salary s ON e.id = s.employee_id
                                    GROUP BY e.id";
                $salaryCountResult = mysqli_query($conn, $salaryCountSQL);

                // Combine the counts for each employee and display them
                while ($attendanceCountRow = mysqli_fetch_assoc($attendanceCountResult)) {
                    $employeeName = $attendanceCountRow['first_name'] . ' ' . $attendanceCountRow['last_name'];
                    $attendanceCount = $attendanceCountRow['attendance_count'];

                    $salaryCountRow = mysqli_fetch_assoc($salaryCountResult);
                    $salaryCount = $salaryCountRow['salary_count'];
                    $salaryGiven = $salaryCountRow['salary_given'];
                    $mainSalary = $salaryCountRow['main_salary'];

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($employeeName) . "</td>";
                    echo "<td>" . htmlspecialchars($attendanceCount) . "</td>";
                    echo "<td>" . htmlspecialchars($salaryCount) . "</td>";
                    echo "<td>" . htmlspecialchars($salaryGiven) . "</td>";
                    echo "<td>" . htmlspecialchars($mainSalary) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('./constant/layout/footer.php');?>

<!-- Include DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#attendanceTable').DataTable();
        $('#advancedSalaryTable').DataTable();
        $('#employeeRecordsTable').DataTable();
    });
</script>
