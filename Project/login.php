<?php
include_once('dbcon.php');

$email = '';
$errors = [];
if (isset($_POST['login-btn'])) {

  //collecting information from our form fields
  $email = mysqli_real_escape_string($connect2db, $_POST['email']);
  $password = mysqli_real_escape_string($connect2db, $_POST['password']);

  if (count($errors) === 0) {
    //check for credentials
    $check = mysqli_query($connect2db, "SELECT * FROM registration WHERE email = '$email' LIMIT 1");
    $count = mysqli_num_rows($check);
    $row = mysqli_fetch_assoc($check);
    /* echo '<pre>';
    var_dump($row);die; */
    if (password_verify($password, $row['password'])) {
      //login user here using SESSION
      $_SESSION['id'] = $row['id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['full_name'] = $row['full_name'];
      $_SESSION['message'] = "You are now logged in!";
      header("location: index.php");
      exit();
    } else {
      $errors['login error'] = "Wrong credentials";
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Sign Up</title>
</head>

<body>
  <div class="container-signup">
    <div class="signup-image">
      <img src="background.jpeg" id="s.image" width="820px" height="0px"><br>
      <!-- <i id="team">TEAM TREASURE</i> -->
    </div>
    <div id="signup-form">
      <form action="" method="POST">
        <h2>Sign Up</h2>
        <?php if (isset($_SESSION['message'])) : ?>

          <div class="alert">
            <?php
              echo $_SESSION['message'];
              unset($_SESSION['message']);

              ?>
          </div>
        <?php endif; ?>
        <?php if (count($errors) > 0) : ?>

          <div class="error">
            <?php foreach ($errors as $error) : ?>
              <li><?php echo $error; ?></li>
            <?php endforeach; ?>
          </div>

        <?php endif; ?>

        <label id="em">Email</label><br>
        <input type="Email" class="form-control name" name="email" value="<?= $email; ?>"><br>
        <label id="em">Password</label><br>
        <input type="password" name="password" id="s.password"><br>

        <!-- <input type="checkbox" name="checkbox" id="check"><i id="check-writeup">I agree to the terms of User</i> <br>	 -->
        <input type="submit" name="login-btn" id="signup" value="Login"><br><br>

        Don't have an Account?<a href="signup_page.php" id="signin">Register</a>

      </form>
    </div>

  </div>

</body>

</html>