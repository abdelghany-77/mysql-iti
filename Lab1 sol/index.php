<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  $conn = @new mysqli('localhost', $username, $password);

  if ($conn->connect_error) {
    $error = 'Invalid credentials';
  } else {
    $_SESSION['logged_in'] = true;
    $_SESSION['db_user'] = $username;
    $_SESSION['db_pass'] = $password;
    $conn->close();
    header("Location: dashboard.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <style>
  body {
    font-family: Arial;
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
  }

  input {
    width: 100%;
    padding: 8px;
    margin: 5px 0;
  }

  button {
    width: 100%;
    padding: 10px;
    background: #667eea;
    color: white;
    border: none;
    cursor: pointer;
  }

  .error {
    color: red;
    padding: 10px;
    background: #ffe6e6;
    margin-bottom: 10px;
  }
  </style>
</head>

<body>
  <h2>Task 1 Sol</h2>

  <?php if (isset($error)): ?>
  <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>

  <form method="POST">
    <label>Username:</label>
    <input type="text" name="username" value="root" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
  </form>
</body>

</html>