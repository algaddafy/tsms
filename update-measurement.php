<?php
include('./constant/layout/head.php');
include('./constant/layout/header.php');
include('./constant/layout/sidebar.php');
include('./constant/connect.php');

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    $sql = "SELECT * FROM measurement WHERE order_id = '" . $orderId . "'";
    $result = $connect->query($sql)->fetch_assoc();
}

if (isset($_POST['update_measurement'])) {
  // Retrieve form data
  $date = $_POST['date'];
  $description = $_POST['description'];
  $length = $_POST['length'];
  $neck = $_POST['neck'];
  $trlength = $_POST['trlength'];
  $chest = $_POST['chest'];
  $back = $_POST['back'];
  $lap = $_POST['lap'];
  $waist = $_POST['waist'];
  $ncollar = $_POST['ncollar'];
  $shortlength = $_POST['shortlength'];
  $hip = $_POST['hip'];
  $Tlength = $_POST['Tlength'];
  $shoulder = $_POST['shoulder'];
  $longlength = $_POST['longlength'];
  $ssas = $_POST['ssas'];
  $WaistInch = $_POST['WaistInch'];
  $scuff = $_POST['scuff'];
  $bottom = $_POST['bottom'];
  $other = $_POST['other'];

  // Perform SQL update
  $updateSql = "UPDATE measurement SET
      Date = '$date',
      Description = '$description',
      Length = '$length',
      Neck = '$neck',
      TrouserLength = '$trlength',
      Chest = '$chest',
      Back = '$back',
      Lap = '$lap',
      Waist = '$waist',
      NeckCollar = '$ncollar',
      SSLength = '$shortlength',
      Hip = '$hip',
      TopLength = '$Tlength',
      Shoulder = '$shoulder',
      LSLength = '$longlength',
      SSAS = '$ssas',
      WaistInches = '$WaistInch',
      SleeveCuff = '$scuff',
      Bottom = '$bottom',
      Other = '$other'
      WHERE order_id = '$orderId'";

  if ($connect->query($updateSql) === TRUE) { ?>
<script>window.location.href = 'Order.php'; </script>
  <?php
      // Redirect to the measurement view page or show a success message
        } else {
      echo "Error: " . $updateSql . "<br>" . $connect->error;
  }
}
?> 

 
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
                                  <input type="text" value="<?php echo $result['Date']?>" class="form-control" name="date" autocomplete="off"  />
                                </div>
                              </div> 
                            </div>
                            <div class="form-group">
                                <div class="row">
                                <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" name="description" autocomplete="off" value="<?php echo $result['Description']?>"  />
                                    </div>
                                </div> 
                              </div>
                        <div></div><div></div>
                        <div class="form-group">
          <div class="row">
          <label class="col-sm-2 control-label">Length</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="length" autocomplete="off" value="<?php echo $result['Length']?>" />
          </div>
          <label class="col-sm-2 control-label">Front Neck</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="neck" autocomplete="off" value="<?php echo $result['Neck']?>" />
          </div>          
          <label class="col-sm-2 control-label">Pant Length</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="trlength" autocomplete="off" value="<?php echo $result['TrouserLength']?>" />
          </div>
          
          
        </div> 
      </div>
       <div class="form-group">
          <div class="row">
          <label class="col-sm-2 control-label">Chest</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="chest" autocomplete="off" value="<?php echo $result['Chest']?>" />
          </div>
          <label class="col-sm-2 control-label">Back Neck</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="back" autocomplete="off" value="<?php echo $result['Back']?>" />
          </div>
          <label class="col-sm-2 control-label">Pant High</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="lap" autocomplete="off" value="<?php echo $result['Lap']?>" />
          </div>
          
        </div> 
      </div>

 <div class="form-group">
          <div class="row">
          <label class="col-sm-2 control-label">Waist</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="waist" autocomplete="off" value="<?php echo $result['Waist']?>" />
          </div>
          <label class="col-sm-2 control-label">High Neck</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="ncollar" autocomplete="off" value="<?php echo $result['NeckCollar']?>" />
          </div>
          
          <label class="col-sm-2 control-label">Pant Cuff</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="shortlength" autocomplete="off" value="<?php echo $result['SSLength']?>" />
          </div>
          
        </div> 
      </div>
       <div class="form-group">
          <div class="row">
          <label class="col-sm-2 control-label">Hip</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="hip" autocomplete="off" value="<?php echo $result['Hip']?>" />
          </div>
          <label class="col-sm-2 control-label">Full Length</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="Tlength" autocomplete="off" value="<?php echo $result['TopLength']?>" />
          </div>
          
          <label class="col-sm-2 control-label">Pant Hip</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="shoulder" autocomplete="off" value="<?php echo $result['Shoulder']?>" />
          </div>
          
        </div> 
      </div>


      <div class="form-group">
          <div class="row">
          <label class="col-sm-2 control-label">Sleeve Length</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="longlength" autocomplete="off" value="<?php echo $result['LSLength']?>" />
          </div>
          <label class="col-sm-2 control-label">Armhole</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="ssas" autocomplete="off" value="<?php echo $result['SSAS']?>" />
          </div>
          
          <label class="col-sm-2 control-label">Borka Chest</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="WaistInch" autocomplete="off" value="<?php echo $result['WaistInches']?>" />
          </div>
        </div> 
     </div>
      <div class="form-group">
          <div class="row">
          <label class="col-sm-2 control-label">Sleeve Cuff</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="scuff" autocomplete="off" value="<?php echo $result['SleeveCuff']?>" />
          </div>
          <label class="col-sm-2 control-label">Blouse Chest</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="bottom" autocomplete="off" value="<?php echo $result['Bottom']?>" />
          </div>
          
          <label class="col-sm-2 control-label" style="color: green;"><b>Sewing Technician</b></label>
            <div class="col-sm-2">
            <input type="text" class="form-control" name="other" autocomplete="off" value="<?php echo $result['Other']?>" />
          </div>
        </div> 
     </div>
        

       
          <input type="hidden" name="orderId" id="orderId" value="<?php echo $orderId; ?>" />


                    <button type="submit" name="update_measurement" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Update Changes</button>
                        </form>
                  </div>
              </div>
          </div>
      </div>

  </div>
</div>
                
               


<?php include('./constant/layout/footer.php');?>