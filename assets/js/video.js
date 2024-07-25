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
];

let players = [];
let totalProgress = 0;

function onYouTubeIframeAPIReady() {
    videoData.forEach((video, index) => {
        createVideoElement(video, index);
    });
}

function createVideoElement(video, index) {
    const videoItem = document.createElement("div");
    videoItem.className = "video-item";

    videoItem.innerHTML = `
        <div class="video-thumbnail">
            <div id="player-${index}"></div>
        </div>
        <div class="video-info">
            <div class="video-title">${video.title}</div>
            <div class="video-description">${video.description}</div>
        </div>
    `;

    document.getElementById("videoList").appendChild(videoItem);

    const player = new YT.Player(`player-${index}`, {
        height: "100%",
        width: "100%",
        videoId: video.id,
        events: {
            onStateChange: (event) => onPlayerStateChange(event, index),
        },
    });

    players.push(player);
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
    totalProgress =
        videoData.reduce((sum, video) => sum + (video.progress || 0), 0) /
        videoData.length;

    const progressFill = document.getElementById("progressFill");
    const progressPercentage = document.getElementById("progressPercentage");

    progressFill.style.width = `${totalProgress}%`;
    progressPercentage.textContent = `${Math.round(totalProgress)}% Complete`;

    if (totalProgress >= 99.9) {
        showCompleteButton();
    }
}

function showCompleteButton() {
    const completeButton = document.getElementById("completeButton");
    completeButton.style.display = "block";
}

function initializeCompleteButton() {
    const completeButton = document.getElementById("completeButton");
    completeButton.addEventListener("click", () => {
        alert("Selamat! Anda telah menonton semua video.");
    });
}

initializeCompleteButton();
