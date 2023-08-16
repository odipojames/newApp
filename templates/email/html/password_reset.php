<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h1>Password Reset</h1>
    <p>Click the link below to reset your password:</p>
    <!-- hard coded link -->
    <a href="http://localhost:8765/users/resetPassword/<?= $token ?>">
        Reset Password
    </a>
</body>
</html>
