<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Rapport</h4>
                    </div>
                    
                   <!--  <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-employee.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Employee</a>
                    </div> -->
<form method="post">
<div class="form-group row" style="padding: 20px;">
  <label class="col-lg-0 col-form-label-report" for="from">De</label>
  <div class="col-lg-3">
      <input type="text" class="form-control" id="datetimepicker5" name="from_date" placeholder="Select Date" required>
  </div>

  <label class="col-lg-0 col-form-label" for="from">A</label>
  <div class="col-lg-3">
      <input type="text" class="form-control" id="datetimepicker6" name="to_date" placeholder="Select Date" required>
  </div>

  <div class="col-lg-3">
      <select class="form-control" id="department" name="department" required>
          <option value="">Séléctionnez un département</option>
          <?php 
           $fetch_department = mysqli_query($connection, "select * from tbl_department");
           while($row = mysqli_fetch_array($fetch_department)){
          ?>
          <option value="<?php echo $row['department_name']; ?>"><?php echo $row['department_id']; ?> - <?php echo $row['department_name']; ?></option>
      <?php } ?>
       </select>
  </div>
<div class="col-lg-2">
    <button type="submit" name="srh-btn" class="btn btn-primary search-button">Chercher</button>
</div>
</div>
</form>
                </div>
                <div class="table-responsive">
                                    <table class="datatable table table-stripped ">
                                    <thead>
                                        <tr>
                                            <th>Nom </th>
                                            <th>Département</th>
                                            <th>Date</th>
                                            <th>Temps de travail</th>
                                            <th>Heure d'arrivée</th>
                                            <th>Notes</th>
                                            <th>En statut</th>
                                            <th>Heure de sortie</th>
                                            <th>Statut Sotrie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php
                     if(isset($_REQUEST['srh-btn']))
                     {
                       $from_date = $_POST['from_date']; 
                       $to_date = $_POST['to_date'];
                       $dept = $_POST['department'];
                       $from_date = date('Y-m-d', strtotime($from_date));
                       $to_date = date('Y-m-d', strtotime($to_date));

                       $search_query = mysqli_query($connection, "select tbl_employee.first_name, tbl_employee.last_name, tbl_employee.department, tbl_attendance.date, tbl_attendance.shift, tbl_attendance.check_in, tbl_attendance.message, tbl_attendance.in_status, tbl_attendance.check_out, tbl_attendance.out_status from tbl_employee inner join tbl_attendance on tbl_attendance.employee_id=tbl_employee.employee_id where tbl_attendance.department='$dept' and DATE(tbl_attendance.date) BETWEEN '$from_date' and '$to_date'");
                       
                       while($row = mysqli_fetch_array($search_query))
                    { ?>
                                        
                                        <tr>
                                            <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                                            <td><?php echo $row['department']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['shift']; ?></td>
                                            <td><?php echo $row['check_in']; ?></td>
                                            <td><?php echo $row['message']; ?></td>
                                            <td><?php echo $row['in_status']; ?></td>
                                            <td><?php echo $row['check_out']; ?></td>
                                            <td><?php echo $row['out_status']; ?></td>
                                              
                                        </tr>
                                    <?php } } else { 
                                    $fetch_query = mysqli_query($connection, "select tbl_employee.first_name, tbl_employee.last_name, tbl_employee.department, tbl_attendance.date, tbl_attendance.shift, tbl_attendance.check_in, tbl_attendance.message, tbl_attendance.in_status, tbl_attendance.check_out, tbl_attendance.out_status from tbl_employee inner join tbl_attendance on tbl_attendance.employee_id=tbl_employee.employee_id");
                                        while($row = mysqli_fetch_array($fetch_query))
                                        {
                                        ?>
                                    <tr>
                                            <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                                            <td><?php echo $row['department']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['shift']; ?></td>
                                            <td><?php echo $row['check_in']; ?></td>
                                            <td><?php echo $row['message']; ?></td>
                                            <td><?php echo $row['in_status']; ?></td>
                                            <td><?php echo $row['check_out']; ?></td>
                                            <td><?php echo $row['out_status']; ?></td>
                                              
                                        </tr>
                                    <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
				
            </div>
            
        </div>


<?php include('footer.php'); ?>
<script language="JavaScript" type="text/javascript">
function confirmDelete(){
    return confirm('Are you sure want to delete this Employee?');
}
</script>
