<?php include('./constant/layout/head.php');?>
<?php include('./constant/layout/header.php');?>

<?php include('./constant/layout/sidebar.php');?>   
<?php include('./constant/connect1');
$sql = "SELECT * FROM tbl_client, orders WHERE delete_status = 0 AND orders.client_name = tbl_client.name AND order_status = 1 GROUP BY tbl_client.name";

$result = $connect->query($sql);
//echo $sql;exit;

?>
       <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Clent</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Clent</li>
                    </ol>
                </div>
            </div>
            
            
            <div class="container-fluid">
                
                
                
                
                 <div class="card">
                            <div class="card-body">
                              
                            <a href="add_client.php"><button class="btn btn-primary">Add Client</button></a>
                         
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>#</th>
                                                <th>Client Name</th>
                                                <th>Gender</th>
                                                <th>Mobile NO</th>
                                                <th>Reffering</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                       </thead>
                                       <tbody>
                                        <?php
foreach ($result as $row) {
    $no+=1;
    ?>
                                        <tr>
                                            <td><?php echo$no; ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['gender'] ?></td>
                                              <td><?php echo $row['mob_no'] ?></td>
                                            <td><?php echo $row['reffering'] ?></td>
                                            <td><?php echo $row['address'] ?></td>
                                          
                                            <td>
            
                                                <a href="editclient.php?id=<?php echo $row['id']?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-pencil"></i></button></a>
                                              

             
                                                <a href="php_action/removeclient.php?id=<?php echo $row['id']?>" ><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></button></a>

                                                <a href="client_orders.php?id=<?php echo $row['order_id']?>"><button type="button" class="btn btn-xs btn-success" title="Client All Orders" ><i class="fa fa-address-card"></i></button></a>
                                           
                                                
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


