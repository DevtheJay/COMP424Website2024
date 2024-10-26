<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="box form-box">
        <header>Create a new account</header>
        <form action="" method="post">
            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="field input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="field input">
                    <label for="birth-date">Birth Date - (mm/dd/yyyy)</label>
                    <input type="text" name="birth-date" id="birth-date" required>
            </div>
            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="field input">
                <label for="confirm_password">Confirm Password</label>
                <input type="confirm_password" name="confirm_password" id="confirm_password" required>
            </div>
            <div class="field input">
                <input type="submit" name="submit" class='btn' value="login" required>
            </div>
            <div class="links">
                Already have an account? <a href="index.php">Sign In here</a>
            </div>
        </form>
    </div>
  </div>
</body>
</html>
