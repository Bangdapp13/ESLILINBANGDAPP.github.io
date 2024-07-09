<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .btn {
        background: #01649F !important;
        color: white;
      }
      .btn:hover {
        background: #01649F !important;
        color: white;
      }
      .heading {
        color: #01649F;
      }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="display-5 fw-bold mb-3 heading">Login Admin</h2>
        <form action="proses_login_admin.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
