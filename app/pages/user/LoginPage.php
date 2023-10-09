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
    <title>Audibook : Login</title>
</head>
<body>
    <div class="wrapper-small">
        <div class="pad-40">
            <div class="centered">
                <img src="<?= BASE_URL ?>/images/base-logo.svg" alt="Audibook Logo">
                <form 
                    class="form-box center-contents" method="POST"
                    action="/../user/login" 
                >
                    <div class="form-content flex-column">
                        <!-- Username -->
                        <label for="username" class="form-label">Username:</label>
                        <input class="form-field" type="text" 
                            id="username" name="username" placeholder="e.g. moonawar19" required><br>

                        <!-- Password -->
                        <label for="password" class="form-label">Password:</label>
                        <input class="form-field" type="password" 
                        id="password" name="password" placeholder="*****" required><br>

                        <p class="error-msg"><?php 
                            if (isset($this->data['error'])) {
                                echo $this->data['error'];
                            } else {
                                
                            }
                        ?></p><br>

                        <!-- Submit Button -->
                        <input type="submit" class="button green-button" value="Sign In"><br>

                        <p>Don't have an account? <a href="<?= BASE_URL ?>/../user/register"><b>Sign Up Here</b></a>.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>