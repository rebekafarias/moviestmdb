<?php
require 'config.php';

function searchMovies($query, $page = 1) {
    global $api_key;
    $url = "https://api.themoviedb.org/3/search/movie?api_key=$api_key&query=$query&page=$page&language=en-US&include_adult=false&append_to_response=credits,videos,images";
    $response = file_get_contents($url);
    return json_decode($response, true);
}

if(isset($_GET['query'])) {
    $query = urlencode($_GET['query']);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $result = searchMovies($query, $page);
    $movies = $result['results'];
    $total_pages = $result['total_pages'];
} else {
    $movies = [];
    $total_pages = 0;
}

foreach($movies as $movie) {
    echo '<div class="movie" onclick="openModal('.$movie['id'].', \''.$movie['title'].'\', \''.$movie['overview'].'\', \''.$movie['poster_path'].'\')">';
    echo '<img src="https://image.tmdb.org/t/p/w200'.$movie['poster_path'].'" alt="'.$movie['title'].'">';
    echo '<h3>'.$movie['title'].'</h3>';
    echo '</div>';
}
?>