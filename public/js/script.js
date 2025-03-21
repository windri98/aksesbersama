// Chart Configuration


$(document).ready(function () {
 
    $(document).on('click', '.triggermodal', function (e) {
        var target = $(this).data('target');
        $('#' + target).css('display', 'flex');
        e.preventDefault();
    });

    $(document).on('click', '.closemodal', function () {
        $(this).closest('.sec_modal').css('display', 'none');
    });

    $(document).on('click', function (event) {
        var target = $(event.target);
        if (!target.closest('.logincontainer').length && !target.closest('.triggermodal').length) {
            $('.sec_modal').css('display', 'none');
        }
    });
});

  function closeModal() {
    $('.sec_modal').css('display', 'none'); // Tutup semua modal
  }

  document.addEventListener('DOMContentLoaded', () => {
    const successModal = document.getElementById('shownotifsuccess');
    const errorModal = document.getElementById('shownotifwrong');
    const NotifModal = document.getElementById('shownotifnotif');
        if (successModal) {
            setTimeout(() => {
                successModal.style.display = 'none';
            }, 1500);
        }
        else if (errorModal) {
            setTimeout(() => {
                errorModal.style.display = 'none';
            }, 5000);
        }
        else if (NotifModal) {
            setTimeout(() => {
                NotifModal.style.display = 'none';
            }, 3000);
        }
});



// Fungsi untuk mendapatkan label 6 bulan terakhir
function getLastSixMonths() {
    const labels = [];
    const today = new Date();
    for (let i = 5; i >= 0; i--) {
        const date = new Date(today.getFullYear(), today.getMonth() - i, 1);
        const month = date.toLocaleString('default', { month: 'short' }); // Nama bulan (Jan, Feb, ...)
        labels.push(month);
    }
    return labels;
}


//const bookingCounts = [626, 1437, 1803, 378, 1908, 1000]; // Ubah sesuai data backend
// Inisialisasi Chart.js
const ctx = document.getElementById('bookingChart').getContext('2d');
const bookingChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: getLastSixMonths(), // Menggunakan fungsi untuk mendapatkan label
        datasets: [{
            data: [], // Data awal kosong
            backgroundColor: [
                '#7c4dff',
                '#ff6b6b',
                '#4ecdc4',
                '#ffbe0b',
                '#4361ee',
                '#2ecc71'
            ],
            label: 'Jumlah Booking',
            borderWidth: 0,
            borderRadius: 5
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Jumlah Booking',
                color: '#E4C59E',
                font: {
                    size: 16
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#444'
                },
                ticks: {
                    color: '#E4C59E'
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#E4C59E'
                }
            }
        }
    }
});

fetch(`${apiBaseUrl}/bookings/last-six-months`)
    .then(response => response.json())
    .then(data => {
        const labels = data.map(item => item.month);
        const counts = data.map(item => item.count);
        bookingChart.data.labels = labels;
        bookingChart.data.datasets[0].data = counts;
        bookingChart.update();
    });
// const ctx = document.getElementById('bookingChart').getContext('2d');
// const bookingChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
//         datasets: [{
//             data: [626, 1437, 1803, 378, 1908, 1000],
//             backgroundColor: [
//                 '#7c4dff',
//                 '#ff6b6b',
//                 '#4ecdc4',
//                 '#ffbe0b',
//                 '#4361ee',
//                 '#2ecc71'
//             ],
//             label: 'Jumlah Booking',
//             borderWidth: 0,
//             borderRadius: 5
//         }]
//     },
//     options: {
//         responsive: true,
//         maintainAspectRatio: false,
//         plugins: {
//             legend: {
//                 display: false
//             },
//             title: {
//                 display: true,
//                 text: 'Jumlah Booking',
//                 color: '#E4C59E',
//                 font: {
//                     size: 16
//                 }
//             }
//         },
//         scales: {
//             y: {
//                 beginAtZero: true,
//                 grid: {
//                     color: '#444'
//                 },
//                 ticks: {
//                     color: '#E4C59E'
//                 }
//             },
//             x: {
//                 grid: {
//                     display: false
//                 },
//                 ticks: {
//                     color: '#E4C59E'
//                 }
//             }
//         }
//     }
// });

// Chart Configuration2
const ctx2 = document.getElementById('doughnut').getContext('2d');

// Inisialisasi Chart.js
const doughnut = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: [], // Label fasilitas
        datasets: [{
            label: '# of Bookings',
            data: [], // Data jumlah booking
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            },
            title: {
                display: true,
                text: 'Jumlah Booking Berdasarkan Fasilitas'
            }
        }
    }
});

// Fungsi untuk mengambil data dari backend
function fetchData(filterType) {
    const endpoint = `${apiBaseUrl}/bookings/${filterType}`; // Endpoint backend sesuai filter
   
    fetch(endpoint)
        .then(response => response.json())
        .then(data => {
            // Update data chart
            doughnut.data.labels = data.map(item => item.fasilitas); // Fasilitas
            doughnut.data.datasets[0].data = data.map(item => item.bookings); // Jumlah booking
            doughnut.update(); // Render ulang chart
        })

        .catch(error => console.error('Error fetching data:', error));
}

// Event untuk tombol filter
document.getElementById('filterMonth').addEventListener('click', () => {
    fetchData('last-month'); // Panggil data 1 bulan terakhir
});

document.getElementById('filterYear').addEventListener('click', () => {
    fetchData('last-year'); // Panggil data 12 bulan terakhir
});

// Muat data default (1 bulan terakhir)
fetchData('last-month');

// const ctx2 = document.getElementById('doughnut').getContext('2d');
// const doughnut = new Chart(ctx2, {
//     type: 'doughnut',
//     data: {
//         labels: ['Meeting room', 'Playstation 4', 'Playstation 5'], 
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 10, 5, 8, 3],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });





// Add click event for sidebar items
document.querySelectorAll('.sidebar nav ul li').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelectorAll('.sidebar nav ul li').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
    });
});

