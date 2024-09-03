<!DOCTYPE html>
<html lang="en">
<?php
// Head
include 'head.php';
?>
<body>
    <form method="post" action="" class="form">
        <div class="form-box">
            <div class="form-value">
                <h2>Login</h2>
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="forget">
                    <label>
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <label>
                        <a href="#">Forgot password?</a>
                    </label>
                </div>
                <button type="submit">Log in</button>
                <div class="register">
                    <p>Don't have an account? <a href="#">Register</a></p>
                </div>
            </div>
        </div>
    </form>

<!-- Footer -->
<?php
include 'footer.php';
?>

<script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</body>
</html>
