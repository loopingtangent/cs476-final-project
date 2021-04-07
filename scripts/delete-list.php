<?php
    include "/home/loopingt/pick4me.loopingtangent.com/scripts/DBConnection.php";

    $listID = $_POST["delete-list"];

    $deleteQuery = "DELETE FROM pick4me_table_List WHERE ListID = " . $listID;
    $result = runQuery($deleteQuery);

    $Confirm_Msg = "The list has been deleted.";
    header('Location: ../lists/my-lists.php');
?>
