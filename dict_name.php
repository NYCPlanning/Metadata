<?php

include 'config.php';
$tableName = $_POST['nameid'];

if (!empty($_POST['dictname-submit'])) {
$query = "CREATE TABLE $tableName (
column_name text,
column_description text,
code_def text,
add_notes text
)";
$result = pg_query($query);
if ($result) {
        header("Location: dict_name-p2.php?tableName=".$tableName);
    }
    else{
        $message = "Table already exits. Do you want to insert data into the existing Table?";
        echo "<script type='text/javascript'>var r = confirm('$message');
        if(r == true)
        {
          window.location.href = 'dict_name-p2.php?tableName=$tableName';
        }
        else
        {
          window.location.href = 'dict_name.php';
        }
         </script>";
    }
}

?>

<!DOCTYPE html>
<body style="background-color:ivory;"> 
<h2>Enter table name to be created</h2>
<ul>
<form name="dict_name" method="POST" >
<li>Name:</li><li><input type="text" name="nameid" required/></li>
<!-- <li>Address:</li><li><input type="text" name="addressid" /></li>
 --><br>
 <li><input type="submit" name="dictname-submit" value="Create Table" /></li>
 <style>
li {
list-style: none;
}
</style>
</form>
</ul>






<!-- // if (empty($_POST['dictname-submit'])) {
// if (!empty($_POST['submit'])) {
// $db = pg_connect("host=localhost port=5432 dbname=postgres user=amolivani");
// $query = "INSERT INTO $_POST[nameid] VALUES ('$_POST[col_name]','$_POST[col_des]','$_POST[cd]','$_POST[add_notes]')";
// $result = pg_query($query); 
// }
// } -->



