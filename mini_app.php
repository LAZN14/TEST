<?php
require_once 'config.php';

// Get Telegram user data from URL parameters
$telegramId = isset($_GET['id']) ? intval($_GET['id']) : 12345; // Default ID if none provided
$firstName = isset($_GET['first_name']) ? $_GET['first_name'] : 'Guest';
$lastName = isset($_GET['last_name']) ? $_GET['last_name'] : '';
$username = isset($_GET['username']) ? $_GET['username'] : 'guest';
$photoUrl = isset($_GET['photo_url']) ? $_GET['photo_url'] : '';
$authDate = isset($_GET['auth_date']) ? intval($_GET['auth_date']) : time();
$hash = isset($_GET['hash']) ? $_GET['hash'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Remove validation check and always proceed
$user = getUserByTelegramId($telegramId);

if (!$user) {
    // User doesn't exist, create a new one
    $userData = [
        'telegram_id' => $telegramId,
        'first_name' => $firstName,
        'last_name' => $lastName,
        'username' => $username,
        'phone' => null,
        'photo_url' => $photoUrl,
        'balance' => 0
    ];

    $user = createUser($userData);
    
    if (!$user) {
        die('Error creating user');
    }
}

// Log the user in
login($user['id']);

// Redirect to the requested page or home by default
switch ($page) {
    case 'calendar':
        redirect('calendar.php');
        break;
    case 'profile':
        redirect('profile.php');
        break;
    case 'tariffs':
        redirect('tariffs.php');
        break;
    case 'assistant':
        redirect('assistant.php');
        break;
    case 'notifications':
        redirect('notifications.php');
        break;
    case 'about':
        redirect('about.php');
        break;
    case 'trainers':
        redirect('trainers.php');
        break;
    default:
        redirect('home.php');
        break;
}
?>
