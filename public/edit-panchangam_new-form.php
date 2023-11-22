<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php

if (isset($_GET['id'])) {
    $ID = $db->escapeString($_GET['id']);
} else {
    // $ID = "";
    return false;
    exit(0);
}

if (isset($_POST['btnEdit'])) {

	$date = $db->escapeString(($_POST['date']));
	$sunrise= $db->escapeString($_POST['sunrise']);
	$sunset = $db->escapeString($_POST['sunset']);
	$moonrise = $db->escapeString($_POST['moonrise']);
	$moonset= $db->escapeString($_POST['moonset']);
	$week_date = $db->escapeString($_POST['week_date']);
	$kalam = $db->escapeString($_POST['kalam']);
	$thidhi = $db->escapeString($_POST['thidhi']);
	$nakshatram = $db->escapeString($_POST['nakshatram']);
	$yogam = $db->escapeString($_POST['yogam']);
	$karanam = $db->escapeString($_POST['karanam']);
	$abhijith_muhurtham = $db->escapeString($_POST['abhijith_muhurtham']);
	$bhrama_muhurtham = $db->escapeString($_POST['bhrama_muhurtham']);
	$amrutha_kalam = $db->escapeString($_POST['amrutha_kalam']);
	$rahukalam = $db->escapeString($_POST['rahukalam']);
	$yamakandam = $db->escapeString($_POST['yamakandam']);
	$dhurmuhurtham = $db->escapeString($_POST['dhurmuhurtham']);
	$varjyam = $db->escapeString($_POST['varjyam']);
	$gulika = $db->escapeString($_POST['gulika']);
	


	if (empty($date)) {
		$error['date'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($sunrise)) {
		$error['sunrise'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($sunset)) {
		$error['sunset'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($moonrise)) {
		$error['moonrise'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($moonset)) {
		$error['moonset'] = " <span class='label label-danger'>Required!</span>";
	}
	if (empty($week_date)) {
		$error['week_date'] = " <span class='label label-danger'>Required!</span>";
	}
	

	
   
   if (!empty($date) && !empty($sunrise) && !empty($sunset) && !empty($moonrise) && !empty($moonset) && !empty($week_date))
    {        
		    
			$sql_query = "UPDATE panchangam_new SET date = '$date',sunrise = '$sunrise',sunset = '$sunset',moonrise = '$moonrise',moonset = '$moonset',week_date = '$week_date',kalam = '$kalam',thidhi='$thidhi',nakshatram='$nakshatram',yogam='$yogam',karanam='$karanam',abhijith_muhurtham='$abhijith_muhurtham',bhrama_muhurtham='$bhrama_muhurtham',amrutha_kalam='$amrutha_kalam',rahukalam='$rahukalam',yamakandam='$yamakandam',dhurmuhurtham='$dhurmuhurtham',varjyam='$varjyam',gulika='$gulika' WHERE id = $ID";
			 $db->sql($sql_query);
			 $res = $db->getResult();
             $update_result = $db->getResult();
			if (!empty($update_result)) {
				$update_result = 0;
			} else {
				$update_result = 1;
			}

			// check update result
			if ($update_result == 1) {
				// for ($i = 0; $i < count($_POST['title']); $i++) {
				// 	$panchangam_id = $db->escapeString(($_POST['panchangam_variant_id'][$i]));
				// 	$title = $db->escapeString(($_POST['title'][$i]));
				// 	$description = $db->escapeString(($_POST['description'][$i]));
				// 	$sql = "UPDATE panchangam_variant SET title='$title',description='$description' WHERE id = $panchangam_id";
				// 	$db->sql($sql);

				// }
				// if (
				// 	isset($_POST['insert_title']) && isset($_POST['insert_description'])
				// ) {
				// 	for ($i = 0; $i < count($_POST['insert_title']); $i++) {
				// 		$title = $db->escapeString(($_POST['insert_title'][$i]));
				// 		$description = $db->escapeString(($_POST['insert_description'][$i]));
				// 		if (!empty($title) || !empty($description)) {
				// 			$sql = "INSERT INTO panchangam_variant (panchangam_id,title,description) VALUES('$ID','$title','$description')";
				// 			$db->sql($sql);

				// 		}


				// 	}

				// }

			$error['update_panchangam'] = " <section class='content-header'><span class='label label-success'>Panchangam New updated Successfully</span></section>";
			} else {
				$error['update_panchangam'] = " <span class='label label-danger'>Failed to update</span>";
			}
		}
	} 


// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM panchangam_new WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();


if (isset($_POST['btnCancel'])) { ?>
	<script>
		window.location.href = "panchangam_new.php";
	</script>
<?php } ?>
<section class="content-header">
	<h1>
		Edit Panchangam New<small><a href='panchangam_new.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Panchangam New</a></small></h1>
	<small><?php echo isset($error['update_panchangam']) ? $error['update_panchangam'] : ''; ?></small>
	<ol class="breadcrumb">
		<li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<!-- Main row -->

	<div class="row">
		<div class="col-md-12">
		
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
				</div>
				<div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>
				
				<!-- /.box-header -->
				<!-- form start -->
				<form id="edit_panchangam_form" method="post" enctype="multipart/form-data">
					<div class="box-body">
						   <div class="row">
							    <div class="form-group">
									<div class='col-md-6'>
									          <label for="exampleInputEmail1">Date</label> <i class="text-danger asterik">*</i>
											  <input type="date" class="form-control" name="date" value="<?php echo $res[0]['date']; ?>">
									</div>
								</div>
						   </div>
						   <br>
						   <div class="row">
							    <div class="form-group">
									 <div class="col-md-4">
										<label for="exampleInputEmail1">Sunrise</label><i class="text-danger asterik">*</i>
										<input type="time" class="form-control" name="sunrise" value="<?php echo $res[0]['sunrise']; ?>">
									 </div>
									 <div class="col-md-4">
										<label for="exampleInputEmail1">Sunset</label><i class="text-danger asterik">*</i>
										<input type="time" class="form-control" name="sunset" value="<?php echo $res[0]['sunset']; ?>">
									 </div>
								</div>
						   </div>
						   <br>
						   <div class="row">
							    <div class="form-group">
									 <div class="col-md-4">
										<label for="exampleInputEmail1">Moonrise</label><i class="text-danger asterik">*</i>
										<input type="time" class="form-control" name="moonrise" value="<?php echo $res[0]['moonrise']; ?>">
									 </div>
									 <div class="col-md-4">
										<label for="exampleInputEmail1">Moonset</label><i class="text-danger asterik">*</i>
										<input type="time" class="form-control" name="moonset" value="<?php echo $res[0]['moonset']; ?>">
									 </div>
								</div>
						   </div>
						   <br>
						   <div class="row">
							    <div class="form-group">
									 <div class="col-md-4">
										<label for="exampleInputEmail1">Week & Date</label><i class="text-danger asterik">*</i>
										<input type="text" class="form-control" name="week_date" value="<?php echo $res[0]['week_date']; ?>">
									 </div>
									 <div class="col-md-4">
										<label for="exampleInputEmail1">Kalam</label><i class="text-danger asterik">*</i>
										<input type="text" class="form-control" name="kalam" value="<?php echo $res[0]['kalam']; ?>">
									 </div>
								</div>
						   </div>
						   <br>
						   <div class="row">
                                <div class="form-group">
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Thidhi</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="thidhi" value="<?php echo $res[0]['thidhi']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Nakshathram</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="nakshatram" value="<?php echo $res[0]['nakshatram']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Yogam</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="yogam" value="<?php echo $res[0]['yogam']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1"> Karanam</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="karanam" value="<?php echo $res[0]['karanam']; ?>">
                                    </div>
                                 </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-md-3">
                                            <label for="exampleInputEmail1">Amrutha Kalam</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="amrutha_kalam" value="<?php echo $res[0]['amrutha_kalam']; ?>">
                                    </div>
								   <div class="col-md-3">
                                            <label for="exampleInputEmail1"> Abhijith Muhurtham</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="abhijith_muhurtham"  value="<?php echo $res[0]['abhijith_muhurtham']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Bhrama Muhurtham</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="bhrama_muhurtham"  value="<?php echo $res[0]['bhrama_muhurtham']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Rahukalam</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="rahukalam" value="<?php echo $res[0]['rahukalam']; ?>">
                                    </div>
                                 </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
								    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Yamagandam</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="yamakandam" value="<?php echo $res[0]['yamakandam']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Gulika</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="gulika" value="<?php echo $res[0]['gulika']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1"> Dhurmuhurtham</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="dhurmuhurtham" value="<?php echo $res[0]['dhurmuhurtham']; ?>">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Varjyam</label> <i class="text-danger asterik">*</i>
                                            <input type="text" class="form-control" name="varjyam" value="<?php echo $res[0]['varjyam']; ?>">
                                    </div>
                                 </div>
                            </div>
							<br>
							
					</div><!-- /.box-body -->
                       
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
<!-- <script>
    $(document).ready(function () {
        var max_fields = 7;
        var wrapper = $("#packate_div");
        var add_button = $("#add_packate_variation");

        var x = 1;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
				$(wrapper).append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="title">Title</label>' +'<input type="text" class="form-control" name="insert_title[]" /></div></div>'+'<div class="col-md-4"><div class="form-group"><label for="description">Description</label>'+'<textarea type="text" rows="2" class="form-control" name="insert_description[]"></textarea></div></div>'+'<div class="col-md-1" style="display:grid;"><label>Tab</label><a class="remove text-danger" style="cursor:pointer;color:white;"><button class="btn btn-danger">Remove</button></a></div>'+'</div>');
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
                var id = $(this).closest('div.row').find("input[id='panchangam_variant_id']").val();
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
</script> -->

