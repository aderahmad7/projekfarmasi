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
let totalProgress = 0;

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
            <div">
                <div class="video-thumbnail">
                    <div id="player-${startIndex + index}"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">${video.title}</h5>
                    <p class="card-text">${video.description}</p>
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

function onPlayerStateChange(event, index) {
    if (event.data === YT.PlayerState.PLAYING) {
        startProgressTracker(index);
    } else if (event.data === YT.PlayerState.PAUSED) {
        stopProgressTracker(index);
    } else if (event.data === YT.PlayerState.ENDED) {
        stopProgressTracker(index);
        videoData[index].progress = 100;
        updateTotalProgress();
    }
}

function startProgressTracker(index) {
    players[index].progressTracker = setInterval(() => {
        updateVideoProgress(index);
    }, 100);
}

function stopProgressTracker(index) {
    clearInterval(players[index].progressTracker);
}

function updateVideoProgress(index) {
    const player = players[index];
    const duration = player.getDuration();
    const currentTime = player.getCurrentTime();
    const videoProgress = (currentTime / duration) * 100;

    videoData[index].progress = videoProgress;
    updateTotalProgress();
}

function updateTotalProgress() {
    let progress =
        videoData.reduce((sum, video) => sum + (video.progress || 0), 0) /
        videoData.length;

    const progressFill = document.getElementById("progressFill");
    const progressPercentage = document.getElementById("progressPercentage");

    if (progress > totalProgress) {
        totalProgress = progress;
        progressFill.style.width = `${totalProgress}%`;
        progressPercentage.textContent = `${Math.round(
            totalProgress
        )}% Complete`;
    }
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

const btnPostTest = document.getElementById("btnPost");

btnPostTest.addEventListener("click", function () {
    if (totalProgress >= 99.5) {
        location.href = "post-test-screen.html";
    } else {
        alert("Finish the video first");
    }
});
