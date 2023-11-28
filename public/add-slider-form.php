<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

?>
<?php
if (isset($_POST['btnAdd'])) {
        $date= $db->escapeString($_POST['date']);
        $year_name= $db->escapeString($_POST['year_name']);
        $week_name= $db->escapeString($_POST['week_name']);
        $good_timings= $db->escapeString($_POST['good_timings']);
       
        if (empty($rashi)) {
            $error['rashi'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($year_name)) {
            $error['year_name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($week_name)) {
            $error['week_name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($good_timings)) {
            $error['good_timings'] = " <span class='label label-danger'>Required!</span>";
        }
       
       
       if (!empty($date) && !empty($year_name) && !empty($week_name) && !empty($good_timings) ) {
         
            $sql_query = "INSERT INTO slider (date,year_name,week_name,good_timings)VALUES('$date','$year_name','$week_name','$good_timings')";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                
                $error['add_rashi'] = "<section class='content-header'>
                                                <span class='label label-success'>Slider - 1 Data  Added Successfully</span> </section>";
            } else {
                $error['add_rashi'] = " <span class='label label-danger'>Failed</span>";
            }
            }
        }
?>
<section class="content-header">
    <h1>Add Slider - 1 Data <small><a href='slider.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Slider - 1 Data </a></small></h1>

    <?php echo isset($error['add_rashi']) ? $error['add_rashi'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-10">
           
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">

                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form name="add_rashi_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                            <div class="row">
                                <div class="form-group">
                                <div class='col-md-6'>
                                    <label for="exampleInputEmail1"> Date</label> <i class="text-danger asterik">*</i><?php echo isset($error['date']) ? $error['date'] : ''; ?>
                                    <input type="date" class="form-control" name="date" id = "date" required>
                                </div>
                                <div class='col-md-6'>
                                    <label for="exampleInputEmail1"> Year Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['year_name']) ? $error['year_name'] : ''; ?>
                                    <input type="text" class="form-control" name="year_name" id = "year_name" required>
                                </div>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class='col-md-6'>
                                    <label for="exampleInputEmail1"> week Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['week_name']) ? $error['week_name'] : ''; ?>
                                    <input type="text" class="form-control" name="week_name" id = "week_name" required>
                                </div>
                                <div class='col-md-6'>
                                    <label for="exampleInputEmail1"> Good Timings</label> <i class="text-danger asterik">*</i><?php echo isset($error['good_timings']) ? $error['good_timings'] : ''; ?>
                                    <input type="text" class="form-control" name="good_timings" id = "good_timings" required>
                                </div>
                            </div>
                            </div>
                            
         
                    </div>
                  
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnAdd">Add</button>
                        <input type="reset" onClick="refreshPage()" class="btn-warning btn" value="Clear" />
                    </div>

                </form>

            </div><!-- /.box -->
        </div>
    </div>
</section>

<div class="separator"> </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
    $('#add_rashi_form').validate({

        ignore: [],
        debug: false,
        rules: {
            rashi: "required",
        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>

<!--code for page clear-->
<script>
    function refreshPage(){
    window.location.reload();
} 
</script>

<?php $db->disconnect(); ?>