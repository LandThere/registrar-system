<?php
//ENTER THE RELEVANT INFO BELOW
$mysqlUserName = "root";
$mysqlPassword = "";
$mysqlHostName = "localhost";
$DbName = "archsys";
$backup_name = "esu_archive(backup).sql";
$tables = array("esu_archive");

//or add 5th parameter(array) of specific tables: array("mytable1","mytable2","mytable3") for multiple tables

Export_Database($mysqlHostName, $mysqlUserName, $mysqlPassword, $DbName, $tables, $backup_name);

function Export_Database($host, $user, $pass, $name, $tables = false, $backup_name = false)
{
    $mysqli = new mysqli($host, $user, $pass, $name);
    $mysqli->select_db($name);
    $mysqli->query("SET NAMES 'utf8'");

    $queryTables = $mysqli->query('SHOW TABLES');
    while ($row = $queryTables->fetch_row()) {
        $target_tables[] = $row[0];
    }
    if ($tables !== false) {
        $target_tables = array_intersect($target_tables, $tables);
    }

    $content = '';

    foreach ($target_tables as $table) {
        $result = $mysqli->query('SELECT * FROM ' . $table);
        $fields_amount = $result->field_count;
        $rows_num = $mysqli->affected_rows;
        $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
        $TableMLine = $res->fetch_row();
        $content .= (!isset($content) ? '' : $content) . "\n\n" . $TableMLine[1] . ";\n\n";

        for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
            while ($row = $result->fetch_row()) {
                if ($st_counter % 100 == 0 || $st_counter == 0) {
                    $content .= "\nINSERT INTO " . $table . " VALUES";
                }
                $content .= "\n(";
                for ($j = 0; $j < $fields_amount; $j++) {
                    $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                    if (isset($row[$j])) {
                        $content .= '"' . $row[$j] . '"';
                    } else {
                        $content .= '""';
                    }
                    if ($j < ($fields_amount - 1)) {
                        $content .= ',';
                    }
                }
                $content .= ")";
                if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                    $content .= ";";
                } else {
                    $content .= ",";
                }
                $st_counter = $st_counter + 1;
            }
        }
        $content .= "\n\n\n";
        
        // Truncate and delete data from the table
        $mysqli->query('TRUNCATE TABLE ' . $table);
    }

    $date = date("Y-m-d");
    $backup_name = $backup_name ? $backup_name : $name . ".$date.sql";
    $backup_path = "../backup/"; // Set the desired backup path here

    // Save the backup file on the server
    $save_path = $backup_path . $backup_name;
    if (file_put_contents($save_path, $content) !== false) {
        // Redirect to archivemain.php with success message as a query parameter
        header("Location: archiveesu.php?status=success");
        exit();
    } else {
        // Redirect to archivemain.php with error message as a query parameter
        header("Location: archiveesu.php?status=error");
        exit();
    }

    // You can also provide a download link to the backup file if desired
    // echo '<a href="' . $save_path . '">Download Backup</a>';
}
?>
