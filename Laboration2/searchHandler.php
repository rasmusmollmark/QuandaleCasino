<?php
session_start();
if (!isset($_SESSION['USERID'])) {
    header("Location: logOut.php");
    exit();
}

if (!isset($_GET['search']) || empty($_GET['search'])) {
    header('Content-Type: text/plain');
echo ("Error recieve search");
    
}

$searchTerm = $_GET['search'];
$db = new SQLite3("./db/database.db");

// Prepare and execute the SQL statement to search for threads
$stmt = $db->prepare("SELECT Comments.comment, User.username, User.userID 
FROM Comments
JOIN User ON Comments.userID = User.userID
WHERE comment LIKE :searchTerm
ORDER BY Comments.commentID");
$searchTerm = '%' . $searchTerm . '%';
$stmt->bindValue(':searchTerm', $searchTerm, SQLITE3_TEXT);
$result = $stmt->execute();

$comments = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $comments[] = $row;
}
header('Content-Type: application/json');
echo json_encode($comments);
$stmt->close();
$db->close();
?>
