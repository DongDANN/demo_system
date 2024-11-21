<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="js/validation.js" defer></script>
</head>
<body>
    <h1>Signup</h1> 
    <form method="post" action="components/proc_signup.php" id="signup-form">
    <div>
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    </div>
    <div>
    <label for="phone">Phone</label>
    <input type="phone" name="phone" id="phone">
    </div>
    <div>
    <label for="name">Name</label>
    <input type="name" name="name" id="name">
    </div>
    <div>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" >
    </div>
    <div>
    <label for="confirm-password">Confirm Password</label>
    <input type="confirm-password" name="confirm-password" id="confirm-password" >
    </div>
    <button>Signup</button>
    <div>
    Already have an account?<a href="login.php">login here</a>
    </div>
    </form>
</body>
</html>