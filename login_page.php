<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <!-- CSS not working, Cache issue.
      Fixed using time() which forces the CSS to reload.
   -->
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
  <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="panel_window">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="fw-bold">LOGIN</h1>
        </div>
      </div>

      <div class="row pt-3">
        <div class="col-lg-12">
          <form action="./login_user.php" method="POST">
            <div class="mb-3">
              <label for="user_name" class="form-label">User name</label>
              <input type="text" class="form-control" id="user_name" aria-describedby="userNameInput" name="user_name" />

            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" />
            </div>

            <button type="submit" class="btn btn-primary" name="login_user">LOGIN</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>