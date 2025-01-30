let players = [];
let currentPage = 1;
const videosPerPage = videoData.length;
let currentEditIndex;
let totalProgress = 0;
const baseUrl = "http://localhost/projekfarmasi/public";

// TODO: Data Dummy
videoData.forEach((_, index) => {
  if (videoData[index].watched === true) {
    videoData[index].watched = true;
  } else {
    videoData[index].watched = false;
  }

  // videoData[index].watched = true;
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
  const container = document.getElementById(target).querySelector("#videoList");
  container.innerHTML = "";

  // Filter tanpa membuat array baru
  const filteredVideos = videoData
    .map((video, originalIndex) => ({ ...video, originalIndex }))
    .filter((video) => (target === "tab1" ? !video.watched : video.watched));

  renderVideoList(filteredVideos, container);
}

function renderVideoList(filteredVideos, container) {
  if (filteredVideos.length === 0) {
    container.innerHTML = "<h4 class='text-center mt-2'>Tidak ada video.</h4>";
    return;
  }

  filteredVideos.forEach((video) => {
    const videoItem = document.createElement("div");
    videoItem.className = "col";

    // Gunakan originalIndex dari videoData asli
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
          if (!video.watched) {
            onPlayerStateChange(event, video.originalIndex); // Gunakan index asli
          }
        },
      },
    });

    players[video.originalIndex] = player; // Simpan berdasarkan index asli
  });
}

function onPlayerStateChange(event, index) {
  if (event.data === YT.PlayerState.PLAYING) {
    startProgressTracker(index);
  } else if (event.data === YT.PlayerState.PAUSED) {
    stopProgressTracker(index);
  } else if (event.data === YT.PlayerState.ENDED) {
    stopProgressTracker(index);

    // TODO: Ini adlaah function untuk mengirimkan data progress video dengan id tertentu
    saveWatched(videoData[index]);

    // menambahkan sweet alert
    Swal.fire({
      position: "center",
      icon: "success",
      title: "Selamat",
      text: "Anda telah menyelesaikan video ini!",
      // showConfirmButton: false,
      // timer: 1500,
      // ubah warna confirmation
      confirmButtonColor: "#164150",
    }).then((result) => {
      if (result.isConfirmed) {
        location.reload(true);
      }
    });

    //location.reload(true);
    // setTimeout(() => {
    //   location.reload(true);
    // }, 1500); // 1500 milidetik = 1.5 detik
  }
}

function saveWatched(dataVideo) {
  const url = `${baseUrl}/course/tonton_course`;
  const id_course = dataVideo.id;
  const id_user = dataVideo.id_user;

  if (id_course && id_user) {
    fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id_user, id_course }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          //tulis disini
        } else {
          alert("Gagal update progress");
        }
      });
  } else {
    alert("Please fill all fields");
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
  const sudahDitonton = videoData.filter((video) => video.watched);
  const progressBar = document.getElementById("progressBar");
  const progressPercentage = document.getElementById("progressPercentage");
  const progressFill = document.getElementById("progressFill");
  const progressContainer = document.getElementById("progressContainer");

  let progress = 0;
  if (sudahDitonton.length == 0) {
    progress = 0;
  } else {
    progress = (sudahDitonton.length / videoData.length) * 100;
  }

  // progress awal
  totalProgress = progress;

  // progress video saat ini
  let currentProgress =
    belumDitonton.reduce((sum, video) => sum + (video.progress || 0), 0) /
    videoData.length;

  // menambahkan progress awal dengan progress video saat ini
  totalProgress += currentProgress;

  if (progress >= 100) {
    progressContainer.style.display = "none";
    // progressPercentage.style.textAlign = "center";
    // progressPercentage.textContent = "Anda sudah menyelesaikan semua video";
  } else {
    progressFill.style.width = `${totalProgress}%`;
    progressPercentage.textContent = `${Math.round(totalProgress)}% Complete`;
  }
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
