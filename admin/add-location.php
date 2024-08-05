<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
    
    if(isset($_REQUEST['add-location']))
    {
      $poste = $_REQUEST['poste'];
      
      $insert_query = mysqli_query($connection, "insert into tbl_location set poste='$poste'");

      if($insert_query>0)
      {
          $msg = "Poste created successfully";
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
                        <h4 class="page-title">Ajouter un poste</h4>
                         
                    </div>
                    <div class="col-sm-8  text-right m-b-20">
                        <a href="location.php" class="btn btn-primary btn-rounded float-right">Annuler</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post">
                            <div class="form-group">
                                <label>Nom du poste <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="poste" required>
                            </div>
                                                       
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="add-location">Ajouter</button>
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