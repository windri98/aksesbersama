document.addEventListener("DOMContentLoaded", function () {
  
    if (window.location.pathname === "/halaman-dengan-AM") {
        const amTimes = document.getElementById("AM-times");
        const amBtn = document.getElementById("AM-btn");

        if (amTimes && amBtn) {
            amTimes.classList.remove("hidden");
            amBtn.classList.add("selected");
        }
    }
    const datetimePicker1 = document.querySelector('#datetimepicker1');
    const datetimePicker2 = document.querySelector('#datetimepicker2');
    let selectedDate = '';
    let globalDatesWithData = [];

if (typeof idFasilitas !== "undefined" && idFasilitas !== null) {

    async function fetchUnavailableDates(apiUrl, idFasilitas) {

        if (!idFasilitas) {
            console.error("ID Fasilitas tidak tersedia.");
            return [];
        }

        try {
            const response = await fetch(`${apiUrl}?id_fasilitas=${idFasilitas}`);
            if (response.ok) {
                const { unavailable_dates } = await response.json();
                
                globalDatesWithData = unavailable_dates || [];
                colorDatesWithData(globalDatesWithData);

                return unavailable_dates || [];
            } else {
                console.error("Gagal mendapatkan unavailable dates:", response.status);
                return [];
            }
        } catch (error) {
            console.error("Error fetching unavailable dates:", error);
            return [];
        }
    }
    
    function colorDatesWithData(datesWithData) {
        const dateCounts = datesWithData.reduce((counts, date) => {
            counts[date] = (counts[date] || 0) + 1;
            return counts;
        }, {});
    
        setTimeout(() => {
            const flatpickrDays = document.querySelectorAll(".flatpickr-day");
            if (!flatpickrDays || flatpickrDays.length === 0) {
                console.warn("Elemen flatpickr-day tidak ditemukan.");
                return;
            }
    
            flatpickrDays.forEach(dayElement => {
                const ariaLabel = dayElement.getAttribute("aria-label");
                if (!ariaLabel) return;

                const dayDate = new Date(ariaLabel).toLocaleDateString('en-CA');
    
                if (dateCounts[dayDate]) {
                    if (dateCounts[dayDate] === 24) {
                        dayElement.classList.add("highlighted-full-day");
                    } else {
                        dayElement.classList.add("highlighted-date");
                    }
                }
            });
        }, 100);
    }
    

    // async function fetchUnavailableTimesAndDisable(date, idFasilitas) {
    //     if (!date || !idFasilitas) {
    //         console.error("Tanggal atau ID Fasilitas tidak tersedia.");
    //         return;
    //     }
    
    //     try {
    //         const response = await fetch(
    //             `https://int-mnr-21.bostoni.pro/api/unavailable-times?date=${date}&id_fasilitas=${idFasilitas}`
    //         );
    
    //         if (response.ok) {
    //             const { unavailable_times } = await response.json();
    //             disableUnavailableTimes(unavailable_times);
    //         } else {
    //             console.error("Gagal mendapatkan unavailable times:", response.status);
    //         }
    //     } catch (error) {
    //         console.error("Error fetching unavailable times:", error);
    //     }
    // }
    

    // function disableUnavailableTimes(unavailableTimes) {
    //     const timeElements = document.querySelectorAll('.subwaktu');
    //     timeElements.forEach(element => {
    //         const formattedTime = formatTime(element.querySelector('span').textContent.trim());
    //         const isUnavailable = unavailableTimes.some(({ start_time }) => {
    //             return formatTime(start_time.split(":").slice(0, 2).join(":")) === formattedTime;
    //         });
    //             element.classList.toggle('disabled', isUnavailable);
    //             element.style.pointerEvents = isUnavailable ? 'none' : 'auto';
    //         });
    //     }

    async function fetchUnavailableTimesAndDisable(date, idFasilitas) {
        if (!date || !idFasilitas) {
            console.error("Tanggal atau ID Fasilitas tidak tersedia.");
            return;
        }
    
        try {
            
            const response = await fetch(
                `${apiBaseUrl}/unavailable-times?date=${date}&id_fasilitas=${idFasilitas}`
            );
    
            if (response.ok) {
                const { unavailable_times } = await response.json();
                const timeElements = document.querySelectorAll('.subwaktu');

                if (timeElements.length > 0) {
                    const now = new Date();
                    const todayDate = now.toISOString().split("T")[0]; // Format "YYYY-MM-DD"
                    // const currentHour = now.getHours();
                    // const currentMinutes = now.getMinutes();
                    // function formatTimeToDisable(hour, minute) {
                    //     return `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                    // }
                    if (date === todayDate) {
                    //const currentHour = now.getHours();
                    //const currentMinutes = now.getMinutes();
                    //const oneHourLater = new Date(now.getTime() + 60 * 60 * 1000);
                    //const disableTimeStart = formatTimeToDisable(currentHour, currentMinutes);
                    //const disableTimeEnd = formatTimeToDisable(oneHourLater.getHours(), oneHourLater.getMinutes());
                    // disableTimeStart = formatTimeToDisable(0, 0); // Pastikan dimulai dari 00:00
                    //const disableTimeEnd = formatTimeToDisable(currentHour, currentMinutes);
                    //const disableTimeStart =`${'0'.toString().padStart(2, '0')}:00`;
                    const tenMinutesAgo = new Date(now.getTime() - 10 * 60 * 1000);
                    const disableTimeStart = "00:00";
                    const roundedHour = tenMinutesAgo.getMinutes() === 0 ? tenMinutesAgo.getHours() : tenMinutesAgo.getHours();
                    //const roundedHour = now.getMinutes() === 0 ? now.getHours() : now.getHours() ;
                    const disableTimeEnd = `${roundedHour.toString().padStart(2, '0')}:00`;
                    //console.log("Tanggal hari ini:", todayDate);
                    //console.log("Rounded Hour:", roundedHour);
                    //console.log("Time Range:", roundedHour, "-", disableTimeEnd ,tenMinutesAgo);

                        timeElements.forEach(element => {
                            const formattedTime = formatTime(element.querySelector('span').textContent.trim());
                            const isUnavailable =
                                unavailable_times.some(({ start_time }) => {
                                    return formatTime(start_time.split(":").slice(0, 2).join(":")) === formattedTime;
                                }) ||
                                (formattedTime >= disableTimeStart && formattedTime <= disableTimeEnd);
                
                            element.classList.toggle('disabled', isUnavailable);
                            element.style.pointerEvents = isUnavailable ? 'none' : 'auto';

                        });
                    } else {
                        timeElements.forEach(element => {
                            const formattedTime = formatTime(element.querySelector('span').textContent.trim());
                            const isUnavailable = unavailable_times.some(({ start_time }) => {
                                return formatTime(start_time.split(":").slice(0, 2).join(":")) === formattedTime;
                            });
                            element.classList.toggle('disabled', isUnavailable);
                            element.style.pointerEvents = isUnavailable ? 'none' : 'auto';
                        });
                    }
                
                } else {
                    //console.log("Elemen .subwaktu tidak ditemukan, menangani elemen .subwaktujdl");
                    const timeElementsJdl = document.querySelectorAll('.subwaktujdl');
                    timeElementsJdl.forEach(element => {
                        const formattedTime = element.querySelector('span').textContent.trim();
                        const isUnavailable = unavailable_times.some(({ start_time }) => start_time === formattedTime);
                        element.classList.toggle('disabled', isUnavailable);
                        element.style.pointerEvents = isUnavailable ? 'none' : 'auto';
                    });
                }
            } else {
                console.error("Gagal mendapatkan unavailable times:", response.status);
            }
        } catch (error) {
            console.error("Error fetching unavailable times:", error);
        }
    }
    
    function formatTime(time) {
        return time.replace(":", ".");
    }
    // function formatTime(time) {
    //     const [hours, minutes] = time.split(":");
    //     return `${hours.padStart(2, '0')}:${minutes.padStart(2, '0')}`;
    // }
    
    async function fetchBookingsByDate(date, idFasilitas) {
        try {
            const response = await fetch(
                `${apiBaseUrl}/myriquesbeliar?date=${date}&id_fasilitas=${idFasilitas}`
            );
            
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();
            return {
                bookings: data.bookings || [],
                formattedDate: data.date || "",
            };

            } catch (error) {
                console.error("Error fetching bookings:", error);
                return { bookings: [], formattedDate: "" };
            }
        }

    async function handleDateChange(dateStr, pickerToClear, dateInputId) {
        if (dateStr) {
            pickerToClear.clear();
            document.getElementById(dateInputId).value = dateStr;
            await fetchUnavailableTimesAndDisable(dateStr, idFasilitas);
            const { bookings, formattedDate } = await fetchBookingsByDate(dateStr, idFasilitas);
            const detailJamContainer = document.querySelector(".detailjam-container");
            const tangglContainer = document.querySelector(".subsectionjudul");

            detailJamContainer.innerHTML = "";
            tangglContainer.innerHTML = `<h3>Tanggal ${formattedDate}</h3>`;

            if (bookings.length > 0) {
                bookings.forEach((booking) => {
                    const bookingElement = `
                        <div class="detailjam">
                            <span>- ${booking.time}</span>
                            <span> | Dibooking Oleh: ${booking.username}</span>
                            <span> | Status: ${booking.status}</span>
                        </div>
                    `;
                    detailJamContainer.innerHTML += bookingElement;
                });
            } else {
                detailJamContainer.innerHTML = `<div class="detailjam">Tidak ada data booking untuk tanggal ${formattedDate}.</div>`;
            }
        }
    }

    const picker2 = flatpickr(datetimePicker2, {
        dateFormat: "Y-m-d",
        inline: true,
        minDate: new Date(new Date().setMonth(new Date().getMonth() + 1)).setDate(1),
        onChange: function (selectedDates, dateStr) {
            colorDatesWithData(globalDatesWithData);
            if (dateStr) {
                selectedDate = dateStr;
                picker1.clear(); 
                document.getElementById('selectedDate').value = selectedDate;
                const formattedDateTime = `Tanggal : ${selectedDate} ?`;
                document.getElementById('selectedDateSpan').textContent = formattedDateTime;
            }
            handleDateChange(dateStr, picker1, 'selectedDate');

        },
        onReady: async function () {
            const unavailableDates = await fetchUnavailableDates(
                `${apiBaseUrl}/unavailable-dates-2`,
                idFasilitas
            );

            globalDatesWithData = unavailableDates;
            colorDatesWithData(globalDatesWithData);
        },
    });

    const picker1 = flatpickr(datetimePicker1, {
        dateFormat: "Y-m-d",
        inline: true,
        minDate: "today",
        onChange: function (selectedDates, dateStr) {
            colorDatesWithData(globalDatesWithData);
            if (dateStr) {
                selectedDate = dateStr;
                picker2.clear();
                document.getElementById('selectedDate').value = selectedDate;
                const formattedDateTime = `Tanggal : ${selectedDate} ?`;
                document.getElementById('selectedDateSpan').textContent = formattedDateTime;
            }
            handleDateChange(dateStr, picker2, 'selectedDate');      

        },
        onReady: async function () {
            const unavailableDates = await fetchUnavailableDates(
                `${apiBaseUrl}/unavailable-dates-1`,
                idFasilitas
            );

            globalDatesWithData = unavailableDates;
            colorDatesWithData(globalDatesWithData);
        },
    });

    function updateSelectedTimeInput() {
        const selectedElements = document.querySelectorAll('.subwaktu.selected');
        const selectedTimes = Array.from(selectedElements).map(el => el.textContent.trim());
        document.getElementById('selectedTime').value = JSON.stringify(selectedTimes);
        const formattedDateTime = `Pukul : ${selectedTimes.join(', ')} ?`;
        document.getElementById('selectedTimeSpan').textContent = formattedDateTime;
    }

    window.toggleAMPM = function (type, element) {
        const amTimes = document.getElementById('AM-times');
        const pmTimes = document.getElementById('PM-times');
        if (type === 'AM') {
            toggleVisibility([amTimes], [pmTimes]);
        } else {
            toggleVisibility([pmTimes], [amTimes]);
        }
        document.querySelectorAll('.subwaktujdl').forEach(el => el.classList.remove('selected'));
        element.classList.add('selected');
    };

    window.toggleAMPM1 = function (period, element) {
        document.querySelectorAll('.subwaktujdl').forEach(el => el.classList.remove('selected'));
        element.classList.add('selected');
               const timeSpan = document.getElementById('selectedTimeSpan');
               if (timeSpan) {
                   timeSpan.textContent = `Period : ${period} ?`;
               }
               const hiddenInput = document.getElementById('selectedTime');
               if (hiddenInput) {
                   hiddenInput.value = period;
               }
    };

    function toggleVisibility(elementsToShow, elementsToHide) {
        elementsToShow.forEach(el => el.classList.remove('hidden'));
        elementsToHide.forEach(el => el.classList.add('hidden'));
    }

    window.toggleSelectTime = async function (element) {
        try {
            if (!idFasilitas || idFasilitas === 'null') {
                throw new Error('ID Fasilitas tidak valid.');
            }
           
            const response = await fetch(`${apiBaseUrl}/list-fasilitas/${idFasilitas}`);
        
            if (!response.ok) {
                throw new Error('Failed to fetch data from backend');
            }
    
            const fasilitas = await response.json();
            const maxjam = fasilitas.maxjam;
    
            if (!maxjam) {
                throw new Error('maxjam tidak ditemukan dalam respons API.');
            }

            const selectedElements = document.querySelectorAll('.subwaktu.selected');
    
            if (element.classList.contains('selected')) {
                element.classList.toggle('selected');
            } else {
                if (selectedElements.length < maxjam) {
                    element.classList.toggle('selected');
                } else {
                    alert(`Max yang ditentukan ${maxjam} jam untuk Fasilitas ini.`);
                }
            }
            updateSelectedTimeInput();

        } catch (error) {
            console.error('Error:', error);
            alert(error.message || 'An error occurred while processing your request.');
        }
    }; 
}

    window.toggleSelectTime1 = function (element) {
        const selectedElements = document.querySelectorAll('.subwaktu.selected');
        selectedElements.forEach(el => el.classList.remove('selected'));
        element.classList.add('selected');
        updateSelectedTimeInput();
    };


    // const token = "{{ csrf_token() }}"; 
    // const apiBaseUrl = "{{ config('services.api_base_url') }}"; 

    // window.sendToBackend = function () {
    //     const payload = {
    //         date: selectedDateInput.value,
    //         times: JSON.parse(selectedTimeInput.value || '[]').map(time => time.replace('.', ':')),
    //     };

    //     axios.post(`${apiBaseUrl}/booking-requests`, payload, {
    //         headers: { Authorization: `Bearer ${token}` },
    //     })
    //     .then(response => {
    //         console.log('Response:', response.data); // Log respons sukses
    //         alert('Data berhasil dikirim!'); // Beri tahu pengguna
    //     })
    //     .catch(error => {
    //         console.error('Error:', error.response?.data || error);
    //         alert('Gagal mengirim data.');
    //     });
    // };
});


