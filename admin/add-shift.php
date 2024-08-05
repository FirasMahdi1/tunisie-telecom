<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
    
      
    if(isset($_REQUEST['add-shift']))
    {
      
      
      $start_time = $_REQUEST['starttime'];
      $end_time = $_REQUEST['endtime'];
      $status = $_REQUEST['status'];

      
      $insert_query = mysqli_query($connection, "insert into tbl_shift set start_time='$start_time', end_time='$end_time', status='$status'");

      if($insert_query>0)
      {
          $msg = "Shift created successfully";
      }
      else
      {
          $msg = "Error!";
      }
    }
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 ">
                        <h4 class="page-title">Ajouter un temps de travail</h4>
                         
                    </div>
                    <div class="col-sm-8  text-right m-b-20">
                        <a href="shift.php" class="btn btn-primary btn-rounded float-right">Annuler</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" >
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Heure de début</label>
                                        <div class="time-icon">
                                            <input type="text" class="form-control" id="datetimepicker3" name="starttime" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Heure de fin</label>
                                        <div class="time-icon">
                                            <input type="text" class="form-control" id="datetimepicker4" name="endtime" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="display-block">Statut de temps de travail</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="product_active" value="1" checked>
                                    <label class="form-check-label" for="product_active">
                                    Actif
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="product_inactive" value="0">
                                    <label class="form-check-label" for="product_inactive">
                                    Inactif
                                    </label>
                                </div>
                            </div>
                             
                            <div class="m-t-20 text-center">
                                <button name="add-shift" class="btn btn-primary submit-btn">Ajouter</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
		</div>
    
<?php
    include('footer.php');
?>
<script type="text/javascript">
     <?php
        if(isset($msg)) {
            echo 'swal("' . $msg . '");';
        }
    ?>
</script>