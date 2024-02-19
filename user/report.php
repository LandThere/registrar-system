<?php

session_set_cookie_params(0);
session_start();
@include '../config.php';
@include '../inactivity.php';
@include 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'?>

<body>

    <section class="dashboard">
        <div class="top">
            <i class="bi bi-list sidebar-toggle"></i>
            <div class="search-box">
                <i class="bi bi-person" style="font-size: 1.5rem; color: rgb(255, 0, 0);"></i>
                <input type="text" placeholder="<?php echo 'Welcome, ' . $_SESSION['username'] . '! | ' . $_SESSION['usertype'];?>" disabled>
            </div>

        </div>
        <div class="dash-content">
            <div class="overview">

            </div>

            <div class="studprofile">
            <a href="main.php" style="display: inline-block;">
                <button type="button" class="button">
                <span class="button__text">Back</span>
                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg"><polyline points="15 18 9 12 15 6"></polyline></svg></span>
                </button>
            </a>
            </div>
                <div class="stud-image" align="center">
                    <img src="../lib/img/user.png">
                
                <?php
                $id=$_GET['reportid'];
                 $select="select * from stdmain where id=$id";
                 $result = mysqli_query($conn, $select);
                 if($result){
                     while($row=mysqli_fetch_assoc($result)){
                         $id=$row['id'];
                         $lname = $row['lname'];
                         $fname = $row['fname'];
                         $mname = $row['mname'];
                         $courname = $row['courname'];
                         $std_id = $row['std_id'];
                         echo '
                         <p><b>'.$lname.', '.$fname.' '.$mname.'</b></p>
                         <p><b>'.$courname.'</b></p>
                         ';
                     }
                    }
                ?>
                <p>MAIN CAMPUS</p>
                <br>
                <b><h2>FILES REPORT</h2><b>
                <br>
                <?php
                        // Query to retrieve file list for the specific student
                        $select_files = "SELECT * FROM table_main";
                        $result_files = mysqli_query($conn, $select_files);
                        
                        if ($result_files) {
                            while ($row_file = mysqli_fetch_assoc($result_files)) {
                                $file_name = $row_file['name'];
                                $file_tbl = $row_file['tblname'];
                                
                                // Query the table specified by $file_tbl to get row count
                                $count_query = "SELECT COUNT(*) AS row_count FROM $file_tbl WHERE file_id = $id";
                                $result_count = mysqli_query($conn, $count_query);
                                $row_count = mysqli_fetch_assoc($result_count)['row_count'];
                                
                                echo '<div>
                                    <p>'.$file_name.': <b>['.$row_count.' file]</b></p>
                                </div>';
                            }
                        }
?>
                </div>
            </div>

    <div class="activity" align="center">
    </div>
    <table id="example" class="content-table">
    <thead>
        <tr>

        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
            </div>
        </div>
        </div>


</section>
<script src="../lib/JS/script.js"></script>
</body>

</html>