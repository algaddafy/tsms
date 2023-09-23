<?php include('./constant/layout/head.php');?>
<?php include('./constant/layout/header.php');?>

<?php include('./constant/layout/sidebar.php');?>

<?php include('./constant/connect');
 $user=$_SESSION['userId'];
 $orderId = $_GET['id'];
 $sql = "SELECT orders.*, tbl_client.name AS client_name, tbl_client.mob_no AS client_contact 
        FROM orders
        LEFT JOIN tbl_client ON orders.client_name = tbl_client.name
        WHERE orders.client_name IN (
            SELECT client_name FROM orders WHERE order_id = '$orderId'
        )";
        
//  $sql = "SELECT * FROM orders WHERE client_name IN (
//     SELECT client_name FROM orders WHERE order_id = '$orderId'
// )";


//  $sql="SELECT * from measurement where order_id='".$orderId."'";
// $sql = "SELECT * FROM orders,tbl_client WHERE orders.client_name= tbl_client.name AND order_status = 1 AND user_id = '$user'";
$result = $connect->query($sql);

//echo $sql;exit;

    //echo $itemCountRow;exit; 
?>
       <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Invoice</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Invoice</li>
                    </ol>
                </div>
            </div>
            
            
            <div class="container-fluid">
                
                
                
                
                 <div class="card">
                            <div class="card-body">
                              
                            <a href="add-order.php"><button class="btn btn-primary">Add Invoice</button></a>
                         
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>#</th>
                        <th>Invoice Date</th>
                        <th>Client Name</th>
                        <th>Contact</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                                                <th>Action</th>
                                            </tr>
                                       </thead>
                                       <tbody>
                                        <?php
foreach ($result as $row) {
     

    ?>
                                        <tr>
                                            <td><?php echo $row['order_id'] ?></td>
                                            <td><?php echo $row['order_date'] ?></td>
                                             <td><?php echo $row['client_name'] ?></td>
                                              <td><?php echo $row['client_contact'] ?></td>
                                               <td><?php echo $row['grand_total']  ?></td>
                                            <td><?php  if($row['payment_status']==1)
                                            {
                                                 
                                                 $paymentStatus = "<label class='label label-success' ><h4>Full Payment</h4></label>";
                                                 echo $paymentStatus;
                                            }
                                            else if($row['payment_status']==2){
                                                $paymentStatus = "<label class='label label-danger'><h4>Advance Payment</h4></label>";
                                                echo $paymentStatus;
                                            }else {
                                                $paymentStatus = "<label class='label label-warning'><h4>No Payment</h4></label>";
                                                 echo $paymentStatus;
                                                } // /els
                                            ?></td>
                                            <td>
                                               <a href="addmeasurement.php?id=<?php echo $row['order_id']?>"><button type="button" class="btn btn-xs btn-success" title="Add Measurement" ><i class="fa fa-address-card"></i></button></a>
                                                <a href="update-measurement.php?id=<?php echo $row['order_id']?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-pencil"></i></button></a>
                                              <a href="print.php?id=<?php echo $row['order_id']?>"><button type="button" class="btn btn-xs btn-info" ><i class="fa fa-print"></i></button></a>

                                              

             
                                            <a href="php_action/removeOrder.php?id=<?php echo $row['order_id']?>" ><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></button></a>
                                           
                                                
                                                </td>
                                        </tr>
                                     
                                    </tbody>
                                   <?php    
}

?>
                               </table>
                                </div>
                            </div>
                        </div>

<?php include('./constant/layout/footer.php');?>


