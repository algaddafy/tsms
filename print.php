<?php include('./constant/layout/head.php');?>
<?php 
include('./constant/connect.php');?>
 
        <div class="">
            
           
            
            <div class="container-fluid" style="background-color: #ffffff;">
                
                
                <?php
                  $getId = $_GET['id'];

                 $productSql = "SELECT * FROM orders WHERE order_id = '".$_GET['id']."'";
                      $productData = $connect->query($productSql);

                      $row = $productData->fetch_array();
                      $productSql1 = "SELECT * FROM users WHERE user_id= '".$row['user_id']."'";
                      $productData1 = $connect->query($productSql1);

                      $row1 = $productData1->fetch_array();
                 
                      $sql1 = "SELECT * FROM tbl_client,orders WHERE tbl_client.mob_no=orders.client_contact AND orders.order_id = '".$getId."'";

        $result1 = $connect->query($sql1);
        $data1 = $result1->fetch_assoc();
                 
                                                
                      ?>
                
                <div class="row">
                    <div class="col-lg-12" >
                        <div class="card">
                            <div class="card-title">
                               <div class="float-left">
    <h2 class="mb-0" style="color: black;">Invoice #<?php echo$row['order_id']; ?></h2>
</div> 
                                    <div class="float-right"> 
                                    Date:  <?php echo$row['order_date']; ?></div>
                            </div>
                            <hr>
                            
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-sm-4 mt-4">
                                            <?php
                                            $que="select * from manage_website";
$query=$connect->query($que);
                                                $web=mysqli_fetch_array($query);
                                            ?>
                                            <br>
                                            <image class="profile-img" src="./assets/uploadImage/Logo/<?=$web['invoice_logo']?>" style="height:120px;width:auto;">
                                                
                                        </div>
                                        <div class="col-sm-4">
                                            <br>
                                            <h5 class="mb-3" style="color: black;">From:</h5>                                            
                                            <h3 class="text-dark mb-1"><?=$row1['username'];?></h3>
                                         <div><?php echo $web['currency_code']; ?></div>
<!--                                             <div><?=$result['address']?></div>
 -->                                            <div>Email: <?=$row1['email']?></div>
                                             <div>Contact: <?php echo $web['short_title']; ?></div>
                                             
                                        </div>
                                        <div class="col-sm-4">
                                            <br>
                                            <h5 class="mb-3" style="color: black;">To:</h5>
                                            <h3 class="text-dark mb-1"><?= $data1['name']; ?></h3>                                            
                                            <div><?= $data1['address']; ?></div>
<!--                                            <div>Canal Winchester, OH 43110</div>
-->
                                            <div>Phone: <?= $data1['mob_no']; ?></div>
                                        </div>
                                    </div>
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="center">#</th>
                                                    <th>Product</th>
                                                    <th class="center">Qty</th>
                                                    <th class="right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                
                                                 
                                                  $productSql11 = "SELECT * FROM order_item WHERE order_id = '".$_GET['id']."'";
                      $productData11 = $connect->query($productSql11);

                     while($row11 = $productData11->fetch_array()){
                  
                                                    $productSql2 = "SELECT * FROM product WHERE product_id='".$row11['product_id']."'";
                      $productData2 = $connect->query($productSql2);

                      $row2 = $productData2->fetch_array();
            $no +=1;
                                                ?>
                                                <tr>
                                                    <td class="center"><?=$no?></td>
                                                    <td class="left strong"><?=$row2['product_name']?></td>
                                                    <td class="center"><?=$row11['quantity']?></td>
                                                    <td class="right"><?=$row11['total']?></td>
                                                </tr>
                                              <?php }  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                    <?php 
                                                
                                                 
                                                $productSql11 = "SELECT * FROM order_item WHERE order_id = '".$_GET['id']."'";
                    $productData11 = $connect->query($productSql11);

                   while($row11 = $productData11->fetch_array()){
                
                                                  $productSql2 = "SELECT * FROM product WHERE product_id='".$row11['product_id']."'";
                    $productData2 = $connect->query($productSql2);

                    $row2 = $productData2->fetch_array();
          $no +=1;
                                              ?>
                                        <div class="col-lg-2 col-sm-2">
                                        <img src="./assets/myimages/<?=$row2['product_image']?>" style="height:250px;width: 150px;">
                                        </div>
                                        <?php }  ?>
                                        <div class="col-lg-4 col-sm-5 ml-auto">
                                            <table class="table table-clear">
                                                <tbody>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Subtotal</strong>
                                                        </td>
                                                        <td class="right"><?=$row['sub_total']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Discount (<?=$row['discount']?> taka)</strong>
                                                        </td>
                                                        <td class="right"><?php
                                                        echo $discount=$row['sub_total']-($row['discount']);
                                                        ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Vat (<?=$row['gst_rate']?>%)</strong>
                                                        </td>
                                                        <td class="right"><?php
                                                        $gst_rate=($row['sub_total']-$discount)*($row['gstn']/100);
                                                        echo number_format($gst_rate,2);
                                                        ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Total</strong>
                                                        </td>
                                                        <td class="right">
                                                            <strong class="text-dark"><?=$row['grand_total']?></strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Paid</strong>
                                                        </td>
                                                        <td class="right">
                                                            <strong class="text-dark"><?=$row['paid']?></strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Due</strong>
                                                        </td>
                                                        <td class="right">
                                                            <strong class="text-dark"><?=$row['due']?></strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="card-footer bg-white">
                                    <p class="mb-0">Thank you for your order !</p>
                                </div>
                <br><br>
                <div class="col-md-5 align-self-left">
                <h2 class="mb-0" style="color: black;">Invoice #<?php echo$row['order_id']; ?></h2>
                </div>
                                <?php
