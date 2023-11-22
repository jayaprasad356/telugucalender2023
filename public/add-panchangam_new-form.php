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

        $date = $db->escapeString(($_POST['date']));
        $sunrise= $db->escapeString($_POST['sunrise']);
        $sunset = $db->escapeString($_POST['sunset']);
        $moonrise = $db->escapeString($_POST['moonrise']);
        $moonset= $db->escapeString($_POST['moonset']);
        $kalam = $db->escapeString($_POST['kalam']);
        $week_date= $db->escapeString($_POST['week_date']);
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
     
        if (empty($kalam)) {
            $error['kalam'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($week_date)) {
            $error['week_date'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($thidhi)) {
            $error['thidhi'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($nakshatram)) {
            $error['nakshatram'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($yogam)) {
            $error['yogam'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($karanam)) {
            $error['karanam'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($abhijith_muhurtham)) {
            $error['abhijith_muhurtham'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($bhrama_muhurtham)) {
            $error['bhrama_muhurtham'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($amrutha_kalam)) {
            $error['amrutha_kalam'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($rahukalam)) {
            $error['rahukalam'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($yamakandam)) {
            $error['yamakandam'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($dhurmuhurtham)) {
            $error['dhurmuhurtham'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($varjyam)) {
            $error['varjyam'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($gulika)) {
            $error['gulika'] = " <span class='label label-danger'>Required!</span>";
        }
        // if (empty($hc1)) {
        //     $error['hc1'] = " <span class='label label-danger'>Required!</span>";
        // }
        // if (empty($hc2)) {
        //     $error['hc2'] = " <span class='label label-danger'>Required!</span>";
        // }
        // if (empty($hc3)) {
        //     $error['hc3'] = " <span class='label label-danger'>Required!</span>";
        // }
        // if (empty($hc4)) {
        //     $error['hc4'] = " <span class='label label-danger'>Required!</span>";
        // }
        // if (empty($hc5)) {
        //     $error['hc5'] = " <span class='label label-danger'>Required!</span>";
        // }
        // if (empty($hc6)) {
        //     $error['hc6'] = " <span class='label label-danger'>Required!</span>";
        // }
        // if (empty($hc7)) {
        //     $error['hc7'] = " <span class='label label-danger'>Required!</span>";
        // }
        // if (empty($hc8)) {
        //     $error['hc8'] = " <span class='label label-danger'>Required!</span>";
        // }
        // if (empty($hc9)) {
        //     $error['hc9'] = " <span class='label label-danger'>Required!</span>";
        // }
        // if (empty($hc10)) {
        //     $error['hc10'] = " <span class='label label-danger'>Required!</span>";
        // }
        // if (empty($hc11)) {
        //     $error['hc11'] = " <span class='label label-danger'>Required!</span>";
        // }
        // if (empty($hc12)) {
        //     $error['hc12'] = " <span class='label label-danger'>Required!</span>";
        // }



       
       
       if (!empty($date) && !empty($sunrise) && !empty($sunset) && !empty($moonrise) && !empty($moonset) && !empty($week_date)&& !empty($kalam) && !empty($thidhi) && !empty($nakshatram) && !empty($yogam) && !empty($karanam) && !empty($amrutha_kalam) && !empty($rahukalam) && !empty($yamakandam) && !empty($dhurmuhurtham) && !empty($varjyam) && !empty($gulika)) {
         
            $sql = "SELECT * FROM panchangam_new WHERE date = '$date'";
            $db->sql($sql);
            $res = $db->getResult();
            $num = $db->numRows($res);
            if ($num >= 1){   
                $error['add_panchangam'] = " <span class='label label-danger'>Panchangam already in this date</span>";
            }
            else{
                $sql_query = "INSERT INTO panchangam_new (date,sunrise,sunset,moonrise,moonset,week_date,kalam,thidhi,nakshatram,yogam,karanam,abhijith_muhurtham,bhrama_muhurtham,amrutha_kalam,rahukalam,yamakandam,dhurmuhurtham,varjyam,gulika) VALUES ('$date','$sunrise','$sunset','$moonrise','$moonset','$week_date','$kalam','$thidhi','$nakshatram','$yogam','$karanam','$abhijith_muhurtham','$bhrama_muhurtham','$amrutha_kalam','$rahukalam','$yamakandam','$dhurmuhurtham','$varjyam','$gulika')";
                $db->sql($sql_query);
                $result = $db->getResult();
                if (!empty($result)) {
                    $result = 0;
                } else {
                    $result = 1;
                }
    
                if ($result == 1) {
                    // $sql = "SELECT id FROM panchangam ORDER BY id DESC LIMIT 1";
                    // $db->sql($sql);
                    // $res = $db->getResult();
                    // $panchangam_id = $res[0]['id'];
                    // for ($i = 0; $i < count($_POST['title']); $i++) {
        
                    //     $title = $db->escapeString(($_POST['title'][$i]));
                    //     $description = $db->escapeString(($_POST['description'][$i]));
                    //     $sql = "INSERT INTO panchangam_variant (panchangam_id,title,description) VALUES('$panchangam_id','$title','$description')";
                    //     $db->sql($sql);
                    //     $panchangam_variant_result = $db->getResult();
                    // }
                    // if (!empty($panchangam_variant_result)) {
                    //     $panchangam_variant_result = 0;
                    // } else {
                    //     $panchangam_variant_result = 1;
                    // }
                    
                    $error['add_panchangam'] = "<section class='content-header'>
                                                    <span class='label label-success'>Panchangam New Added Successfully</span> </section>";
                } else {
                    $error['add_panchangam'] = " <span class='label label-danger'>Failed</span>";
                }
                }
                
            }

        }
?>
<section class="content-header">
    <h1>Add Panchangam New <small><a href='panchangam_new.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Panchangam New</a></small></h1>

    <?php echo isset($error['add_panchangam']) ? $error['add_panchangam'] : ''; ?>
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
                                     <div class="col-md-6">
                                            <label for="exampleInputEmail1">Date</label> <i class="text-danger asterik">*</i><?php echo isset($error['date']) ? $error['date'] : ''; ?>
                                            <input type="date" class="form-control" name="date" required>
                                    </div>
                                </div>
                            </div>
                             <br>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Sunrise</label> <i class="text-danger asterik">*</i><?php echo isset($error['sunrise']) ? $error['sunrise'] : ''; ?>
                                            <input type="time" class="form-control" name="sunrise" required>
                                    </div>
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Sunset</label> <i class="text-danger asterik">*</i><?php echo isset($error['sunset']) ? $error['sunset'] : ''; ?>
                                            <input type="time" class="form-control" name="sunset" required>
                                    </div>

                                 </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Moonrise</label> <i class="text-danger asterik">*</i><?php echo isset($error['moonrise']) ? $error['moonrise'] : ''; ?>
                                            <input type="time" class="form-control" name="moonrise" required>
                                    </div>
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Moonset</label> <i class="text-danger asterik">*</i><?php echo isset($error['moonset']) ? $error['moonset'] : ''; ?>
                                            <input type="time" class="form-control" name="moonset" required>
                                    </div>

                                 </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Week & Date</label> <i class="text-danger asterik">*</i><?php echo isset($error['week_date']) ? $error['week_date'] : ''; ?>
                                            <input type="text" class="form-control" name="week_date" required>
                                    </div>
                                    <div class="col-md-4">
                                            <label for="exampleInputEmail1">Kalam</label> <i class="text-danger asterik">*</i><?php echo isset($error['kalam']) ? $error['kalam'] : ''; ?>
                                            <input type="text" class="form-control" name="kalam" required>
                                    </div>

                                 </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Thidhi</label> <i class="text-danger asterik">*</i><?php echo isset($error['thidhi']) ? $error['thidhi'] : ''; ?>
                                            <input type="text" class="form-control" name="thidhi">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Nakshatram</label> <i class="text-danger asterik">*</i><?php echo isset($error['nakshatram']) ? $error['nakshatram'] : ''; ?>
                                            <input type="text" class="form-control" name="nakshatram">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Yogam</label> <i class="text-danger asterik">*</i><?php echo isset($error['yogam']) ? $error['yogam'] : ''; ?>
                                            <input type="text" class="form-control" name="yogam">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1"> Karanam</label> <i class="text-danger asterik">*</i><?php echo isset($error['karanam']) ? $error['karanam'] : ''; ?>
                                            <input type="text" class="form-control" name="karanam">
                                    </div>
                                 </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-md-3">
                                            <label for="exampleInputEmail1">Amrutha Kalam</label> <i class="text-danger asterik">*</i><?php echo isset($error['amrutha_kalam']) ? $error['amrutha_kalam'] : ''; ?>
                                            <input type="text" class="form-control" name="amrutha_kalam">
                                    </div>
                                   <div class="col-md-3">
                                            <label for="exampleInputEmail1"> Abhijith Muhurtham</label> <i class="text-danger asterik">*</i><?php echo isset($error['abhijith_muhurtham']) ? $error['abhijith_muhurtham'] : ''; ?>
                                            <input type="text" class="form-control" name="abhijith_muhurtham">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Bhrama Muhurtham</label> <i class="text-danger asterik">*</i><?php echo isset($error['bhrama_muhurtham
']) ? $error['bhrama_muhurtham'] : ''; ?>
                                            <input type="text" class="form-control" name="bhrama_muhurtham">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Rahukalam</label> <i class="text-danger asterik">*</i><?php echo isset($error['rahukalam']) ? $error['rahukalam'] : ''; ?>
                                            <input type="text" class="form-control" name="rahukalam">
                                    </div>
                                 </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Yamakandam</label> <i class="text-danger asterik">*</i><?php echo isset($error['yamakandam']) ? $error['yamakandam'] : ''; ?>
                                            <input type="text" class="form-control" name="yamakandam">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Gulika</label> <i class="text-danger asterik">*</i><?php echo isset($error['gulika']) ? $error['gulika'] : ''; ?>
                                            <input type="text" class="form-control" name="gulika">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1"> Dhurmuhurtham</label> <i class="text-danger asterik">*</i><?php echo isset($error['dhurmuhurtham']) ? $error['dhurmuhurtham'] : ''; ?>
                                            <input type="text" class="form-control" name="dhurmuhurtham">
                                    </div>
                                    <div class="col-md-3">
                                            <label for="exampleInputEmail1">Varjyam</label> <i class="text-danger asterik">*</i><?php echo isset($error['varjyam']) ? $error['varjyam'] : ''; ?>
                                            <input type="text" class="form-control" name="varjyam">
                                    </div>
                                 </div>
                            </div>
                            <br>
                       

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
    $('#add_panchangam').validate({

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
                $(wrapper).append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="title">Title</label>' +'<input type="text" class="form-control" name="title[]" required /></div></div>' + '<div class="col-md-4"><div class="form-group"><label for="description">Description</label>'+'<textarea type="text" row="2" class="form-control" name="description[]" required></textarea></div></div>'+'<div class="col-md-1" style="display: grid;"><label>Tab</label><a class="remove" style="cursor:pointer;color:white;"><button class="btn btn-danger">Remove</button></a></div>'+'</div>');
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