document.getElementById("file-upload").addEventListener("change", function () {
  // Cek apakah ada file yang dipilih
  if (this.files.length > 0) {
    // Kirim form secara otomatis
    document.getElementById("chat-form").submit();
  }
});
