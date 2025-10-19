<?php
require_once 'config.php';
checkLogin();

$conn = getConnection();

$databases = [];
$result = $conn->query("SHOW DATABASES");
if ($result) {
  while ($row = $result->fetch_array()) {
    $databases[] = $row[0];
  }
}

$users = [];
$result = $conn->query("SELECT User, Host FROM mysql.user ORDER BY User");
if ($result) {
  while ($row = $result->fetch_assoc()) {
    $users[] = $row;
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=
  <meta name=" viewport" content="width=device-width, initial-scale=1.0">
  <title>Task 1 sol</title>
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
    margin-bottom: 20px;
  }

  .card-header {
    background-color: #f8f9fa;
    border-bottom: 2px solid #667eea;
    font-weight: bold;
  }

  .table-container {
    max-height: 400px;
    overflow-y: auto;
  }

  .action-btn {
    margin-right: 10px;
    margin-bottom: 10px;
  }
  </style>
</head>

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-dark mb-4">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">
        Task 1 sol
      </span>
      <div class="d-flex align-items-center">
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">

            <a href="add_database.php" class="btn btn-primary action-btn">
              <i class="bi bi-plus-circle"></i> Add Database
            </a>
            <a href="add_user.php" class="btn btn-success action-btn">
              <i class="bi bi-person-plus"></i> Add User
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Databases List -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <i class="bi bi-database"></i> Databases
          </div>
          <div class="card-body">
            <div class="table-container">
              <table class="table table-hover table-striped">
                <thead class="table-light sticky-top">
                  <tr>
                    <th>#</th>
                    <th>Database Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($databases)): ?>
                  <tr>
                    <td colspan="3" class="text-center text-muted">No databases found</td>
                  </tr>
                  <?php else: ?>
                  <?php foreach ($databases as $index => $db): ?>
                  <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td>
                      <i class="bi bi-database-fill text-primary"></i>
                      <strong><?php echo ($db); ?></strong>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <i class="bi bi-people"></i> Users
          </div>
          <div class="card-body">
            <div class="table-container">
              <table class="table table-hover table-striped">
                <thead class="table-light sticky-top">
                  <tr>
                    <th>#</th>
                    <th>Username</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($users)): ?>
                  <tr>
                    <td colspan="3" class="text-center text-muted">No users found</td>
                  </tr>
                  <?php else: ?>
                  <?php foreach ($users as $index => $user): ?>
                  <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td>
                      <i class="bi bi-person-fill text-success"></i>
                      <strong><?php echo ($user['User']); ?></strong>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>