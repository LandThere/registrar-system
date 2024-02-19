<?php
session_set_cookie_params(0);
session_start();
@include '../../config.php';
@include '../../inactivity.php';
if(!isset($_SESSION['username']))
{
    header('location:../../login.php');
}

elseif($_SESSION['usertype']=='HeadAdmin')
{
    header('Location: ../../head/');
}
elseif($_SESSION['usertype']=='Admin')
{
    header('Location: ../../admin/');
}
$file_id=$_GET['uploadid'];
?>
<!DOCTYPE html>
<html>
<?php include '../includes/uploadheader.php';?>
<body>
<section class='dashboard'>
    <div class='top'>
        <i class='bi bi-list sidebar-toggle'></i>
        <div class='search-box'>
            <i class='bi bi-person' style='font-size: 1.5rem; color: rgb(255, 0, 0);'></i>
            <input type='text' placeholder='<?php echo 'Welcome, ' . $_SESSION['username'] . '! | ' . $_SESSION['usertype'];?>' disabled>
        </div>
    </div>
    <div class='dash-content'>
        <div class='overview'>
        </div>
        <div class='studprofile'>
            <a href='javascript:history.back()' style='display: inline-block;'>
                <button type='button' class='button'>
                    <span class='button__text'>Back</span>
                    <span class='button__icon'><svg xmlns='http://www.w3.org/2000/svg' width='24' viewBox='0 0 24 24' stroke-width='2' stroke-linejoin='round' stroke-linecap='round' stroke='currentColor' height='24' fill='none' class='svg'><polyline points='15 18 9 12 15 6'></polyline></svg></span>
                </button>
            </a>
        </div>
        <div class='stud-image' align='center'>
            <img src='../../lib/img/user.png'>
            <?php
            @include '../../config.php';
            $id=$_GET['uploadid'];
            $select="select * from main_archive where id=$id";
            $result = mysqli_query($conn, $select);
                 if($result){
                     while($row=mysqli_fetch_assoc($result)){
                        $lname = $row['lname'];
                        $fname = $row['fname'];
                        $mname = $row['mname'];
                        $courname = $row['courname'];
                        echo '
                        <p><b>'.$lname.', '.$fname.' '.$mname.'</b></p>
                        <p><b>'.$courname.'</b></p>
                        ';
                     }
                    }
                ?>
                <p>MAIN CAMPUS</p>
                <br>  
                <p><b>(Passport)</b></p> 
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
<?php
$sql = "SELECT id, name FROM `passport` WHERE file_id=$file_id";
$result = mysqli_query($conn, $sql);
?>
 
<table class="content-table">
    <thead>
        <tr>
            <th>File Name</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_object($result))
        {
            ?>
            <tr>
                <td><?php echo $row->name; ?></td>
                <td>
                   <a href="../views/passport.php?id=<?php echo $row->id; ?>" target="_blank"> 
                        <buttons class="btn-button">VIEW</buttons>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
        </div>
    </div>
</div>
</section>
<script>
    var date = new Date();
var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();
 
if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;
 
var today = year + "-" + month + "-" + day; 
document.getElementById("theDate").value = today;
</script>
<script>
    const form = document.querySelector("form"),
        nextBtn = form.querySelector(".nextBtn"),
        backBtn = form.querySelector(".backBtn"),
        allInput = form.querySelectorAll(".first input");
 
nextBtn.addEventListener("click", ()=> {
    allInput.forEach(input => {
        if(input.value != ""){
            form.classList.add('secActive');
        }else{
            form.classList.remove('secActive');
        }
    })
})
 
backBtn.addEventListener("click", () => form.classList.remove('secActive'));
</script> 
<script src="../../lib/JS/script.js"></script>
</body>
</html>
