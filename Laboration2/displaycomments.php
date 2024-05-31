<!DOCTYPE html>
<html lang="en">
<head>
    <?php session_start(); ?>
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

        window.onload = function(){
            getComments();
        }

        function removeComment(commentID) {
            $.ajax({
                url: 'removeComment.php',
                type: 'POST',
                data: { commentID: commentID },
                success: function(response) {
                    console.log(response);
                    getComments(); // Refresh the comments after deletion
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error deleting comment: ', textStatus, errorThrown);
                }
            });
        }

        function displayComments(comments) {
            var isAdmin = '<?php echo $_SESSION['ADMIN']; ?>';
            var container = document.getElementById('comments-section');
            container.innerHTML = `<form id="searchbar" name="searchbar" method="get" onsubmit="searchHandler(event)">
                <input type="text" placeholder="Sök efter kommentar.." name="search">
                <button id="search-button" type="submit">Sök</button>
            </form>`;
            if (comments.length > 0) {
                comments.forEach(comment => {
                    var commentElement = document.createElement('p');
                    if (isAdmin) {
                        commentElement.innerHTML = `<b>${comment.username}:</b> ${comment.comment} <br>
                        <button id="remove-button" onclick="removeComment(${comment.commentID})">Ta bort</button>`;
                    } else {
                        commentElement.innerHTML = `<b>${comment.username}:</b> ${comment.comment}`;
                    }
                    container.appendChild(commentElement);
                });
            } else {
                var commentElement = document.createElement('p');
                commentElement.innerHTML = `<b>Ingen kommentar matchade din sökning!`;
                container.appendChild(commentElement);
            }
        }

        function getComments() {
            $.ajax({
                url: 'getComments.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayComments(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error getting comments: ', textStatus, errorThrown);
                }
            });
        }

        function findSearch(searchTerm) {
            $.ajax({
                url: 'searchHandler.php',
                type: 'GET',
                data: { search: searchTerm },
                dataType: 'json',
                success: function(response) {
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
            <img src="NyaQuandale.gif" alt="Qandale Casino Logo" class="topbar-logo">
            <h1>Kommentarer</h1>
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
                <button type="submit">Submit</button>
            </form>
        </section>
        <section class="commentsection" id="comments-section">
            <h2>Kommentarsfält</h2>
            <a href="./index.php" class="home-button">Home</a>
        </section>
    </main>
</body>
</html>
