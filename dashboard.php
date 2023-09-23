<?php error_reporting(1); ?>
<?php include('./constant/layout/head.php');?>
<?php include('./constant/layout/header.php');?>

<?php include('./constant/layout/sidebar.php');?>   
<?php 

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = 0;

while ($orderResult = $orderQuery->fetch_assoc()) {
    //echo $orderResult['paid'];exit;
    $totalRevenue += $orderResult['paid'];

}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$userwisesql = "SELECT tbl_client.name , SUM(orders.grand_total) as totalorder,order_id FROM orders INNER JOIN tbl_client ON orders.client_name = tbl_client.name WHERE orders.order_status = 1 GROUP BY orders.client_name";
$userwiseQuery = $connect->query($userwisesql);
$userwieseOrder = $userwiseQuery->num_rows;

$totalOrderSql = "SELECT * FROM orders";
$totalOrderQuery = $connect->query($totalOrderSql);
$totalOrder = $totalOrderQuery->num_rows;

//$connect->close();

?>
  
<style type="text/css">
    .ui-datepicker-calendar {
        display: none;
    }
</style>
        
        <div class="page-wrapper">
            
     
            
            
            <div class="container-fluid">
                
                
        

                      <div class="row">
                        
                    <div class="col-md-3 dashboard">
                        <div class="card " style="background: #2BC155 ">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-user f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2 class="color-white"><?php echo $countProduct; ?></h2>
                                    <a href="product.php"><p class="m-b-0">Total Product</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
                    <div class="col-md-3 dashboard">
                        <div class="card" style="background:#A02CFA ">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-comment f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                                        


                            
                                    <h2 class="color-white"><?php echo $totalOrder; ?></h2>
                                     <a href="TotalOrder.php"><p class="m-b-0">All Orders</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                   <?php }?>
                   <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
                     <div class="col-md-3 dashboard">
                        <div class="card"  style="background-color: #F94687 ">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-vector f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    
                            <h2 class="color-white"><?php echo $countOrder; ?></h2>
                                    <a href="Order.php"><p class="m-b-0">Active Order</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
                
     
<div class="col-md-3 dashboard">
        <div class="card" style="background-color:#009688;">
           <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-money f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">


            <h1 style="color:white;"><?php if($totalRevenue) {
                echo $totalRevenue;
                } else {
                    echo '0';
                    } ?></h1>
         

         
            <p style="color:white;">Total Revenue</p>
             </div>
          </div>
        </div> 

    </div>
    <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
     <div class="col-md-12">
<div class="card">
                            <div class="card-header">
                                <strong class="card-title">User Wise Order</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                          
                                           <th scope="col">Name</th>
                                           <!-- <th scope="col">Measurement</th> -->
                                           <th scope="col">Orders Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                     <?php while ($orderResult = $userwiseQuery->fetch_assoc()) { ?>
                                     <tr>
                            <td><?php echo $orderResult['name']?></td>
                            <!-- <td><a href="viewMeasurement.php?id=<?php //echo $orderResult['order_id']?>"><button type="button" class="label label-success" ><h4>View Measurement</h4></button></a></td> -->
                            <td><?php echo $orderResult['totalorder']?></td>
                            
                        </tr>
                              <?php } ?>      
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php }?>
</div> 
<!-- <div class="row">
            <div class="col-md-3">
                <div id="piechart" style="width:100%; max-width:600px; height:500px;">
                    </div>
            </div>
            <div class="col-md-3">
                
            <div id="myChart1" style="width:100%; max-width:600px; height:500px;"></div>
            </div>
        </div> -->


        

<?php include('./constant/connect');

$tomorrow = strtotime("+1 day");
$tomorrowDate = date("Y-m-d", $tomorrow);
//echo $tomorrowDate;


$user=$_SESSION['userId'];
$sql = "SELECT *,orders.order_id as oid FROM orders,tbl_client WHERE orders.client_name= tbl_client.name AND order_status = 1 AND user_id = '".$user."' AND DATE(delivery_date) = CURDATE(); ";
$result = $connect->query($sql);

//echo $sql;exit;

    //echo $itemCountRow;exit; 
?>
      
                
                
                
                
                 <div class="card">
                            <div class="card-body">
                              
                          <div class="card-header">
                                <strong class="card-title">Today's Delivery</strong>
                            </div>
                         
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
                        <th>Delivery Date</th>
                         <th>Measurement</th>
                                            </tr>
                                       </thead>
                                       <tbody>
                                        <?php
                                        $x=1;
foreach ($result as $row) {
     

    ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo $row['order_date'] ?></td>
                                             <td><?php echo $row['name'] ?></td>
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
                                            <td><?php echo $row['delivery_date'] ?></td>
                                            <td><a href="viewMeasurement.php?id=<?php echo $row['oid']?>"><button type="button" class="label label-success" ><h4>View Measurement</h4></button></a></td>
                                        </tr>
                                     
                                    </tbody>
                                   <?php    
$x++;}

?>
                               </table>
                                </div>
                            </div>
                        </div>

<?php 

$sql1 = "SELECT *,orders.order_id as oid FROM orders, tbl_client WHERE orders.client_name = tbl_client.name AND order_status = 1 AND user_id = '".$user."' AND delivery_date ='".$tomorrowDate."'";
$result1 = $connect->query($sql1);

//echo $sql;exit;

    //echo $itemCountRow;exit; 
?>
      
                
                
                
                
                 <div class="card">
                            <div class="card-body">
                              
                          <div class="card-header">
                                <strong class="card-title">Tomorrow's  Delivery</strong>
                            </div>
                         
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
                        <th>Delivery Date</th>
                         <th>Measurement</th>
                                            </tr>
                                       </thead>
                                       <tbody>
                                        <?php
                                        $i=1;
foreach ($result1 as $row1) {
     

    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row1['order_date'] ?></td>
                                             <td><?php echo $row1['name'] ?></td>
                                              <td><?php echo $row1['client_contact'] ?></td>
                                               <td><?php echo $row1['grand_total']  ?></td>
                                            <td><?php  if($row1['payment_status']==1)
                                            {
                                                 
                                                 $paymentStatus = "<label class='label label-success' ><h4>Full Payment</h4></label>";
                                                 echo $paymentStatus;
                                            }
                                            else if($row1['payment_status']==2){
                                                $paymentStatus = "<label class='label label-danger'><h4>Advance Payment</h4></label>";
                                                echo $paymentStatus;
                                            }else {
                                                $paymentStatus = "<label class='label label-warning'><h4>No Payment</h4></label>";
                                                 echo $paymentStatus;
                                                } // /els
                                            ?></td>
                                            <td><?php echo $row1['delivery_date'] ?></td>
                                            <td><a href="viewMeasurement.php?id=<?php echo $row1['oid']?>"><button type="button" class="label label-success" ><h4>View Measurement</h4></button></a></td>
                                        </tr>
                                     
                                    </tbody>
                                   <?php    
$i++; }

?>
                               </table>
                                </div>
                            </div>
                        </div>

    </div>

            
            <?php include ('./constant/layout/footer.php');?>
       <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>