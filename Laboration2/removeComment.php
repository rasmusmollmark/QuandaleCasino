<?php
session_start();
if (isset($_SESSION['ADMIN']) && $_SESSION['ADMIN']) {
    if (isset($_POST['commentID'])) {
        $commentID = $_POST['commentID'];
        // Add database connection
        $db = new SQLite3("./db/database.db");

        $sql = "DELETE FROM comments WHERE commentID = :commentID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam('commentID', $commentID, SQLITE3_TEXT);
        
        if ($stmt->execute()) {
            echo "Comment deleted successfully.";
        } else {
            echo "Error deleting comment.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "No comment ID provided.";
    }
} else {
    echo "Unauthorized access.";
}
?>
