<?php include 'common/header.php'; ?>
    <div class="container">
        <h2>Login Form</h2>
        <form name="loginForm" action="login_processor.php" method="POST" onsubmit="return validateLoginForm()">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
<script>
        function validateLoginForm() {
            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;
            var errors = [];

            if (username == "") {
                errors.push("Username is required.");
            }
            if (password == "") {
                errors.push("Password is required.");
            }

            if (errors.length > 0) {
                alert(errors.join("\n"));
                return false;
            }
            return true;
        }
    </script>
</html>