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
                $id=$_GET['viewid'];
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
                </div>
            </div>

    <div class="activity" align="center">
    <a href="createfile.php" style="display: inline-block;">
        <button type="button" class="button">
        <span class="button__text">Add Row</span>
        <span class="button__icon"><svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" fill="white"></path></svg></span>
        </button>
    </a>
    </div>
    <table id="example" class="content-table">
    <thead>
        <tr>
        <th>TYPES OF DOCUMENTS</th>
        <th>VIEW FILE</th>


        </tr>
    </thead>
    <tbody>
    <?php
$select = "SELECT * FROM `table_main`";
$result = mysqli_query($conn, $select);

if ($result) {
    $i = 1; // Initialize $i outside the loop
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $_GET['viewid'];
        $name = $row['name'];
        $href = $row['href'];
        echo '<tr>
            <td>'.$i++.'. '.$name.'</td>
            <td>
                <a href="'.$href.'?uploadid='.$id.'"><buttons class="btn-button">VIEW</buttons></a>
            </td>
        </tr>';
        // Output other rows...
    }
}
?>


        
  </tbody>
</table>
            </div>
        </div>
        </div>


</section>
<script src="../lib/JS/script.js"></script>
</body>

</html>