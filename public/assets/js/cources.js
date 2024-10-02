let players = [];
let currentPage = 1;
const videosPerPage = 6;
let currentEditIndex;
const baseUrl = 'http://localhost/projekfarmasi/public';

function onYouTubeIframeAPIReady() {
    displayVideos();
    createPagination();
}

function displayVideos() {
    const videoList = document.getElementById("videoList");
    videoList.innerHTML = "";

    if (videoData.length === 0) {
        videoList.innerHTML = "<p>Tidak ada video yang tersedia. Tambahkan beberapa!</p>";
        return;
    }

    const startIndex = (currentPage - 1) * videosPerPage;
    const endIndex = startIndex + videosPerPage;
    const pageVideos = videoData.slice(startIndex, endIndex);

    pageVideos.forEach((video, index) => {
        const videoItem = document.createElement("div");
        videoItem.className = "col";

        videoItem.innerHTML = `
            <div class="card h-100 video-item">
                <div class="video-thumbnail">
                    <div id="player-${startIndex + index}"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">${video.title}</h5>
                    <p class="card-text">${video.desc}</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary w-auto" onclick="editVideo(${startIndex + index})">Edit</button>
                    <a href="${baseUrl}/course/delete_course/${video.id}" class="btn btn-sm btn-danger w-auto" onclick="return confirm('Are you sure you want to delete this video?');">Hapus</a>
                </div>
            </div>
        `;

        videoList.appendChild(videoItem);

        const player = new YT.Player(`player-${startIndex + index}`, {
            height: "100%",
            width: "100%",
            videoId: video.id_link,
            events: {
                onStateChange: (event) => onPlayerStateChange(event, startIndex + index),
            },
        });

        players[startIndex + index] = player;
    });
}

function createPagination() {
    if (videoData.length === 0) {
        return;
    }
    const paginationContainer = document.getElementById("pagination");
    paginationContainer.innerHTML = "";

    const pageCount = Math.ceil(videoData.length / videosPerPage);

    // Previous button
    const prevLi = document.createElement("li");
    prevLi.className = `page-item ${currentPage === 1 ? "disabled" : ""}`;
    prevLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${
        currentPage - 1
    })" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>`;
    paginationContainer.appendChild(prevLi);

    // Page numbers
    for (let i = 1; i <= pageCount; i++) {
        const pageItem = document.createElement("li");
        pageItem.className = `page-item ${i === currentPage ? "active" : ""}`;
        pageItem.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
        paginationContainer.appendChild(pageItem);
    }

    // Next button
    const nextLi = document.createElement("li");
    nextLi.className = `page-item ${
        currentPage === pageCount ? "disabled" : ""
    }`;
    nextLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${
        currentPage + 1
    })" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>`;
    paginationContainer.appendChild(nextLi);
}

function changePage(page) {
    const pageCount = Math.ceil(videoData.length / videosPerPage);
    if (page < 1 || page > pageCount) return;

    currentPage = page;
    displayVideos();
    createPagination();
    scrollToTop();
}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
}

function showCompleteButton() {
    const completeButton = document.getElementById("completeButton");
    completeButton.classList.remove("d-none");
}

function addVideo() {
    const url = `${baseUrl}/course/add_course`;
    const link = document.getElementById("newVideoLink").value;
    const id_link = link.split("/")[2] === "www.youtube.com"
        ? link.split("?v=")[1]
        : link.split("/")[3].split("?")[0];
    const title = document.getElementById("newVideoTitle").value;
    const desc = document.getElementById("newVideoDescription").value;

    if (id_link && title && desc) {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id_link, title, desc }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                videoData.push({ id: data.id, id_link, title, desc });
                displayVideos();
                createPagination();
                clearAddVideoForm();
                bootstrap.Modal.getInstance(document.getElementById("addVideoModal")).hide();
            } else {
                alert("Failed to add video");
            }
        });
    } else {
        alert("Please fill all fields");
    }
}

function clearAddVideoForm() {
    document.getElementById("newVideoLink").value = "";
    document.getElementById("newVideoTitle").value = "";
    document.getElementById("newVideoDescription").value = "";
}

function editVideo(index) {
    currentEditIndex = index;
    const video = videoData[index];
    document.getElementById("editVideoLink").value = `https://www.youtube.com/watch?v=${video.id_link}`;
    document.getElementById("editVideoTitle").value = video.title;
    document.getElementById("editVideoDescription").value = video.desc;
    document.getElementById("editVideoId").value = video.id; // Tambahkan input hidden untuk menyimpan id
    new bootstrap.Modal(document.getElementById("editVideoModal")).show();
}

function saveEditedVideo() {
    const url = `${baseUrl}/course/edit_course/${document.getElementById("editVideoId").value}`;
    const link = document.getElementById("editVideoLink").value;
    const id_link = link.split("/")[2] === "www.youtube.com"
        ? link.split("?v=")[1]
        : link.split("/")[3].split("?")[0];
    const title = document.getElementById("editVideoTitle").value;
    const desc = document.getElementById("editVideoDescription").value;

    if (id_link && title && desc) {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id_link, title, desc }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update videoData array
                videoData[currentEditIndex] = { ...videoData[currentEditIndex], id_link, title, desc };
                displayVideos();
                createPagination();
                bootstrap.Modal.getInstance(document.getElementById("editVideoModal")).hide();
            } else {
                alert("Failed to update video");
            }
        });
    } else {
        alert("Please fill all fields");
    }
}

function deleteVideo(index) {
    if (confirm("Are you sure you want to delete this video?")) {
        videoData.splice(index, 1);
        displayVideos();
        createPagination();
    }
}

// Initialize
onYouTubeIframeAPIReady();
