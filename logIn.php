<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
      session_start();
      $_SESSION["user_id"] = $id;
      header("Location: final.php");
      exit();
    } else {
      echo "Invalid password";
    }
  } else {
    echo "User not found";
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./Style/login.css">
  <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
  <title>LogIn</title>

</head>

<body>
  <div class="container">
    <h2 class="logoName">Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="loginForm">
      <div class="form-control">
        <input type="text" id="username" name="username" required>
        <label for="username">Username</label>
      </div>
      <div class="form-control">
        <input type="password" id="password" name="password" required>
        <label for="password">Password</label>
      </div>
      <div>
        <button type="submit" id="btn" value="Login">LogIn</button>
      </div>
    </form>
  </div>


  <script text="text/javascript">
    const labels = document.querySelectorAll(".form-control label");
    const username = document.querySelectorAll("#username");
    const password = document.querySelectorAll("#password");
    const logInFrom = document.querySelectorAll("#loginForm");
    const btnForm = document.querySelectorAll('#btn');

    // labels.forEach((label) => {
    //   label.innerHTML = label.innerText
    //     .split("").map(
    //       (letter, idx) =>
    //         `<span style="transition-delay:${idx * 150}ms">${letter}</span>`
    //     ).join("");
    // });

    labels.forEach((label) => {
      label.innerHTML = label.innerText
        .split("").map(
          (letter, idx) =>
          `<span style= "transition-delay: ${idx * 50}ms">${letter}</span>`
        ).join("");
    });
  </script>
</body>

</html>
