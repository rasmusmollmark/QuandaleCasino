<?php
            $db = new SQLite3("./db/database.db");
            $query = "SELECT Comments.comment, User.username, Comments.commentID 
                      FROM Comments 
                      JOIN User ON Comments.userID = User.userID 
                      ORDER BY Comments.commentID DESC";
            $result = $db->query($query);
            $comments = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $comments[] = $row;
}
            header("Content-Type: application/json");
            echo json_encode($comments);
            $db->close();
            ?>