<?php include('./constant/layout/head.php');?>
<?php include('./constant/layout/header.php');?>

<?php include('./constant/layout/sidebar.php');?>   
<link rel="stylesheet" href="custom/js/order.js">

<?php include('./constant/connect.php');?>

 <?php
 $orderId = $_GET['id'];
$sql="SELECT * from measurement where order_id='".$orderId."'";
  $result=$connect->query($sql)->fetch_assoc();  ?> 

 
<div class="page-wrapper">
  
  <div class="row page-titles">
      <div class="col-md-5 align-self-center">
          <h3 class="text-primary">View Measurement</h3> </div>
      <div class="col-md-7 align-self-center">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item active">View Measurement</li>
          </ol>
      </div>
  </div>
  
  
  <div class="container-fluid">
        
        
        
        
      <div class="row">
          <div class="col-lg-11" style="    margin-left: 5%;">
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
      </div>

  </div>
</div>
                
               


<?php include('./constant/layout/footer.php');?>