$orderId = $_GET['id'];
$sqltest="SELECT * from measurement where order_id='".$orderId."'";
  $result=$connect->query($sqltest)->fetch_assoc();  ?> 
                <div class="card">
                    <div class="card-title">

                    </div>
                  <div id="add-brand-messages"></div>
                      <div class="card-body">
                            <div class="input-states">
                                <form class="form-horizontal" method="POST" action="" id="editOrderForm">

                              
                            

                              <div class="form-group">
                                <div class="row">
                                <label class="col-sm-2 control-label">Date</label>
                                  <div class="col-sm-10">
                                  <input type="text" value="<?php echo $result['Date']?>" class="form-control" id="orderDate" name="date" autocomplete="off" readonly />
                                </div>
                              </div> 
                            </div>
                            <div class="form-group">
                                <div class="row">
                                <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="orderDate" name="description" autocomplete="off" value="<?php echo $result['Description']?>" readonly />
                                    </div>
                                </div> 
                              </div>
                        <div></div><div></div>
                            <div class="form-group">
                                <div class="row">
                                <label class="col-sm-2 control-label">Length</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="length" autocomplete="off" value="<?php echo $result['Length']?>" readonly/>
          </div>
          <label class="col-sm-2 control-label">Front Neck</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="neck" autocomplete="off" value="<?php echo $result['Neck']?>" readonly/>
          </div>          
          <label class="col-sm-2 control-label">Pant Length</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="trlength" autocomplete="off" value="<?php echo $result['TrouserLength']?>" readonly/>
          </div>
          
          
        </div> 
      </div>
       <div class="form-group">
          <div class="row">
          <label class="col-sm-2 control-label">Chest</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="chest" autocomplete="off" value="<?php echo $result['Chest']?>" readonly/>
          </div>
          <label class="col-sm-2 control-label">Back Neck</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="back" autocomplete="off" value="<?php echo $result['Back']?>" readonly/>
          </div>
          <label class="col-sm-2 control-label">Pant High</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="lap" autocomplete="off" value="<?php echo $result['Lap']?>" readonly/>
          </div>
          
        </div> 
      </div>

 <div class="form-group">
          <div class="row">
          <label class="col-sm-2 control-label">Waist</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="waist" autocomplete="off" value="<?php echo $result['Waist']?>" readonly/>
          </div>
          <label class="col-sm-2 control-label">High Neck</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="ncollar" autocomplete="off" value="<?php echo $result['NeckCollar']?>" readonly/>
          </div>
          
          <label class="col-sm-2 control-label">Pant Cuff</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="shortlength" autocomplete="off" value="<?php echo $result['SSLength']?>" readonly/>
          </div>
          
        </div> 
      </div>
       <div class="form-group">
          <div class="row">
          <label class="col-sm-2 control-label">Hip</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="hip" autocomplete="off" value="<?php echo $result['Hip']?>" readonly/>
          </div>
          <label class="col-sm-2 control-label">Full Length</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="Tlength" autocomplete="off" value="<?php echo $result['TopLength']?>" readonly/>
          </div>
          
          <label class="col-sm-2 control-label">Pant Hip</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="shoulder" autocomplete="off" value="<?php echo $result['Shoulder']?>" readonly/>
          </div>
          
        </div> 
      </div>


      <div class="form-group">
          <div class="row">
          <label class="col-sm-2 control-label">Sleeve Length</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="longlength" autocomplete="off" value="<?php echo $result['LSLength']?>" readonly/>
          </div>
          <label class="col-sm-2 control-label">Armhole</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="ssas" autocomplete="off" value="<?php echo $result['SSAS']?>" readonly/>
          </div>
          
          <label class="col-sm-2 control-label">Borka Chest</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="WaistInch" autocomplete="off" value="<?php echo $result['WaistInches']?>" readonly/>
          </div>
        </div> 
     </div>
      <div class="form-group">
          <div class="row">
          <label class="col-sm-2 control-label">Sleeve Cuff</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="scuff" autocomplete="off" value="<?php echo $result['SleeveCuff']?>" readonly/>
          </div>
          <label class="col-sm-2 control-label">Blouse Chest</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="bottom" autocomplete="off" value="<?php echo $result['Bottom']?>" readonly/>
          </div>
          
          <label class="col-sm-2 control-label" style="color: green;"><b>Sewing Technician</b></label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="other" autocomplete="off" value="<?php echo $result['Other']?>" readonly/>
          </div>
                          </div> 
                      </div>
                          

                        
                            <input type="hidden" name="orderId" id="orderId" value="<?php echo $orderId; ?>" />

                            <!-- <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> -->
                              
                      </div>
                    </div>
                        </form>
                  </div>
              </div>
                        </div>
                                                            

                                                                 <input id ="printbtn" type="button" class="btn btn-success btn-flat m-b-30 m-t-30"  value="Print Invoice" onclick="window.print();" >
                            <input id ="printbtn" type="button" value="Go Back" class="btn btn-danger btn-flat m-b-30 m-t-30"  onclick="goBack()" >



                                
                                     </div>
                        </div>
                    </div>
                  
                </div>
                
               


<?php include('./constant/layout/footer.php');?>
 <script>
function goBack() {
  window.history.back();
}
</script>

