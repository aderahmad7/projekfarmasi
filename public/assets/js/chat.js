document.getElementById("file-upload").addEventListener("change", function () {
  // Cek apakah ada file yang dipilih
  if (this.files.length > 0) {
    // Kirim form secara otomatis
    document.getElementById("chat-form").submit();
  }
});

// Fungsi untuk men-scroll ke bagian paling bawah halaman
function scrollToBottom() {
  window.scrollTo(0, document.body.scrollHeight);
}

// Jalankan fungsi scrollToBottom saat halaman selesai dimuat
window.onload = scrollToBottom;

setTimeout(function() {
  const alert = document.getElementById('error-alert');
  if (alert) {
      alert.style.opacity = '0'; // Mengubah opacity menjadi 0 untuk memulai fade out

      // Setelah transisi selesai, sembunyikan elemen dari tampilan sepenuhnya
      setTimeout(function() {
          alert.style.display = 'none';
      }, 2000); // Waktu 1000ms untuk menunggu hingga transisi selesai
  }
}, 2000);
