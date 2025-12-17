<?php
// =======================
// DATABASE CONNECTION
// =======================
$conn = new mysqli("localhost", "root", "", "ittab_db");

if ($conn->connect_error) {
    die("Database connection failed");
}

// =======================
// HANDLE FORM SUBMISSION
// =======================
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $subject === "" || $message === "") {
        echo "All fields are required";
        exit;
    }

    $stmt = $conn->prepare(
        "INSERT INTO inquiries (name, email, subject, message)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Database error";
    }

    $stmt->close();
    $conn->close();
    exit; // VERY IMPORTANT
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ITTab — Inquiries</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
:root{
  --blue:#0A2A5A;
  --yellow:#FFC300;
}

*{box-sizing:border-box}

body{
  margin:0;
  font-family:system-ui,Segoe UI,Arial;
  background:linear-gradient(180deg,#071334,#0b2346);
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
}

.card{
  background:#fff;
  width:100%;
  max-width:700px;
  border-radius:14px;
  padding:28px;
  box-shadow:0 20px 40px rgba(0,0,0,.3);
}

.header{
  display:flex;
  align-items:center;
  gap:12px;
  margin-bottom:20px;
}

.logo{
  width:48px;
  height:48px;
  background:var(--yellow);
  color:var(--blue);
  border-radius:10px;
  display:flex;
  align-items:center;
  justify-content:center;
  font-weight:900;
  font-size:20px;
}

.form-group{margin-bottom:14px}

label{font-weight:600;font-size:14px}

input, textarea{
  width:100%;
  padding:12px;
  margin-top:6px;
  border-radius:8px;
  border:1px solid #ccc;
}

textarea{height:120px;resize:none}

.actions{
  display:flex;
  justify-content:flex-end;
  gap:10px;
  margin-top:16px;
}

.btn{
  padding:12px 18px;
  border:none;
  border-radius:8px;
  font-weight:700;
  cursor:pointer;
}

.btn.primary{
  background:var(--yellow);
  color:var(--blue);
}

.btn.ghost{
  background:transparent;
  border:1px solid #ccc;
}

.message{margin-top:14px;font-weight:600}
.success{color:green}
.error{color:red}
</style>
</head>

<body>

<div class="card">
 <div style="margin-top:16px; text-align:center;">
  <a href="index.php" class="btn primary" style="text-decoration:none;"> Home</a>
</div>


  <div class="header">
    <div class="logo">IT</div>
    <div>
      <h2>Send an Inquiry</h2>
      <p>We usually reply within 24–48 hours</p>
    </div>
  </div>

  <form id="inquiryForm">
    <div class="form-group">
      <label>Name</label>
      <input name="name" required>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" required>
    </div>

    <div class="form-group">
      <label>Subject</label>
      <input name="subject" required>
    </div>

    <div class="form-group">
      <label>Message</label>
      <textarea name="message" required></textarea>
    </div>

    <div class="actions">
      <button type="reset" class="btn ghost">Reset</button>
      <button type="submit" class="btn primary">Send</button>
    </div>

    <div id="response" class="message"></div>
  </form>
</div>

<script>
document.getElementById("inquiryForm").addEventListener("submit", function(e){
  e.preventDefault();

  const formData = new FormData(this);

  fetch("inquires.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(msg => {
    const r = document.getElementById("response");
    if(msg.trim() === "success"){
      r.textContent = "Inquiry sent successfully!";
      r.className = "message success";
      this.reset();
    }else{
      r.textContent = msg;
      r.className = "message error";
    }
  });
});
</script>

</body>
</html>
