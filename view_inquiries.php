<?php
// =======================
// DATABASE CONNECTION
// =======================
$conn = new mysqli("localhost", "root", "", "ittab_db");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle Clear All button
if(isset($_POST['clear_all'])){
    $conn->query("TRUNCATE TABLE inquiries");
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch all inquiries
$result = $conn->query("SELECT * FROM inquiries ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ITTab — View Inquiries</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
:root{
  --blue:#0A2A5A;
  --yellow:#FFC300;
}

body{
  font-family:system-ui,Segoe UI,Arial;
  background:linear-gradient(180deg,#071334,#0b2346);
  margin:0;
  padding:0;
}

.container{
  max-width:900px;
  margin:40px auto;
  background:#fff;
  padding:24px;
  border-radius:12px;
  box-shadow:0 15px 30px rgba(0,0,0,.2);
  position:relative; /* allow absolute positioning inside */
}

h1{
  color:var(--blue);
  margin-bottom:20px;
}

table{
  width:100%;
  border-collapse:collapse;
}

table th, table td{
  border:1px solid #ccc;
  padding:12px;
  text-align:left;
}

table th{
  background:var(--yellow);
  color:var(--blue);
}

a.btn, button.btn{
  display:inline-block;
  padding:10px 16px;
  border-radius:8px;
  background:var(--yellow);
  color:var(--blue);
  text-decoration:none;
  font-weight:700;
  border:none;
  cursor:pointer;
}

button.btn:hover, a.btn:hover{
  opacity:0.9;
}

/* Clear All button in upper-right */
.clear-all-btn {
  position:absolute;
  top:24px;
  right:24px;
}
</style>
</head>
<body>

<div class="container">
  <a href="Admin.php" class="btn">back</a>

  <!-- Clear All Form in upper-right -->
  <form method="post" class="clear-all-btn">
      <button type="submit" name="clear_all" class="btn" onclick="return confirm('Are you sure you want to delete all inquiries?')">Clear All</button>
  </form>

  <h1>All Inquiries</h1>

  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Subject</th>
      <th>Message</th>
      <th>Submitted At</th>
    </tr>

    <?php if($result && $result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['id']) ?></td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['subject']) ?></td>
          <td><?= htmlspecialchars($row['message']) ?></td>
          <td><?= htmlspecialchars($row['created_at'] ?? '') ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr>
        <td colspan="6" style="text-align:center;">No inquiries found.</td>
      </tr>
    <?php endif; ?>
  </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
