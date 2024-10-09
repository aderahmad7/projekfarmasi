// Fungsi untuk menghitung jumlah riwayat per bulan
function hitungJumlahRiwayatPerBulan() {
    const riwayatElements = document.querySelectorAll('.medical-history-data');
    const jumlahPerBulan = new Array(12).fill(0);

    riwayatElements.forEach(element => {
        const tanggal = element.getAttribute('data-tanggal');
        if (tanggal) {
            const bulan = new Date(tanggal).getMonth();
            jumlahPerBulan[bulan]++;
        }
    });

    return jumlahPerBulan;
}

// Inisialisasi dan render chart
const ctx = document.getElementById('barChart').getContext('2d');
const dataRiwayat = hitungJumlahRiwayatPerBulan();

const barChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Jumlah Pemeriksaan',
            data: dataRiwayat,
            backgroundColor: 'rgba(13, 53, 67, 0.6)',
            borderColor: 'rgba(13, 53, 67, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Fungsi untuk memperbarui chart berdasarkan filter tanggal
function updateChartBasedOnDateFilter() {
    const startDateStr = document.getElementById('startDate').value;
    const endDateStr = document.getElementById('endDate').value;
    
    const startDate = startDateStr ? new Date(startDateStr) : new Date(0);
    const endDate = endDateStr ? new Date(endDateStr) : new Date('9999-12-31');

    const filteredData = new Array(12).fill(0);

    document.querySelectorAll('.medical-history-data').forEach(element => {
        const tanggal = new Date(element.getAttribute('data-tanggal'));
        if (tanggal >= startDate && tanggal <= endDate) {
            filteredData[tanggal.getMonth()]++;
        }
    });

    barChart.data.datasets[0].data = filteredData;
    barChart.update();
}
