<?php
require 'config.php';

function getMovieDetails($movie_id) {
    global $api_key;
    $url = "https://api.themoviedb.org/3/movie/$movie_id?api_key=$api_key&append_to_response=credits,videos";
    $response = file_get_contents($url);
    return json_decode($response, true);
}

if(isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];
    $details = getMovieDetails($movie_id);

    $data = [
        'release_date' => $details['release_date'],
        'director' => '',
        'vote_average' => $details['vote_average'],
        'synopsis' => $details['overview'],
        'trailer' => '',
    ];

    foreach ($details['credits']['crew'] as $crew_member) {
        if ($crew_member['job'] === 'Director') {
            $data['director'] = $crew_member['name'];
            break;
        }
    }

    foreach ($details['videos']['results'] as $video) {
        if ($video['type'] === 'Trailer') {
            $data['trailer'] = "https://www.youtube.com/watch?v={$video['key']}";
            break;
        }
    }

    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'Movie ID was not provided.'));
}
?>