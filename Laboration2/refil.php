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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="refil.css">
    <script>
       function navigateTo(url) {
           window.location.href = url;
       }
   </script>
</head>
<body>

<aside id="topbar">
       <div class="topbar-container">
           <img src="NyaQuandale.gif" alt="Qandale Casino Logo" class="topbar-logo" href="./index.php">
           <h1> Fyll på </h1>
           <div class="button-container">
               <button onclick="navigateTo('casino.php')">Spela</button>
               <button onclick="navigateTo('profile.php')">Profil</button>
               <button onclick="navigateTo('index.php')">Hem</button>
           </div>
       </div>
   </aside>

   <div id="numberField">
  <input type="button" value="-" onclick="decrement()">
  <input type="number" id="numberInput" value="100" min="0" step="50">
  <input type="button" value="+" onclick="increment()">
</div>

<script>
  function decrement() {
    let numberInput = document.getElementById('numberInput');
    if (parseInt(numberInput.value) >= 50) {
      numberInput.value = parseInt(numberInput.value) - 50;
    }
  }

  function increment() {
    let numberInput = document.getElementById('numberInput');
    numberInput.value = parseInt(numberInput.value) + 50;
  }
</script>

</body>
</html>
