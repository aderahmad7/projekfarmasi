const ctx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Jumlah Pemeriksaan',
            data: [5, 7, 6, 8, 9, 10, 4, 11, 5, 7, 8, 6], // Ganti dengan data Anda
            backgroundColor: 'rgba(13, 53, 67, 0.6)',
            borderColor: 'rgba(13, 53, 67, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
