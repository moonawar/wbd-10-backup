<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="180x180" href="<?= BASE_URL ?>/icon/favicon-110.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/icon/favicon-32.png">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/globals.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/auth.css">
    <title>Audibook : Logout</title>
</head>
<body>
    <div class="wrapper-small">
        <div class="pad-40">
            <div class="centered">
                <form 
                    class="center-contents" method="POST"
                    action="/../user/logout" 
                >
                    <div class="form-content flex-column">
                        <!-- Submit Button -->
                        <input type="submit" class="button green-button" value="Sign Out"><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>