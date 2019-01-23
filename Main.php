<?php
include ('navbar.php');
include ('MaintFreq_dropdown.php');
?>

<style>
html, body {
    height: 100%;
    overflow: hidden;
    margin: 0;
}
#wrapper {
    height: 100%;
}
#left-div {
    float: left;
    width: 20%;
    height: 100%;
    border-right: 1px solid #DFE0E5;
    overflow: auto;
    padding: 0.4em;
}
#right-div {
    float: left;
    width: 80%;
    height: 100%;
    overflow: auto;
    padding: 0.4em;
    padding-bottom: 50px;
}


</style>

<div id="wrapper">
    <!-- Left Fixed Div -->
    <div id="left-div">

      <!-- Dataset Name Search -->
      <div class="row">
        <div class="col-lg-12">
          <div class="input-group">
            <label for="dataset_name">Dataset Name</label>
            <input type="text" class="form-control" placeholder="Dataset Name" id="dataset_name">
          </div><!-- /input-group -->
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->

      <!-- Update Frequency Filter -->
      <div class="row">
        <div class="col-lg-12">
          <div class="input-group">
            <label for="update_freq">Update Frequency</label>
            <div class="">
              <select required name="update_freq" id="update_freq">
                <option value="<?php echo $update_freq; ?>" selected><?php echo $update_freq; ?></option>
                <?php
                echo $tables;
                ?>
              </select>
            </div>

          </div>
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->

      <!-- Tags Filter -->
      <div class="row">
        <div class="col-lg-12">
          <div class="input-group">
            <label for="tags">Tags</label>
            <input type="text" class="form-control" placeholder="Tag Names" id="tags">
          </div><!-- /input-group -->
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->

    </div><!-- /#wrapper -->




    <!-- Right Fixed Div -->
    <div id="right-div">
      <!-- Retrieve data from database -->
      <?php
      $query1 = 'SELECT uid, common_name, description, date_last_updated FROM readme';
      $result = pg_query($query1);
      $row =pg_fetch_all($result);


      foreach($row as $r) {
        echo "<a href='display.php?id=".$r["uid"]."'><h4>" .  $r["common_name"] . "</h4></a>";
        echo "<p><em>" . $r["description"] . "</em></p>";
        echo "<h6>Date Last Modified: " . $r["date_last_updated"] . "</h6>";
        echo "<hr>";
      }

      ?>
    </div>
</div>

</body>
