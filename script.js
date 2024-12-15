function openModal(movie_id, title, overview, poster_path) {
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("modalImg");
    var movieInfo = document.getElementById("movieInfo");
    modal.style.display = "block";
    modalImg.src = "https://image.tmdb.org/t/p/w500" + poster_path;

    fetch('get_movie_details.php?movie_id=' + movie_id)
    .then(response => response.json())
    .then(data => {
        movieInfo.innerHTML = `
            <h2>${title}</h2>
            <p><strong>Release Date:</strong> ${data.release_date}</p>
            <p><strong>Director:</strong> ${data.director}</p>
            <p><strong>Rating:</strong> ${data.vote_average}</p>
            <p>${data.synopsis}</p>
            ${data.trailer ? `<p><a href="${data.trailer}" target="_blank" class="button">Watch Trailer</a></p>` : ''}`;
    })
    .catch(error => {
        console.error('Error fetching movie details:', error);
        movieInfo.innerHTML = `<h2>${title}</h2><p>${overview}</p>`;
    });
}


function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}