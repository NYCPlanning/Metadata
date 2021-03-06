<?php
include ('../navbar.php');
$email = $_SESSION['user'];
$u_type = $_SESSION['type'];

$sde = $_GET['sde'];
$common = $_GET['common'];
$delete_email = $_GET['delete_email'];

if(isset($_GET['add_email'])) {
  $email = $_GET['add_email'];
  $a_query ="INSERT INTO collaboration(sdename, email) VALUES ($1,$2)";
  pg_query_params($db, $a_query, array($sde, $email));
}

if(isset($_GET['delete'])) {
  if($email == $delete_email){
    $d_query = "DELETE FROM collaboration WHERE sdename = $1 AND email = $2";
    pg_query_params($db, $d_query, array($sde, $delete_email));
    echo '<script>';
    echo 'window.location.href=' . $path . '/user/view_dataset.php';  //not showing an alert box.
    echo '</script>';
  } else {
    $d_query = "DELETE FROM collaboration WHERE sdename = $1 AND email = $2";
    pg_query_params($db, $d_query, array($sde, $delete_email));
  }

}

$query = "SELECT email FROM collaboration WHERE sdename = $1 ORDER BY email";
$result = pg_query_params($db, $query, array($sde));
$row =pg_fetch_all($result);



?>
<style>
  .collab_header {
    display:inline-block;
  }

  .collab-add-button {
    border:none;
  }

  .collab-add-button i {
    color: black;
    font-size: 20px;
  }

  .collab-add-button i:hover, .fa-trash-alt:hover {
    color: #D96B27;
  }

  .fa-trash-alt {
    color: black;
  }

  #email {
    width: 70%;
  }


</style>
<!-- Modal -->
<div id="addCollab" class="modal fade " role="dialog" style="margin-top: 200px;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-left" style="">Add Collaborators</h3>
      </div>
      <div class="modal-body">
        <div class="">
          <div class="text-center">
            <form method="get" action="">
                <label for="email">Email:</label>
                <input type="text" name="add_email" id="email">
                <input type="hidden" name="sde" value="<?php echo $sde?>">
                <input type="hidden" name="common" value="<?php echo $common?>">
                <input type="submit" name="submit" value="Add">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <h3><?php echo $common; ?></h3>
  <hr>
  <h3 class="collab_header">Collaborators</h3>
  <button type="button" data-toggle="modal" data-target="#addCollab" class="collab-add-button">
    <i class="fas fa-plus-circle"></i>
  </button>
  <br>
  <?php
    // Displays all the retrieved data from the database
    foreach($row as $r) {
      echo "<p><a id=".$r["email"].">  <i id=".$r["email"]." class='far fa-trash-alt' onClick='deleteUser(this.id)' style='margin-right:5px;'></i></a>".$r["email"]."  </p>";

    }
  ?>
</div>
<script>

   function deleteUser(id) {
       if (confirm("Are you sure you want to delete this user?")) {
           window.location.href= "<?php echo $path; ?>/user/view_dataset_manage.php?delete=True&sde=<?php echo $sde.'&common='.$common.'&delete_email=';?>"+id;
       }

   }

</script>
