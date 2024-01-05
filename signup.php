<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
  $stmt->bind_param("ss", $username, $password);

  if ($stmt->execute()) {
    header("Location: logIn.php");
    exit();
  } else {
    echo "Error: " . $stmt->error;
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
  <title>Sign Up</title>

</head>

<body>
  <div class="container">
    <h2 class="logoName">Sign Up</h2>
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
        <button type="submit" id="btn" value="Sign Up">Sign Up</button>
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
