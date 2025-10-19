<?php
require_once 'config.php';

checkLogin();

$conn = getConnection();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db_name = trim($_POST['db_name']);

  if (!empty($db_name)) {
    if (preg_match('/^[a-zA-Z0-9_-]+$/', $db_name)) {
      $sql = "CREATE DATABASE `" . $conn->real_escape_string($db_name) . "`";
      if ($conn->query($sql)) {
        $success = "Database '" . htmlspecialchars($db_name) . "' created successfully!";
      } else {
        $error = "Error creating database: " . $conn->error;
      }
    }
  } else {
    $error = "Please enter a database name.";
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Database</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
  body {
    background-color: #f8f9fa;
  }

  .navbar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  }

  .card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
  </style>
</head>

<body>
  <nav class="navbar navbar-dark mb-4">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">
        <i class="bi bi-database-fill"></i> Task 1 sol
      </span>
      <div class="d-flex align-items-center">
        <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">
          <i class="bi bi-house"></i> Dashboard
        </a>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
              <i class="bi bi-plus-circle"></i> Create New Database
            </h5>
          </div>
          <div class="card-body">
            <?php if ($success): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check-circle-fill me-2"></i><?php echo $success; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $error; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <form method="POST" action="">
              <div class="mb-4">
                <label for="db_name" class="form-label">
                  <i class="bi bi-database"></i> Database Name <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control form-control-lg" id="db_name" name="db_name"
                  placeholder="Enter database name" required pattern="[a-zA-Z0-9_-]+"
                  title="Only letters, numbers, underscores, and hyphens are allowed">
              </div>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="dashboard.php" class="btn btn-secondary">
                  <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                  <i class="bi bi-check-circle"></i> Create Database
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>