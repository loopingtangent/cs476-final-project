<?php
    //connecting to database - START
    $host = ;
    $db = ;
    $user = ;
    $pass = ;
        try {
            $mysqli = new mysqli($host, $user, $pass, $db);
        } catch (\mysqli_sql_exception $e) {
            throw new \mysqli_sql_exception($e->getMessage(), $e->getCode());
        }
    //connecting to database - END

    session_start();

    function runQuery($query){
        $bt = debug_backtrace();
        $caller = array_shift($bt);

        if($result = mysqli_query($GLOBALS['mysqli'], $query))
            return $result;
        else
            die("Error in '".$caller['file']."' at line : ".$caller['line']." : {" . mysqli_error($GLOBALS['mysqli']) . "} <br>");
    }

    function runQueryGiveId($query){
        $bt = debug_backtrace();
        $caller = array_shift($bt);

        if($result = mysqli_query($GLOBALS['mysqli'], $query))
            return mysqli_insert_id($GLOBALS['mysqli']);
        else
            die("Error in '".$caller['file']."' at line : ".$caller['line']." : {" . mysqli_error($GLOBALS['mysqli']) . "} <br>");
    }
?>
