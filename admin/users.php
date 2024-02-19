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

            <div class="activity">
                <div class="title">
                    <a href="./?page=adduser" style="text-decoration: none; color: black;">
                    <i class="bi bi-file-earmark-plus"></i></a>
                        <span class="text">ADD USER</span>
                    
                </div>

                <table id="example" class="table">
    <thead>
    <tr>
      <th scope="col">FIRSTNAME</th>
      <th scope="col">LASTNAME</th>
      <th scope="col">POSITION</th>
      <th scope="col">USERNAME</th>
      <th scope="col">CREATED</th>
      <th scope="col">EDIT</th>
      <th scope="col">STATUS</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <?php
            $select="select * from users";
            $result = mysqli_query($conn, $select);
            if($result){
                while($row=mysqli_fetch_assoc($result)){
                    $id=$row['id'];
                    $fname=$row['fname'];
                    $lname=$row['lname'];
                    $usertype=$row['usertype'];
                    $username=$row['username'];
                    $date=$row['date'];
                    $status=$row['status'];
                    echo '<tr>
                    <td>'.$fname.'</td>
                    <td>'.$lname.'</td>
                    <td>'.$usertype.'</td>
                    <td>'.$username.'</td>
                    <td>'.$date.'</td>
                    <td>'.$status.'</td>
                    <td>
                      <a href="edit.php?updateid='.$id.'"><buttons class="btn-button">UPDATE</buttons></a>
                    </td>
                    
                  </tr>';
                }
                }
            
        ?>
    
  </tbody>
</table>
</div>
</section>
<style>
    /* Add the following CSS code to your style sheet */
select#length {
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

select#length:focus {
  border-color: #80bdff;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

select#length::-ms-expand {
  display: none;
}

select#length option {
  font-weight: normal;
}
input[type="search"] {
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  background-image: url('https://as1.ftcdn.net/v2/jpg/03/25/73/68/1000_F_325736897_lyouuiCkWI59SZAPGPLZ5OWQjw2Gw4qY.jpg');
  background-repeat: no-repeat;
  background-size: 25px 25px;
  background-position: calc(100% - 8px) center;
}

input[type="search"]:focus {
  color: #495057;
  background-color: #fff;
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
</style>
<script>
            $(document).ready(function () {
            $('#example').DataTable({
                paging: true,
                ordering: true,
                searching: true,
                info: false,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    lengthMenu: '<select id="length"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> records',
                    search: "",
                    searchPlaceholder: " Search Users"
                },
            });
        });
    </script>
    <script src="../lib/JS/script.js"></script>
  </body>
</html>