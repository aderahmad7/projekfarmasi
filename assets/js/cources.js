const videoData = [
    {
        id: "kcnwI_5nKyA",
        title: 'Tutorial REACT "Paling Masuk Akal" untuk PEMULA 🤩🌐',
        description: "Bisa react tanpa belajar js",
    },
    {
        id: "B2ozUF6mTAY",
        title: "Laptop Serba Bisa yg Kencang, Komplit, & Terjangkau: Review Acer Aspire Spin 14 (2024)",
        description: "Laptop andalan nich",
    },
    {
        id: "LcFFh8vISyc",
        title: "PWK - SERING DI JODOHIN SAMA CEWEK-CEWEK YANG DATENG KE PWK, YONO DATENG NGAMUK!!",
        description: "Yono mirip afgan",
    },
    {
        id: "kcnwI_5nKyA",
        title: 'Tutorial REACT "Paling Masuk Akal" untuk PEMULA 🤩🌐',
        description: "Bisa react tanpa belajar js",
    },
    {
        id: "B2ozUF6mTAY",
        title: "Laptop Serba Bisa yg Kencang, Komplit, & Terjangkau: Review Acer Aspire Spin 14 (2024)",
        description: "Laptop andalan nich",
    },
    {
        id: "LcFFh8vISyc",
        title: "PWK - SERING DI JODOHIN SAMA CEWEK-CEWEK YANG DATENG KE PWK, YONO DATENG NGAMUK!!",
        description: "Yono mirip afgan",
    },
    {
        id: "kcnwI_5nKyA",
        title: 'Tutorial REACT "Paling Masuk Akal" untuk PEMULA 🤩🌐',
        description: "Bisa react tanpa belajar js",
    },
    {
        id: "B2ozUF6mTAY",
        title: "Laptop Serba Bisa yg Kencang, Komplit, & Terjangkau: Review Acer Aspire Spin 14 (2024)",
        description: "Laptop andalan nich",
    },
    {
        id: "LcFFh8vISyc",
        title: "PWK - SERING DI JODOHIN SAMA CEWEK-CEWEK YANG DATENG KE PWK, YONO DATENG NGAMUK!!",
        description: "Yono mirip afgan",
    },
];

let players = [];
let currentPage = 1;
const videosPerPage = 6;
let currentEditIndex;

function onYouTubeIframeAPIReady() {
    displayVideos();
    createPagination();
}

function displayVideos() {
    const videoList = document.getElementById("videoList");
    videoList.innerHTML = "";

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
                    <p class="card-text">${video.description}</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary w-auto" onclick="editVideo(${
                        startIndex + index
                    })">Edit</button>
                    <button class="btn btn-sm btn-danger w-auto" onclick="deleteVideo(${
                        startIndex + index
                    })">Delete</button>
                </div>
            </div>
        `;

        videoList.appendChild(videoItem);

        const player = new YT.Player(`player-${startIndex + index}`, {
            height: "100%",
            width: "100%",
            videoId: video.id,
            events: {
                onStateChange: (event) =>
                    onPlayerStateChange(event, startIndex + index),
            },
        });

        players[startIndex + index] = player;
    });
}

function createPagination() {
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
    const link = document.getElementById("newVideoLink").value;
    const id =
        link.split("/")[2] === "www.youtube.com"
            ? newLink.split("?v=")[1]
            : link.split("/")[3].split("?")[0];
    const title = document.getElementById("newVideoTitle").value;
    const description = document.getElementById("newVideoDescription").value;

    if (id && title && description) {
        videoData.push({ id, title, description });
        displayVideos();
        createPagination();
        clearAddVideoForm();
        bootstrap.Modal.getInstance(
            document.getElementById("addVideoModal")
        ).hide();
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
    document.getElementById("editVideoLink").value = `https://www.youtube.com/watch?v=${video.id}`;
    document.getElementById("editVideoTitle").value = video.title;
    document.getElementById("editVideoDescription").value = video.description;
    new bootstrap.Modal(document.getElementById("editVideoModal")).show();
}

function saveEditedVideo() {
    const newLink = document.getElementById("editVideoLink").value;
    const newId =
        newLink.split("/")[2] === "www.youtube.com"
            ? newLink.split("?v=")[1]
            : newLink.split("/")[3].split("?")[0];
    const newTitle = document.getElementById("editVideoTitle").value;
    const newDescription = document.getElementById(
        "editVideoDescription"
    ).value;

    if (newId && newTitle && newDescription) {
        videoData[currentEditIndex].id = newId;
        videoData[currentEditIndex].title = newTitle;
        videoData[currentEditIndex].description = newDescription;
        displayVideos();
        bootstrap.Modal.getInstance(
            document.getElementById("editVideoModal")
        ).hide();
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
