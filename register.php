
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        #password-strength {
            margin-top: 5px;
            font-weight: bold;
        }

        .requirement {
            color: red;
            font-size: 0.9em;
            list-style: none;
            padding: 5px 0;
        }

        .requirement.met {
            color: green;
            text-decoration: line-through;
        }
    </style>
</head>
<body>
  <div class="container">
    <div class="box form-box">
        <?php
        include("php/config.php");
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $Fname = $_POST['Fname'];
            $Lname = $_POST['Lname'];
            $birth_date = $_POST['Birth_date'];
            $question1 = $_POST['question1'];
            $question2 = $_POST['question2'];
            $question3 = $_POST['question3'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Convert birth date from mm-dd-yyyy to yyyy-mm-dd
            $date_parts = explode('-', $birth_date);
            if (count($date_parts) == 3) {
                $birth_date = $date_parts[2] . '-' . $date_parts[0] . '-' . $date_parts[1];
            } else {
                echo "<div class='message'><p>Invalid date format! Please enter the date in the format mm-dd-yyyy.</p></div>";
                exit;
            }

            // Verifying unique email
            $verify_query= mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
            if(mysqli_num_rows($verify_query) != 0){
                echo "<div class='message'><p>Email already exists! Try another one!</p></div><br>";
            } else {
                // Check if passwords match
                if($password !== $confirm_password){
                    echo "<div class='message'><p>Passwords do not match!</p></div><br>";
                    echo "<a href='javascript:self.history.back();'><button class='btn'>Go Back</button></a>";
                } else {
                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    // Insert user into database
                    $insert_query = mysqli_query($con, "INSERT INTO users (Username, Email, Birth_date, PASSWORD, question1, question2, question3, Fname, Lname) VALUES ('$username', '$email', '$birth_date', '$hashed_password', '$question1', '$question2', '$question3', '$Fname', '$Lname')");
                    if($insert_query){
                        echo "<div class='message'><p>Registration successful! You can now <a href='index.php'>login</a>.</p></div>";
                    } else {
                        echo "<div class='message'><p>Something went wrong! Please try again later.</p></div>";
                    }
                }
            }
        }
        ?>
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
                <label for="Fname">First Name</label>
                <input type="text" name="Fname" id="Fname" required>
            </div>
            <div class="field input">
                <label for="Lname">Last Name</label>
                <input type="text" name="Lname" id="Lname" required>
            </div>
            <div class="field input">
                <label for="Birth_date">Birth Date - (mm-dd-yyyy)</label>
                <input type="text" name="Birth_date" id="Birth_date" pattern="\d{2}-\d{2}-\d{4}" title="Please enter the date in the format mm-dd-yyyy" required>
            </div>
            <div class="field input">
                <label for="question1">Security Question 1: What is your favorite animal?</label>
                <input type="text" name="question1" id="question1" required>
            </div>
            <div class="field input">
                <label for="question2">Security Question 2: What is your favorite food?</label>
                <input type="text" name="question2" id="question2" required>
            </div>
            <div class="field input">
                <label for="question3">Security Question 3: What is the city you were born?</label>
                <input type="text" name="question3" id="question3" required>
            </div>
            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <p id="password-strength">Password Strength: Weak</p>
            </div>
            <ul id="password-requirements">
                <li class="requirement" id="length">At least 8 characters</li>
                <li class="requirement" id="uppercase">At least 1 uppercase letter</li>
                <li class="requirement" id="lowercase">At least 1 lowercase letter</li>
                <li class="requirement" id="number">At least 1 number</li>
                <li class="requirement" id="special">At least 1 special character</li>
            </ul>
            <div class="field input">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <p id="password-match" style="color: red;"></p> <!-- Password match indicator -->
            <div class="field input">
                <input type="submit" name="submit" class='btn' value="Sign Up" required>
            </div>
            <div 
                class="cf-turnstile" data-sitekey="3x00000000000000000000FF"></div>
                <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
            </div>
            <div class="links">
                Already have an account? <a href="index.php">Sign In here</a>
            </div>
        </form>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const passwordMatchMessage = document.getElementById('password-match');
        const strengthText = document.getElementById('password-strength');

        // Function to check if passwords match
        function checkPasswordMatch() {
            if (confirmPasswordInput.value === passwordInput.value && confirmPasswordInput.value.length > 0) {
                passwordMatchMessage.textContent = "Passwords match!";
                passwordMatchMessage.style.color = "green";
            } else if (confirmPasswordInput.value.length > 0) {
                passwordMatchMessage.textContent = "Passwords do not match";
                passwordMatchMessage.style.color = "red";
            } else {
                passwordMatchMessage.textContent = '';
            }
        }

        // Function to check password requirements
        function checkPasswordRequirements() {
            const password = passwordInput.value;
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /\d/.test(password),
                special: /[^A-Za-z0-9]/.test(password)
            };

            for (let [key, met] of Object.entries(requirements)) {
                const requirement = document.getElementById(key);
                requirement.classList.toggle("met", met);
                requirement.style.display = met ? "none" : "list-item";
            }
        }

        // Function to check password strength
        function checkPasswordStrength() {
            const password = passwordInput.value;
            let strength = 'Weak';

            if (password.length >= 8 &&
                /[A-Z]/.test(password) &&
                /[a-z]/.test(password) &&
                /\d/.test(password) &&
                /[^A-Za-z0-9]/.test(password)) {
                strength = 'Strong';
                strengthText.style.color = 'green';
            } else if (password.length >= 6) {
                strength = 'Moderate';
                strengthText.style.color = 'orange';
            } else {
                strengthText.style.color = 'red';
            }

            strengthText.textContent = `Password Strength: ${strength}`;
        }

        // Add event listeners for real-time checking
        passwordInput.addEventListener('input', () => {
            checkPasswordMatch();
            checkPasswordRequirements();
            checkPasswordStrength();
        });
        confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    });
  </script>

</body>
</html>
