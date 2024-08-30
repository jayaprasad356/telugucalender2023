<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

$date = new DateTime;
$date->format('h:i:s a');

?>
<?php
if (isset($_POST['btnAdd'])) {

    $title = $db->escapeString(($_POST['title']));
    $description = $db->escapeString($_POST['description']);

    if (empty($title)) {
        $error['title'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($description)) {
        $error['description'] = " <span class='label label-danger'>Required!</span>";
    }

    if (!empty($title) && !empty($description)) {

        $sql_query = "INSERT INTO pushkaralu (title,description)VALUES('$title','$description')";
        $db->sql($sql_query);
        $result = $db->getResult();
        if (!empty($result)) {
            $result = 0;
        } else {
            $result = 1;
        }

        if ($result == 1) {
            $sql = "SELECT id FROM pushkaralu ORDER BY id DESC LIMIT 1";
            $db->sql($sql);
            $res = $db->getResult();
            $pushkaralu_id = $res[0]['id'];

            // Update this loop to handle sub_title and sub_description
            for ($i = 0; $i < count($_POST['sub_title']); $i++) {

                $sub_title = $db->escapeString(($_POST['sub_title'][$i]));
                $sub_description = $db->escapeString(($_POST['sub_description'][$i]));
                $sql = "INSERT INTO pushkaralu_variant (pushkaralu_id, sub_title, sub_description) VALUES('$pushkaralu_id','$sub_title','$sub_description')";
                $db->sql($sql);
                $pushkaralu_variant_result = $db->getResult();
            }
            if (!empty($pushkaralu_variant_result)) {
                $pushkaralu_variant_result = 0;
            } else {
                $pushkaralu_variant_result = 1;
            }

            $error['add_pushkaralu'] = "<section class='content-header'>
                                            <span class='label label-success'>Pushkaralu Added Successfully</span> </section>";
        } else {
            $error['add_pushkaralu'] = " <span class='label label-danger'>Failed</span>";
        }
    }
}

?>
<section class="content-header">
    <h1>Add Pushkaralu <small><a href='pushkaralu.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Pushkaralu</a></small></h1>

    <?php echo isset($error['add_pushkaralu']) ? $error['add_pushkaralu'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
           
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">

                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form name="add_product" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Title</label> <i class="text-danger asterik">*</i><?php echo isset($error['title']) ? $error['title'] : ''; ?>
                                            <input type="text" class="form-control" name="title" required>
                                    </div>
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Description</label> <i class="text-danger asterik">*</i><?php echo isset($error['description']) ? $error['description'] : ''; ?>
                                            <input type="text" class="form-control" name="description" required>
                                    </div>

                                 </div>
                            </div>
                            <br>
                            <div id="packate_div"  >
                                <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group packate_div">
                                            <label for="exampleInputEmail1">Sub Title</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="sub_title[]" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group packate_div">
                                            <label for="exampleInputEmail1">Sub Description</label> <i class="text-danger asterik">*</i>
                                            <textarea type="text" rows="2" class="form-control" name="sub_description[]" required></textarea>
                                        </div>
                                    </div>

                                
                                    <div class="col-md-1">
                                        <label>Tab</label>
                                        <a class="add_packate_variation" title="Add variation of pushkaralu" style="cursor: pointer;color:white;"><button class="btn btn-warning">Add more</button></a>
                                    </div>
                                    <div id="variations">
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
    $('#add_pushkaralu').validate({

        ignore: [],
        debug: false,
        rules: {
            date: "required",
            sunrise: "required",
            sunset: "required",
        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
   $(document).ready(function () {
    var max_fields = 8;
    var wrapper = $("#packate_div");
    var add_button = $(".add_packate_variation");

    var x = 1;
    $(add_button).click(function (e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="sub_title">Sub Title</label>' +'<input type="text" class="form-control" name="sub_title[]" required /></div></div>' + '<div class="col-md-4"><div class="form-group"><label for="sub_description">Sub Description</label>'+'<textarea type="text" row="2" class="form-control" name="sub_description[]" required></textarea></div></div>'+'<div class="col-md-1" style="display: grid;"><label>Tab</label><a class="remove" style="cursor:pointer;color:white;"><button class="btn btn-danger">Remove</button></a></div>'+'</div>');
        }
        else{
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".remove", function (e) {
        e.preventDefault();
        $(this).closest('.row').remove();
        x--;
    })
});

</script>

<!--code for page clear-->
<script>
    function refreshPage(){
    window.location.reload();
} 
</script>

<?php $db->disconnect(); ?>