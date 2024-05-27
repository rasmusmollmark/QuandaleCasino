<?php
session_start();

if (!isset($_SESSION['USERID'])) {
    die("You are not logged in.");
}

$user_id = $_SESSION['USERID'];

$db = new SQLite3("./db/database.db");
$stmt = $db->prepare('SELECT username, currency FROM User WHERE userID = :userID');
$stmt->bindValue(':userID', $user_id, SQLITE3_INTEGER);
$result = $stmt->execute();
$profile = $result->fetchArray(SQLITE3_ASSOC);

if (!$profile) {
    die("User profile not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = intval($_POST['amount']);
    if ($amount > 0) {
        $stmt = $db->prepare('UPDATE User SET currency = currency + :amount WHERE userID = :userID');
        $stmt->bindValue(':amount', $amount, SQLITE3_INTEGER);
        $stmt->bindValue(':userID', $user_id, SQLITE3_INTEGER);
        $stmt->execute();
        header('Location: profile.php');
        exit;
    } else {
        $error = "Please enter a valid amount.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refill Currency</title>
    <link rel="stylesheet" href="refill.css">
    <script>
        function navigateTo(url) {
            window.location.href = url;
        }
    </script>
</head>
<body>

<aside id="topbar">
    <div class="topbar-container">
        <img src="NyaQuandale.gif" alt="Qandale Casino Logo" class="topbar-logo">
        <h1>Refill Currency</h1>
        <div class="button-container">
            <button onclick="navigateTo('weather.php')">Spela</button>
            <button onclick="navigateTo('profile.php')">Profil</button>
            <button onclick="navigateTo('index.php')">Hem</button>
        </div>
    </div>
</aside>

<article id="profileBox">
    <img src="profilepic.png" alt="Profile picture">
    <ul> 
        <li>
            <h3>Användarnamn: <?php echo htmlspecialchars($profile['username']); ?></h3>
        </li>
        <li>
            <form id="refillForm" method="post" action="refill.php">
    
                <input type="number" id="amount" name="amount" required required placeholder="Antal coins att fylla på">
                <button type="submit" id="fillButton">Fyll på</button>
            </form>
            <?php if (isset($error)) {
                echo "<p style='color: red;'>$error</p>";
            } ?>
        </li>
    </ul>
</article>
</body>
</html>
