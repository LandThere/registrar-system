<?php
$conn = mysqli_connect("localhost", "root", "", "archsys");
$filePath = "../backup/main_archive(backup).sql";

function restoreMysqlDB($filePath, $conn)
{
    $sql = '';
    $error = '';

    if (file_exists($filePath)) {
        $lines = file($filePath);

        foreach ($lines as $line) {

            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }

            $sql .= $line;

            if (substr(trim($line), - 1, 1) == ';') {
                // Check if the statement is an INSERT statement
                if (strpos(strtolower($sql), 'insert') !== false) {
                    // Replace INSERT with REPLACE
                    $sql = str_ireplace('INSERT', 'REPLACE', $sql);

                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        $error .= mysqli_error($conn) . "\n";
                    }
                }
                $sql = '';
            }
        } // end foreach

        if ($error) {
            // Redirect to archivemain.php with error status
            header("Location: archivemain.php?result=error");
            exit();
        } else {
            // Redirect to archivemain.php with success status
            header("Location: archivemain.php?result=success");
            exit();
        }        
    } // end if file exists
    return $response;
}

restoreMysqlDB($filePath, $conn);
?>