<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

if (isset($_GET['id'])) {
    $ID = $db->escapeString($_GET['id']);
} else {
    echo "ID is required";
    exit();
}

if (isset($_POST['btnEdit'])) {

    $title = $db->escapeString($_POST['title']);
    $description = $db->escapeString($_POST['description']);

    if (empty($title)) {
        $error['title'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($description)) {
        $error['description'] = " <span class='label label-danger'>Required!</span>";
    }

    if (!empty($title) && !empty($description)) {
        $sql_query = "UPDATE pushkaralu SET title='$title', description='$description' WHERE id = $ID";
        $db->sql($sql_query);
        $update_result = $db->getResult();
        
        if (empty($update_result)) {
            $update_result = 1;
        } else {
            $update_result = 0;
        }

        	// check update result
            if ($update_result == 1)
            {
                for ($i = 0; $i < count($_POST['sub_title']); $i++) {
                    $pushkaralu_id = $db->escapeString(($_POST['pushkaralu_variant_id'][$i]));
                    $sub_title = $db->escapeString(($_POST['sub_title'][$i]));
                    $sub_description = $db->escapeString(($_POST['sub_description'][$i]));
                    $sql = "UPDATE pushkaralu_variant SET sub_title='$sub_title',sub_description='$sub_description' WHERE id =$pushkaralu_id";
                    $db->sql($sql);

                }
                if (
                    isset($_POST['insert_sub_title']) && isset($_POST['insert_sub_description'])
                ) {
                    for ($i = 0; $i < count($_POST['insert_sub_title']); $i++) {
                        $sub_title = $db->escapeString(($_POST['insert_sub_title'][$i]));
                        $sub_description = $db->escapeString(($_POST['insert_sub_description'][$i]));
                        if (!empty($sub_title) || !empty($sub_description)) {
                            $sql = "INSERT INTO pushkaralu_variant (pushkaralu_id,sub_title,sub_description) VALUES('$ID','$sub_title','$sub_description')";
                            $db->sql($sql);

                        }
                    }
                }
                    $error['update_pushkaralu'] = " <section class='content-header'><span class='label label-success'>Pushkaralu updated Successfully</span></section>";
            } else {
                $error['update_pushkaralu'] = " <span class='label label-danger'>Failed to update</span>";
            }
            }
    } 

// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM pushkaralu WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();

$sql_query = "SELECT * FROM pushkaralu_variant WHERE pushkaralu_id = $ID";
$db->sql($sql_query);
$resslot = $db->getResult();

if (isset($_POST['btnCancel'])) { ?>
    <script>
        window.location.href = "pushkaralu.php";
    </script>
<?php } ?>

<section class="content-header">
    <h1>
        Edit Pushkaralu<small><a href='pushkaralu.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Pushkaralu</a></small></h1>
    <small><?php echo isset($error['update_pushkaralu']) ? $error['update_pushkaralu'] : ''; ?></small>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border"></div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>
                <form id="edit_pushkaralu_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Title</label><i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="title" value="<?php echo $res[0]['title']; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1">Description</label><i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="description" value="<?php echo $res[0]['description']; ?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div id="variations">
							<?php
							$i=0;
							foreach ($resslot as $row) {
								?>
								<div id="packate_div">
									<div class="row">
									    <input type="hidden" class="form-control" name="pushkaralu_variant_id[]" id="pushkaralu_variant_id" value='<?= $row['id']; ?>' />
									    <div class="col-md-4">
											<div class="form-group packate_div">
												<label for="exampleInputEmail1">sub_title</label> <i class="text-danger asterik">*</i>
												<input type="text" class="form-control" name="sub_title[]" value="<?php echo $row['sub_title'] ?>" />
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group packate_div">
												<label for="exampleInputEmail1"> sub_description</label> <i class="text-danger asterik">*</i>
												<textarea type="text" rows="2" class="form-control" name="sub_description[]"><?php echo $row['sub_description'] ?></textarea>
											</div>
										</div>

										<?php if ($i == 0) { ?>
												<div class='col-md-1'>
													<label>Tab</label>
													<a id="add_packate_variation" title='Add variation' style='cursor: pointer;color:white;'><button class="btn btn-warning">Add more</button></a>
												</div>
											<?php } else { ?>
												<div class="col-md-1">
													<label>Tab</label>
													<a class="remove_variation text-danger" data-id="data_delete" title="Remove variation of pushkaralu" style="cursor: pointer;color:white;"><button class="btn btn-danger">Remove</button></a>
												</div>
											<?php } ?>
									</div>
								</div>
								<?php $i++; 
							} ?> 
						
						</div>
						<!-- /.box-body -->
                       
					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="btnEdit">Update</button>					
					</div>
				</form>
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>

<div class="separator"> </div>
<?php $db->disconnect(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var max_fields = 7;
        var wrapper = $("#packate_div");
        var add_button = $("#add_packate_variation");

        var x = 1;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
				$(wrapper).append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="sub_title">sub_title</label>' +'<input type="text" class="form-control" name="insert_sub_title[]" /></div></div>'+'<div class="col-md-4"><div class="form-group"><label for="sub_description">sub_description</label>'+'<textarea type="text" rows="2" class="form-control" name="insert_sub_description[]"></textarea></div></div>'+'<div class="col-md-1" style="display:grid;"><label>Tab</label><a class="remove text-danger" style="cursor:pointer;color:white;"><button class="btn btn-danger">Remove</button></a></div>'+'</div>');
            } else {
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
<script>
    $(document).on('click', '.remove_variation', function() {
        if ($(this).data('id') == 'data_delete') {
            if (confirm('Are you sure? Want to delete this row')) {
                var id = $(this).closest('div.row').find("input[id='pushkaralu_variant_id']").val();
                $.ajax({
                    url: 'public/db-operation.php',
                    type: "post",
                    data: 'id=' + id + '&delete_variant=1',
                    success: function(result) {
                        if (result) {
                            location.reload();
                        } else {
                            alert("Variant not deleted!");
                        }
                    }
                });
            }
        } else {
            $(this).closest('.row').remove();
        }
    });
</script>

