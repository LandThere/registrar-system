<?php

session_set_cookie_params(0);
session_start();
@include '../config.php';
@include '../inactivity.php';
@include 'auth.php';
?>





<!DOCTYPE html>
<html lang="en">

<?php include 'includes/statistics.php'?>

<style>
body {
  background-color: white;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
<section class="dashboard">
        <div class="top">
            <i class="bi bi-list sidebar-toggle"></i>

            <div class="search-box">
                <i class="bi bi-person" style="font-size: 1.5rem; color: rgb(255, 0, 0);"></i>
                <input type="text" placeholder="<?php echo 'Welcome, ' . $_SESSION['username'] . '! | ' . $_SESSION['usertype'];?>" disabled>
            </div>
            
        </div>
        <div class="dash-content">
        <div class="container" style="display: flex; justify-content: space-between;">
        <div class="title" style="text-decoration: none; color: black;">
      <i class="bi bi-graph-up"></i>
      <span class="text">Statistics</span>
  </div>
</div>
<form method="POST" action="" id="year-form">
  <label for="year">Select a year:</label>
  <select id="year" name="selected_year">
    <?php
      // Generate options for the select input from a range of years
      for ($year = 2023; $year <= 2030; $year++) {
        // Check if the current year matches the submitted year
        $selected = '';
        if (isset($_POST['selected_year']) && $_POST['selected_year'] == $year) {
          $selected = 'selected';
        }
        echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
      }
    ?>
  </select>
</form>
<style>
select#year {
  padding: 0.375rem 1.25rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  border: 1px solid #ced4da;
  border-radius: 1.25rem;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23333' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.55rem center;
  background-size: 8px 10px;
}

select#year:focus {
  border-color: #80bdff;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

select#year::-ms-expand {
  display: none;
}

select#year option {
  font-weight: normal;
}

