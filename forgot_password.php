<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Password Reset</h1>
    <form action="components/proc_sms_send.php" method="post">
    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" required>
    <button type="submit">Submit</button>
    </form>
</body>
</html>