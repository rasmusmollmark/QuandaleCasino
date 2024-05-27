<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="displaycomments.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Comments</title>
    <script>
        function navigateTo(url) {
            window.location.href = url;
        }

        function searchHandler(event) {
            event.preventDefault(); // Prevent form submission reload
            let form = document.forms['searchbar'];
            let search = form['search'].value;
            if (search.length > 0) {
                findSearch(search);
            }
            $('#searchbar')[0].reset();
        }

        
            
            function displayComments(comments) {
                var container = document.getElementById('comments-section');
    container.innerHTML = ''; // Clear the existing comments
                if(comments.length > 0){
                   

    comments.forEach(comment => {
        var commentElement = document.createElement('p');
        commentElement.innerHTML = `<b>${comment.username}:</b> ${comment.comment}`;
        container.appendChild(commentElement);
    });
                }
                else{
                    var commentElement = document.createElement('p');
        commentElement.innerHTML = `<b>Ingen kommentar matchade din sökning!`;
        container.appendChild(commentElement);
                }
    
        }

        function findSearch(searchTerm) {
    $.ajax({
        url: 'searchHandler.php',
        type: 'GET',
        data: { search: searchTerm },
        success: function(response) {
            console.log(response);
            displayComments(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error searching: ', textStatus, errorThrown);
        }
    });
    }
    </script>
</head>
<body>

    <aside id="topbar">
        <div class="topbar-container">
            <img src="NyaQuandale.gif" alt="Qandale Casino Logo" class="topbar-logo" href="./index.php">
            <h1> Kommentarer</h1>
            <div class="button-container">
                <button onclick="navigateTo('weather.php')">Spela</button>
                <button onclick="navigateTo('profile.php')">Profil</button>
                <button onclick="navigateTo('index.php')">Hem</button>
                <button onclick="navigateTo('logOut.php')">Logga ut</button>
                
            </div>
        </div>
    </aside>

    <main class="container">
        
        <section class="commentbox">
            
            <h2>Skriv din kommentar:</h2>
            <form action="addcomment.php" method="post">
                <textarea name="comment" placeholder="Skriv din kommentar här.." required></textarea>
                <button type="Skicka">Submit</button>
            </form>
        </section>

        <section class="commentsection" id="comments-section">
        <form id="searchbar" name="searchbar" method="get" onsubmit="searchHandler(event)">
                <input type="text" placeholder="Sök efter kommentar.." name="search">
                <button id="search-button" type="submit">Sök</button>
            </form>
            <h2>Kommentarsfält</h2>
            <?php
            $db = new SQLite3("./db/database.db");
            $query = "SELECT Comments.comment, User.username 
                      FROM Comments 
                      JOIN User ON Comments.userID = User.userID 
                      ORDER BY Comments.commentID DESC";
            $result = $db->query($query);

            while ($row = $result->fetchArray()) {
                echo "<p><b>{$row['username']}:</b> {$row['comment']}</p>";
            }

            $db->close();
            ?>
            <a href="./index.php" class="home-button">Home</a>
        </section>
    </main>
</body>
</html>