</style>
<h1 class="text">Statistics</h1>
        <div class="wrapper">         
                <div class="col-4 text-center">
                    
                    <i class="bi bi-person-check"></i>
                        <span class="text">Total Students</span>
                        <span class="number">
                        <?php
                        require '../config.php';
                        if (isset($_POST['selected_year'])) {
                        $selected_year = $_POST['selected_year'];
                        } else {
                        $selected_year = date('Y');
                        }

                        $select1 = "SELECT username FROM stdmain WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";
                        $select1_run = mysqli_query($conn, $select1);
                        $row1 = mysqli_num_rows($select1_run);

                        $select2 = "SELECT username FROM std_esu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select2_run = mysqli_query($conn, $select2);
                        $row2 = mysqli_num_rows($select2_run);

                        $total = $row1 + $row2;

                        echo " ".$total;
                        ?>
                        </span>
                    </div>
                    <div class="col-4 text-center">
                    <i class="bi bi-houses-fill"></i>
                        <span class="text">MAIN</span>
                        <span class="number">
                        <?php
                        require '../config.php';

                        if (isset($_POST['selected_year'])) {
                        $selected_year = $_POST['selected_year'];
                        } else {
                        $selected_year = date('Y');
                        }

                        $username = $_SESSION['username'];
                        $select = "SELECT username FROM stdmain WHERE YEAR(date) = $selected_year and username = '{$username}' AND username <> ''";
                        $select_run = mysqli_query($conn, $select);

                        $row = mysqli_num_rows($select_run);

                        echo ''.$row.'';
                        ?>
                        </span>
                    </div>
                    <div class="col-4 text-center">
                    <i class="bi bi-houses"></i>
                        <span class="text">E.S.U</span>
                        <span class="number">
                        <?php
                        require '../config.php';

                        if (isset($_POST['selected_year'])) {
                        $selected_year = $_POST['selected_year'];
                        } else {
                        $selected_year = date('Y');
                        }

                        $username = $_SESSION['username'];
                        $select = "SELECT username FROM std_esu WHERE YEAR(date) = $selected_year and username = '{$username}' AND username <> ''";
                        $select_run = mysqli_query($conn, $select);

                        $row = mysqli_num_rows($select_run);

                        echo ''.$row.'';
                        ?>
                        </span>
                    </div>

                    <div class="col-4 text-center">
                    <i class="bi bi-files"></i>
                        <span class="text">Total Files</span>
                        <span class="number">
                        <?php
                        require '../config.php';
                        if (isset($_POST['selected_year'])) {
                            $selected_year = $_POST['selected_year'];
                            } else {
                            $selected_year = date('Y');
                            }
                        $username = $_SESSION['username'];
                        $select1 = "SELECT username FROM tbl_birth WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";
                        $select1_run = mysqli_query($conn, $select1);
                        $row1 = mysqli_num_rows($select1_run);

                        $username = $_SESSION['username'];
                        $select2 = "SELECT username FROM tbl_eval WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select2_run = mysqli_query($conn, $select2);
                        $row2 = mysqli_num_rows($select2_run);

                        $username = $_SESSION['username'];
                        $select3 = "SELECT username FROM tbl_frm137 WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select3_run = mysqli_query($conn, $select3);
                        $row3 = mysqli_num_rows($select3_run);

                        $username = $_SESSION['username'];
                        $select4 = "SELECT username FROM tbl_marriage WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select4_run = mysqli_query($conn, $select4);
                        $row4 = mysqli_num_rows($select4_run);

                        $username = $_SESSION['username'];
                        $select5 = "SELECT username FROM tbl_others WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select5_run = mysqli_query($conn, $select5);
                        $row5 = mysqli_num_rows($select5_run);

                        $username = $_SESSION['username'];
                        $select6 = "SELECT username FROM tbl_tor WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select6_run = mysqli_query($conn, $select6);
                        $row6 = mysqli_num_rows($select6_run);

                        $username = $_SESSION['username'];
                        $select7 = "SELECT username FROM tbl_vtc WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select7_run = mysqli_query($conn, $select7);
                        $row7 = mysqli_num_rows($select7_run);

                        $username = $_SESSION['username'];
                        $select8 = "SELECT username FROM tbl_birthesu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";
                        $select8_run = mysqli_query($conn, $select8);
                        $row8 = mysqli_num_rows($select8_run);

                        $username = $_SESSION['username'];
                        $select9 = "SELECT username FROM tbl_evalesu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select9_run = mysqli_query($conn, $select9);
                        $row9 = mysqli_num_rows($select9_run);

                        $username = $_SESSION['username'];
                        $select10 = "SELECT username FROM tbl_frm137esu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select10_run = mysqli_query($conn, $select10);
                        $row10 = mysqli_num_rows($select10_run);

                        $username = $_SESSION['username'];
                        $select11 = "SELECT username FROM tbl_marriageesu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select11_run = mysqli_query($conn, $select11);
                        $row11 = mysqli_num_rows($select11_run);

                        $username = $_SESSION['username'];
                        $select12 = "SELECT username FROM tbl_othersesu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select12_run = mysqli_query($conn, $select12);
                        $row12 = mysqli_num_rows($select12_run);

                        $username = $_SESSION['username'];
                        $select13 = "SELECT username FROM tbl_toresu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select13_run = mysqli_query($conn, $select13);
                        $row13 = mysqli_num_rows($select13_run);

                        $username = $_SESSION['username'];
                        $select14 = "SELECT username FROM tbl_vtcesu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select14_run = mysqli_query($conn, $select14);
                        $row14 = mysqli_num_rows($select14_run);

                        $total = $row1 + $row2 + $row3 + $row4 + $row5 + $row6 + $row7 + $row8 + $row9 + $row10 + $row11 + $row12 + $row13 + $row14;

                        echo " ".$total;
                        ?>
                        </span>
                    </div>
                    <div class="col-4 text-center">
                    <i class="bi bi-file-pdf"></i>
                        <span class="text">MAIN FILES</span>
                        <span class="number">
                        <?php
                        require '../config.php';
                        if (isset($_POST['selected_year'])) {
                            $selected_year = $_POST['selected_year'];
                            } else {
                            $selected_year = date('Y');
                            }
                        $username = $_SESSION['username'];
                        $select1 = "SELECT username FROM tbl_birth WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";
                        $select1_run = mysqli_query($conn, $select1);
                        $row1 = mysqli_num_rows($select1_run);

                        $username = $_SESSION['username'];
                        $select2 = "SELECT username FROM tbl_eval WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select2_run = mysqli_query($conn, $select2);
                        $row2 = mysqli_num_rows($select2_run);

                        $username = $_SESSION['username'];
                        $select3 = "SELECT username FROM tbl_frm137 WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select3_run = mysqli_query($conn, $select3);
                        $row3 = mysqli_num_rows($select3_run);

                        $username = $_SESSION['username'];
                        $select4 = "SELECT username FROM tbl_marriage WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select4_run = mysqli_query($conn, $select4);
                        $row4 = mysqli_num_rows($select4_run);

                        $username = $_SESSION['username'];
                        $select5 = "SELECT username FROM tbl_others WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select5_run = mysqli_query($conn, $select5);
                        $row5 = mysqli_num_rows($select5_run);

                        $username = $_SESSION['username'];
                        $select6 = "SELECT username FROM tbl_tor WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select6_run = mysqli_query($conn, $select6);
                        $row6 = mysqli_num_rows($select6_run);

                        $username = $_SESSION['username'];
                        $select7 = "SELECT username FROM tbl_vtc WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select7_run = mysqli_query($conn, $select7);
                        $row7 = mysqli_num_rows($select7_run);

                        $total = $row1 + $row2 + $row3 + $row4 + $row5 + $row6 + $row7;

                        echo " ".$total;
                        ?>
                        </span>
                    </div>
                    <div class="col-4 text-center">
                    <i class="bi bi-file-pdf-fill"></i>
                        <span class="text">E.S.U FILES</span>
                        <span class="number">
                        <?php
                        require '../config.php';
                        if (isset($_POST['selected_year'])) {
                            $selected_year = $_POST['selected_year'];
                            } else {
                            $selected_year = date('Y');
                            }
                        $username = $_SESSION['username'];
                        $select1 = "SELECT username FROM tbl_birthesu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";
                        $select1_run = mysqli_query($conn, $select1);
                        $row1 = mysqli_num_rows($select1_run);

                        $username = $_SESSION['username'];
                        $select2 = "SELECT username FROM tbl_evalesu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select2_run = mysqli_query($conn, $select2);
                        $row2 = mysqli_num_rows($select2_run);

                        $username = $_SESSION['username'];
                        $select3 = "SELECT username FROM tbl_frm137esu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select3_run = mysqli_query($conn, $select3);
                        $row3 = mysqli_num_rows($select3_run);

                        $username = $_SESSION['username'];
                        $select4 = "SELECT username FROM tbl_marriageesu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select4_run = mysqli_query($conn, $select4);
                        $row4 = mysqli_num_rows($select4_run);

                        $username = $_SESSION['username'];
                        $select5 = "SELECT username FROM tbl_othersesu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select5_run = mysqli_query($conn, $select5);
                        $row5 = mysqli_num_rows($select5_run);

                        $username = $_SESSION['username'];
                        $select6 = "SELECT username FROM tbl_toresu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select6_run = mysqli_query($conn, $select6);
                        $row6 = mysqli_num_rows($select6_run);

                        $username = $_SESSION['username'];
                        $select7 = "SELECT username FROM tbl_vtcesu WHERE YEAR(date) = $selected_year and username = '{$_SESSION['username']}' AND username <> ''";   
                        $select7_run = mysqli_query($conn, $select7);
                        $row7 = mysqli_num_rows($select7_run);

                        $total = $row1 + $row2 + $row3 + $row4 + $row5 + $row6 + $row7;

                        echo " ".$total;
                        ?>
                        </span>
                    </div>

                </div>
            </div>
