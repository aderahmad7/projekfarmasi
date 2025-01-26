let players = [];
let currentPage = 1;
const videosPerPage = videoData.length;
let currentEditIndex;
let totalProgress = 0;
const baseUrl = "http://localhost/projekfarmasi/public";

console.log(videoData);

// TODO: Data Dummy
videoData.forEach((_, index) => {
  // if (index % 2 == 0) {
  //   videoData[index].watched = true;
  // } else {
  //   videoData[index].watched = false;
  // }

  videoData[index].watched = true;
});

// TODO: Tab Video
const tabs = document.querySelectorAll(".tab");
const contents = document.querySelectorAll(".content");

tabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    // Hapus semua kelas aktif dari tab dan konten
    tabs.forEach((t) => t.classList.remove("active"));
    contents.forEach((c) => c.classList.remove("active"));
    // Tambahkan kelas aktif ke tab dan konten yang dipilih
    tab.classList.add("active");
    const target = tab.getAttribute("data-target");
    console.log(target);
    document.getElementById(target).classList.add("active");

    displayVideos(target);
  });
});

function onYouTubeIframeAPIReady() {
  // TODO : Defaultnya adalah tab 1
  updateTotalProgress();
  displayVideos();
  createPagination();
}

// TODO: Display Video yg baru berdasarkan Tab
function displayVideos(target = "tab1") {
  // const videoList = document.getElementById("videoList");

  // TODO: Jika tab 1 maka akan merender data yang belum ditonton, jika tab 2 maka akan merender data yang sudah ditonton
  if (target === "tab1") {
    const belumDitontonList = document
      .getElementById("tab1")
      .querySelector("#videoList");

    belumDitontonList.innerHTML = "";

    const belumDitonton = videoData.filter((video) => !video.watched);

    renderVideoList(belumDitonton, belumDitontonList);
  } else {
    const sudahDitontonList = document
      .getElementById("tab2")
      .querySelector("#videoList");

    sudahDitontonList.innerHTML = "";

    const sudahDitonton = videoData.filter((video) => video.watched);

    renderVideoList(sudahDitonton, sudahDitontonList);
  }
}

function renderVideoList(videoArray, container) {
  const startIndex = 0;

  if (videoArray.length === 0) {
    container.innerHTML =
      "<h4 class='text-center mt-2'>No videos available.</h4>";
    return;
  }

  videoArray.forEach((video, index) => {
    const videoItem = document.createElement("div");
    videoItem.className = "col";

    videoItem.innerHTML = `
      <div class="card h-100 video-item">
        <div class="video-thumbnail">
          <div id="player-${video.id_link}"></div>
        </div>
        <div class="card-body">
          <h5 class="card-title">${video.title}</h5>
          <p class="card-text">${video.desc}</p>
        </div>
      </div>
    `;

    container.appendChild(videoItem);

    const player = new YT.Player(`player-${video.id_link}`, {
      height: "100%",
      width: "100%",
      videoId: video.id_link,
      events: {
        onStateChange: (event) => {
          // TODO: Hanya akan mengubah progress jika status video belum ditonton
          if (!videoArray[0].watched) {
            onPlayerStateChange(event, startIndex + index);
          }
        },
      },
    });

    console.log(player);

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

    // TODO: Ini adlaah function untuk mengirimkan data progress video dengan id tertentu
    console.log(videoData[index].id);
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
  const belumDitonton = videoData.filter((video) => !video.watched);

  let progress = 0;
  if (belumDitonton.length == 0) {
    progress = 100;
  } else {
    progress =
      videoData.reduce((sum, video) => sum + (video.progress || 0), 0) /
      belumDitonton.length;

    const progressBar = document.getElementById("progressBar");
    const progressPercentage = document.getElementById("progressPercentage");
    const progressFill = document.getElementById("progressFill");
    const progressContainer = document.getElementById("progressContainer");
  }

  if (progress >= 100) {
    progressContainer.style.display = "none";
    // progressPercentage.style.textAlign = "center";
    // progressPercentage.textContent = "Anda sudah menyelesaikan semua video";
  } else {
    totalProgress = progress;
    progressFill.style.width = `${totalProgress}%`;
    progressPercentage.textContent = `${Math.round(totalProgress)}% Complete`;
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
  nextLi.className = `page-item ${currentPage === pageCount ? "disabled" : ""}`;
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
    location.href = `${baseUrl}/posttest/cek`;
  } else {
    alert("Selesaikan video terlebih dahulu");
  }
});
