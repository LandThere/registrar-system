<?php 
 
// Database connection info 
$dbDetails = array( 
    'host' => 'localhost', 
    'user' => 'root', 
    'pass' => '', 
    'db'   => 'archsys' 
); 
// DB table to use 
$table = 'main_archive'; 
 
// Table's primary key 
$primaryKey = 'id'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'std_id', 'dt' => 0 ), 
    array( 'db' => 'lname',  'dt' => 1 ), 
    array( 'db' => 'fname',      'dt' => 2 ), 
    array( 'db' => 'mname',     'dt' => 3 ), 
    array( 'db' => 'gender',    'dt' => 4 ),
    array( 'db' => 'courname',    'dt' => 5 ),
    array( 'db' => 'started',    'dt' => 6 ), 
    array( 'db' => 'folder',    'dt' => 7 ),
    array( 
        'db'        => 'status', 
        'dt'        => 8, 
        'formatter' => function( $d, $row ) { 
            return ($d == 1)?'Active':'Inactive'; 
        } 
    ), 
    array( 'db' => 'remarks',    'dt' => 9 ),  
    array( 
        'db'        => 'date', 
        'dt'        => 10, 
        'formatter' => function( $d, $row ) { 
            return date( 'Y-m-d', strtotime($d)); 
        } 
    ),    
    array( 
        'db'        => 'id', 
        'dt'        => 11, 
        'formatter' => function( $d, $row ) { 
            return ' 
                <a href="mainarchive_fileview.php?viewid='.$d.'"><button class="btn-button">File</button></a>&nbsp; 
            '; 
        } 
    ), 
    array( 
        'db'        => 'id', 
        'dt'        => 12, 
        'formatter' => function( $d, $row ) { 
            return ' 
                <a href="updatearchive.php?updateid='.$d.'"><button class="btn-button">Edit</button></a>&nbsp; 
            '; 
        } 
    ),
    array( 
        'db'        => 'id', 
        'dt'        => 13, 
        'formatter' => function( $d, $row ) { 
            return ' 
            <a href="reportarchivemain.php?reportid='.$d.'"><button class="btn-button">Report</button></a>&nbsp;  
            '; 
        } 
    ),       
    array( 
        'db'        => 'id', 
        'dt'        => 14, 
        'formatter' => function( $d, $row ) { 
            return ' 
            <a href="logsarchivemain.php?logsid='.$d.'"><button class="btn-button">Logs</button></a>&nbsp; 
            '; 
        } 
    ),
); 
 
// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
); 
 
?>