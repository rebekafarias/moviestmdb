<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies TMDb</title>
    <link rel="stylesheet" href="style.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');</style>
</head>
<body>
    <div class="container">
        <h1>Movies TMDb</h1>
        <form method="GET">
            <input type="text" name="query" placeholder="Search movies..." class="search-input">
            <button type="submit" class="search-button">Search</button>
        </form>
        <div class="movies">
            <?php include 'get_movie.php'; ?>
        </div>
        <div class="pagination">
            <?php if ($total_pages > 1): ?>
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?query=<?php echo $query; ?>&page=<?php echo $i; ?>" style="display: inline-block;" <?php if($page == $i) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>
            <?php endif; ?>
        </div>

    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modalContent">
                <img id="modalImg" src="" alt="Movie Poster">
                <div id="movieInfo"></div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <h3 class="footer-text">REBEKA FARIAS</h3>
    </footer>

    <script src="script.js"></script>
</body>
</html>