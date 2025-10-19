<?php
require_once 'config.php';
checkLogin();

$conn = getConnection();
$message = '';

$databases = [];
$result = $conn->query("SHOW DATABASES");
while ($row = $result->fetch_array()) {
  $databases[] = $row[0];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $host = $_POST['host'];
  $selected_db = $_POST['database'];

  $sql = "CREATE USER '$username'@'$host' IDENTIFIED BY '$password'";
  
  if ($conn->query($sql)) {
    if ($selected_db !== 'none') {
      $grant_sql = "GRANT ALL PRIVILEGES ON `$selected_db`.* TO '$username'@'$host'";
      $conn->query($grant_sql);
      $conn->query("FLUSH PRIVILEGES");
    }
    $message = "User created successfully!";
  } else {
    $message = "Error: " . $conn->error;
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Add User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <nav class="navbar navbar-dark bg-primary mb-4">
    <div class="container">
      <span class="navbar-brand">Task 1 Sol</span>
      <a href="dashboard.php" class="btn btn-light btn-sm">Dashboard</a>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5>Add New User</h5>
          </div>
          <div class="card-body">
            <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST">
              <div class="mb-3">
                <label class="form-label">Username *</label>
                <input type="text" class="form-control" name="username" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Password *</label>
                <input type="password" class="form-control" name="password" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Host *</label>
                <input type="text" class="form-control" name="host" value="localhost" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Database </label>
                <select class="form-select" name="database">
                  <option value="none">None</option>
                  <?php foreach ($databases as $db): ?>
                  <option value="<?php echo htmlspecialchars($db); ?>">
                    <?php echo htmlspecialchars($db); ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <button type="submit" class="btn btn-primary">Create User</button>
              <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>