<div class = "h1text" style="padding-top: 400px;
padding-right: 700px;">
   <h1>Account Statistics</h1>
   <br>
</div>
    <table id="example" class="content-table">
    <thead>
        <tr>
        <th scope="col">LASTNAME</th>
        <th scope="col">FIRSTNAME</th>
        <th scope="col">USERNAME</th>
        <th scope="col">POSITION</th>
        <th scope="col">TOTAL STUDENT</th>
        <th scope="col">TOTAL FILES</th>

        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php
        $select="SELECT * FROM users WHERE usertype != 'user'";
        $result = mysqli_query($conn, $select);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $lname = $row['lname'];
                $fname = $row['fname'];
                $username = $row['username'];
                $usertype = $row['usertype'];
                $status = $row['status'];

                // Get the total count for the current month and the logged-in user
                require '../config.php';
                if (isset($_POST['selected_year'])) {
                    $selected_year = $_POST['selected_year'];
                    } else {
                    $selected_year = date('Y');
                    }
                
                $select1 = "SELECT username FROM stdmain WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";
                $select1_run = mysqli_query($conn, $select1);
                $row1 = mysqli_num_rows($select1_run);
                $select2 = "SELECT username FROM std_esu WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";
                $select2_run = mysqli_query($conn, $select2);
                $row2 = mysqli_num_rows($select2_run);
                $total = $row1 + $row2;

                $select1 = "SELECT username FROM tbl_birth WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";
                $select1_run = mysqli_query($conn, $select1);
                $row1 = mysqli_num_rows($select1_run);

                $select2 = "SELECT username FROM tbl_eval WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";   
                $select2_run = mysqli_query($conn, $select2);
                $row2 = mysqli_num_rows($select2_run);

                $select3 = "SELECT username FROM tbl_frm137 WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";  
                $select3_run = mysqli_query($conn, $select3);
                $row3 = mysqli_num_rows($select3_run);

                $select4 = "SELECT username FROM tbl_marriage WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";  
                $select4_run = mysqli_query($conn, $select4);
                $row4 = mysqli_num_rows($select4_run);

                $select5 = "SELECT username FROM tbl_others WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";  
                $select5_run = mysqli_query($conn, $select5);
                $row5 = mysqli_num_rows($select5_run);

                $select6 = "SELECT username FROM tbl_tor WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";   
                $select6_run = mysqli_query($conn, $select6);
                $row6 = mysqli_num_rows($select6_run);

                $select7 = "SELECT username FROM tbl_vtc WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";  
                $select7_run = mysqli_query($conn, $select7);
                $row7 = mysqli_num_rows($select7_run);

                $select8 = "SELECT username FROM tbl_birthesu WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";
                $select8_run = mysqli_query($conn, $select8);
                $row8 = mysqli_num_rows($select8_run);

                $select9 = "SELECT username FROM tbl_evalesu WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";  
                $select9_run = mysqli_query($conn, $select9);
                $row9 = mysqli_num_rows($select9_run);

                $select10 = "SELECT username FROM tbl_frm137esu WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";   
                $select10_run = mysqli_query($conn, $select10);
                $row10 = mysqli_num_rows($select10_run);

                $select11 = "SELECT username FROM tbl_marriageesu WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";  
                $select11_run = mysqli_query($conn, $select11);
                $row11 = mysqli_num_rows($select11_run);

                $select12 = "SELECT username FROM tbl_othersesu WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";   
                $select12_run = mysqli_query($conn, $select12);
                $row12 = mysqli_num_rows($select12_run);

                $select13 = "SELECT username FROM tbl_toresu WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";   
                $select13_run = mysqli_query($conn, $select13);
                $row13 = mysqli_num_rows($select13_run);

                $select14 = "SELECT username FROM tbl_vtcesu WHERE YEAR(date) = $selected_year AND username = '$username' AND username <> ''";  
                $select14_run = mysqli_query($conn, $select14);
                $row14 = mysqli_num_rows($select14_run);

                $total1 = $row1 + $row2 + $row3 + $row4 + $row5 + $row6 + $row7 + $row8 + $row9 + $row10 + $row11 + $row12 + $row13 + $row14;
                echo '<tr>
                        <td>'.$lname.'</td>
                        <td>'.$fname.'</td>
                        <td>'.$username.'</td>
                        <td>'.$usertype.'</td>
                        <td>'.$total.'</td>
                        <td>'.$total1.'</td>
                    </tr>';
            }
        }
        ?>

        
  </tbody>
</table>

</section>
<script>
  const yearSelect = document.getElementById('year');
  yearSelect.addEventListener('change', () => {
    document.getElementById('year-form').submit();
  });
</script>
<script>
$(document).ready(function () {
    $('#example').DataTable({
        paging: true,
        pageLength: 10,
        lengthChange: false,
        ordering: true,
        info: false,
        searching: false,
        language: {
            lengthMenu: 'Show _MENU_ records',
        },
    });
});
</script> 
    <script src="../lib/JS/script.js"></script>

</body>

</html>