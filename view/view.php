<?php
use App\Task;
require_once "vendor/autoload.php";
require_once "bootstrap.php";
require_once "./src/DB.php";
require_once "./src/Task.php";
use App\Bot;
$task = new Task();
$bot = new Bot($_ENV['TOKEN']);

$users = $bot->getAllUsers();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    $content = trim($_POST['content']);
    if (!empty($content)) {
        foreach($users as $user){
            $bot->sendPost($_POST['content'], $user['chat_id']);
        }
        $task->add($content);
    }
}


$posts = $task->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }

        h1, h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 100%;
            max-width: 400px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        ul {
            list-style-type: none;
            padding: 0;
            max-width: 400px;
            width: 100%;
        }

        li {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        small {
            color: #777;
        }

        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .status.yuborildi {
            color: #28a745;
            background-color: #e6ffed;
        }

        .status.yuborilmagan {
            color: #dc3545;
            background-color: #ffe6e6;
        }
    </style>
</head>
<body>

<h1>Create Post</h1>
<form action="index.php" method="POST">
    <label for="content">Post:</label>
    <textarea id="content" name="content" maxlength="500" required></textarea>
    <button type="submit">Create</button>
</form>

<h2>All posts</h2>
<ul>
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <li>
                <?= htmlspecialchars($post['content']) ?>
                
                
                
                </span>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Hozircha hech qanday post mavjud emas.</li>
    <?php endif; ?>
</ul>

</body>
</html>
