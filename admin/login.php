<?php
$pagetitle = "Admin Panel";
$pagefile = "login.php";

?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/admin/templates/head.php'; ?>
       
<?php
if(isset($_GET['email']) && isset($_GET['password'])){

$email = $_GET['email'];
$password = $_GET['password'];

if($email=="admin" && $password=="123Dadada123!")
 {
   session_start();
   $_SESSION['adminemail']=$email;
   header("location:index.php");
  }else
  {
   return "Login Failed";
  }
}

?>

<div class="row flex-center min-vh-50 py-4">
          <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card">
              <div class="card-body p-4 p-sm-5">
                <div class="row flex-between-center mb-2">
                  <div class="col-auto">
                    <h5>Log in</h5>
                  </div>
                </div>
                <form>
                  <div class="mb-3">
                    <input class="form-control" name="email" type="text" placeholder="username">
                  </div>
                  <div class="mb-3">
                    <input class="form-control" name="password" type="password" placeholder="Password">
                  </div>
              
                  <div class="mb-3">
                    <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Log in</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>


        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/admin/templates/footer.php'; ?>