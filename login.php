  <?php
  session_start();
  $conn = new mysqli("localhost", "root", "", "logIn");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Authentication successful
      header("Location: final.html");
      exit();
    } else {
      // Authentication failed
      echo '<script>alert("Invalid username or password");</script>';
    }
  }

  $conn->close();
  ?>
