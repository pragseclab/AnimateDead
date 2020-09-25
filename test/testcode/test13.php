<?php
if (!empty($_POST['selected_tbl']) && empty($table_select)) {
    $table_select = $_POST['selected_tbl'];
}
//Testcase to check empty()
//db_export.php
?>