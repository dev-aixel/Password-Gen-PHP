<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .password {
            font-size: 18px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 20px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>パスワード生成</h1>
        <form method="POST">
            <label for="length">パスワードの長さ:</label>
            <input type="number" name="length" id="length" min="4" max="512" required>
            <br>
            <input type="checkbox" name="include_upper" id="include_upper">
            <label for="include_upper">大文字を含む</label>
            <br>
            <input type="checkbox" name="include_lower" id="include_lower">
            <label for="include_lower">小文字を含む</label>
            <br>
            <input type="checkbox" name="include_numbers" id="include_numbers">
            <label for="include_numbers">数字を含む</label>
            <br>
            <input type="checkbox" name="include_symbols" id="include_symbols">
            <label for="include_symbols">記号を含む</label>
            <br><br>
            <button type="submit" name="generate">パスワード生成</button>
        </form>

        <?php
        function generatePassword($length, $include_upper, $include_lower, $include_numbers, $include_symbols) {
            $charset = '';
            $password = '';

            if ($include_upper) {
                $charset .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }
            if ($include_lower) {
                $charset .= 'abcdefghijklmnopqrstuvwxyz';
            }
            if ($include_numbers) {
                $charset .= '0123456789';
            }
            if ($include_symbols) {
                $charset .= '!@#$%^&*()_+-=[]{}|;:,.<>?';
            }

            $charset_length = strlen($charset);

            if ($charset_length === 0) {
                return '少なくとも1つの文字タイプを選択してください。';
            }

            for ($i = 0; $i < $length; $i++) {
                $random_index = rand(0, $charset_length - 1);
                $password .= $charset[$random_index];
            }

            return $password;
        }

        if (isset($_POST['generate'])) {
            $password_length = $_POST['length'];
            $include_uppercase = isset($_POST['include_upper']);
            $include_lowercase = isset($_POST['include_lower']);
            $include_numbers = isset($_POST['include_numbers']);
            $include_symbols = isset($_POST['include_symbols']);

            $generated_password = generatePassword($password_length, $include_uppercase, $include_lowercase, $include_numbers, $include_symbols);

            echo '<div class="password">' . htmlspecialchars($generated_password) . '</div>';
        }
        ?>
        <footer>
            &copy; 2014-2023 @dev_aixel All Rights Reserved.
        </footer>
    </div>
</body>
</html>
