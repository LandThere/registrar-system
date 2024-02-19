<?php
session_set_cookie_params(0);
session_start();
@include '../../config.php';
@include '../../inactivity.php';
if(!isset($_SESSION["username"]))
{
	header("location:../../login.php");
} 

elseif($_SESSION['usertype']=='User')
{
    header("Location: ../../user/");
}
elseif($_SESSION['usertype']=='HeadAdmin')
{
    header("Location: ../../head/");
}

$file_id=$_GET['uploadid'];
?>

<!DOCTYPE html>
<html>
<?php include '../includes/uploadheader.php'?>
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
            <a href="javascript:history.back()" style="display: inline-block;">
                <button type="button" class="button">
                <span class="button__text">Back</span>
                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg"><polyline points="15 18 9 12 15 6"></polyline></svg></span>
                </button>
            </a>
            </div>
                <div class="stud-image" align="center">
                    <img src="../../lib/img/user.png">
                
                <?php
                @include '../../config.php';
                $id=$_GET['uploadid'];
                 $select="select * from stdmain where id=$id";
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
                <p><b>(EVALUATION)</b></p>  
            <form action="" method="post" enctype="multipart/form-data" id="uploadForm">
                <input type="hidden" name="file_id" id="file_id" required value="<?php echo $id ?>">
                <input class="form-control" type="file" name="image" id="image" required/>
                <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>">
                <input type="hidden" name="date" id="theDate">
                <button class="buttonDownload" type="button" onclick="confirmUpload()">Upload</button>
            </form>
        </div>
        <style>
.form-label strong {
  font-weight: bold;
  font-size: 1.2em;
  color: #333;
}

.form-control {
  display: block;
  width: 20%;
  padding: 0.5rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
input[type="file"] {
  display: block;
  width: 20%;
  padding: 0.5rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  box-shadow: none;
}

input[type="file"]::-webkit-file-upload-button {
  background-color: crimson;
  border-radius: 0.25rem;
  border: none;
  color: #fff;
  cursor: pointer;
  font-size: 1rem;
  padding: 0.5rem 0.75rem;
  transition: background-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

input[type="file"]::-webkit-file-upload-button:hover {
  background-color: black;
}

input[type="file"]::-webkit-file-upload-button:focus {
  outline: none;
  box-shadow: none;
}
.buttonDownload {
  display: inline-block;
  position: relative;
  padding: 10px 25px;
  background-color: crimson;
  color: white;
  font-family: sans-serif;
  text-decoration: none;
  font-size: 0.9em;
  text-align: center;
  text-indent: 15px;
  border: none;
  border-radius: 0.3em;
  font-weight: bold;
}

.buttonDownload:hover {
  background-color: black;
  color: white;
}

.buttonDownload:before, .buttonDownload:after {
  content: ' ';
  display: block;
  position: absolute;
  left: 15px;
  top: 52%;
}

.buttonDownload:before {
  width: 10px;
  height: 2px;
  border-style: solid;
  border-width: 0 2px 2px;
}

.buttonDownload:after {
  width: 0;
  height: 0;
  margin-left: 3px;
  margin-top: -7px;
  border-style: solid;
  border-width: 4px 4px 0 4px;
  border-color: transparent;
  border-top-color: inherit;
  animation: downloadArrow 1s linear infinite;
  animation-play-state: paused;
}

.buttonDownload:hover:before {
  border-color: white;
}

.buttonDownload:hover:after {
  border-top-color: white;
  animation-play-state: running;
}

@keyframes downloadArrow {
  0% {
    margin-top: -7px;
    opacity: 1;
  }

  0.001% {
    margin-top: -15px;
    opacity: 0.4;
  }

  50% {
    opacity: 1;
  }

  100% {
    margin-top: 0;
    opacity: 0.4;
  }
}
</style>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
        <?php
// upload file
if(isset($_FILES["image"])) {
    $image = $_FILES["image"];
    $file_id = $_POST["file_id"];
    $username = $_POST["username"];
    $date = $_POST['date'];
    $name = $image["name"];
    $type = $image["type"];
    
    // Check if file type is PDF
    if($type != "application/pdf" && $type != "image/jpeg") {
        echo '<script src="../../lib/JS/sweetalert.min.js"></script>';
        echo "<script>";
        echo "swal({ 
            title: 'Error!', 
            text: 'Only PDF and JPEG files are allowed.', 
            icon: 'error' 
        }).then(function() {
            window.history.back();
        });";
        echo "</script>";
        exit();
    }

    $blob = addslashes(file_get_contents($image["tmp_name"]));
    $sql = "INSERT INTO `tbl_eval` (`image`, `file_id`, `username`, `date`, `name`, `type`) VALUES ('" . $blob . "', '" . $file_id . "' , '" . $username . "', '" . $date . "', '" . $name . "' , '" . $type ."')";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    echo '<script src="../../lib/JS/sweetalert.min.js"></script>';
    echo "<script>";
    echo "swal({ 
        title: 'Success!', 
        text: 'File has been uploaded.', 
        icon: 'success' 
    }).then(function() {
        window.history.back();
    });";
    echo "</script>";
}

// fetch files for the table
$sql = "SELECT id, name FROM `tbl_eval` where file_id=$file_id";
$result = mysqli_query($conn, $sql);
?>
<script src="../../lib/JS/sweetalert.min.js"></script>
<script>
function confirmUpload() {
    swal({
        title: "Confirmation",
        text: "Are you sure you want to upload the file?",
        icon: "warning",
        buttons: ["Cancel", "Upload"],
        dangerMode: true,
    }).then(function (willUpload) {
        if (willUpload) {
            document.getElementById("uploadForm").submit();
        } else {
            swal({
                title: "Cancelled",
                text: "File upload has been cancelled.",
                icon: "info",
            });
        }
    });
}
</script>

<!-- display table -->
<table class="content-table">
    <thead>
        <tr>
            <th>File Name</th>
            <th>View</th>
            <th>Delete</th>
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
                    <a href="../views/evaluation.php?id=<?php echo $row->id; ?>" target="_blank">
                    <buttons class="btn-button">VIEW</buttons>
                    </a>
                </td>
                <td>
                <a class="btn-button" href="delete/delete_evaluation.php?id=<?php echo $row->id; ?>" onclick="showConfirmation(event)">DELETE</a>
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
    function showConfirmation(event) {
        event.preventDefault(); // Prevent the default anchor tag behavior

        swal({
            title: 'Are you sure?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Cancel',
                    value: null,
                    visible: true,
                    className: '',
                    closeModal: true,
                },
                confirm: {
                    text: 'Yes, delete it!',
                    value: true,
                    visible: true,
                    className: '',
                    closeModal: true
                }
            }
        }).then(function (willDelete) {
            if (willDelete) {
                window.location.href = event.target.href; // Proceed with the deletion
                showSuccessMessage(); // Show success message after deletion
            }
        });
    }

    function showSuccessMessage() {
        swal({
            title: 'Deleted!',
            text: 'The record has been deleted successfully.',
            icon: 'success',
            timer: 2000, // Set the duration for the success message in milliseconds
            buttons: false, // Hide the buttons
        }).then(function () {
            window.location.href = 'birth.php'; // Redirect to the desired page after the success message is displayed
        });
    }
</script>

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