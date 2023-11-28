<?php
include_once('includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

if (isset($_GET['id'])) {
    $ID = $db->escapeString($fn->xss_clean($_GET['id']));
} else {
    // $ID = "";
    return false;
    exit(0);
}

if (isset($_POST['btnUpdate'])) {
    $error = array();
    $date = $db->escapeString($fn->xss_clean($_POST['date']));
    $year_name = $db->escapeString($fn->xss_clean($_POST['year_name']));
    $week_name = $db->escapeString($fn->xss_clean($_POST['week_name']));
    $good_timings = $db->escapeString($fn->xss_clean($_POST['good_timings']));

    $sql = "UPDATE slider SET date='$date',year_name='$year_name',week_name='$week_name',good_timings='$good_timings' WHERE id = '$ID'";
    $db->sql($sql);
    $categories_result = $db->getResult();
    if (!empty($categories_result)) {
        $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
    } else {
        $error['add_menu'] = " <span class='label label-success'>Slider - 1 Data Updated Successfully</span>";
    }
    
}

$data = array();

$sql_query = "SELECT * FROM `slider` WHERE id = '$ID'";
$db->sql($sql_query);
$res = $db->getResult();
foreach ($res as $row)
$data = $row;

?>
<section class="content-header">
    <h1>Edit Slider - 1 Data<small><a href='slider.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Slider - 1 Data</a></small></h1>
    <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>

</section>
<section class="content">
    <div class="row">
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='edit_rashi_form' method="post" enctype="multipart/form-data">
                <div class="box-body">
                            <div class="row">
                                <div class="form-group">
                                <div class='col-md-6'>
                                    <label for="exampleInputEmail1"> Date</label> <i class="text-danger asterik">*</i>
                                    <input type="date" class="form-control" name="date"  value="<?php echo $res[0]['date']; ?>">
                                </div>
                                <div class='col-md-6'>
                                    <label for="exampleInputEmail1"> Year Name</label> <i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="year_name"  value="<?php echo $res[0]['year_name']; ?>">
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class='col-md-6'>
                                    <label for="exampleInputEmail1"> week Name</label> <i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="week_name"  value="<?php echo $res[0]['week_name']; ?>">
                                </div>
                                <div class='col-md-6'>
                                    <label for="exampleInputEmail1"> Good Timings</label> <i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="good_timings"  value="<?php echo $res[0]['good_timings']; ?>">
                                </div>
                            </div>
                            </div>
                            
         
                    </div>
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Update" name="btnUpdate" />&nbsp;
                        <!-- <input type="reset" class="btn-danger btn" value="Clear" id="btnClear" /> -->
                        <!--<div  id="res"></div>-->
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<div class="separator"> </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>