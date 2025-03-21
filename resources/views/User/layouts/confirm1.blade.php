<div id="showbooking" class="sec_modal">    
    <div class="logincontainer">
        <div class="formbooking">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1-19.995.324L2 12l.004-.28C2.152 6.327 6.57 2 12 2m0 9h-1l-.117.007a1 1 0 0 0 0 1.986L11 13v3l.007.117a1 1 0 0 0 .876.876L12 17h1l.117-.007a1 1 0 0 0 .876-.876L14 16l-.007-.117a1 1 0 0 0-.764-.857l-.112-.02L13 15v-3l-.007-.117a1 1 0 0 0-.876-.876zm.01-3l-.127.007a1 1 0 0 0 0 1.986L12 10l.127-.007a1 1 0 0 0 0-1.986z"/>
            </svg>
                <span id="statusMessage">Lengkapi dulu data anda</span>
                <span id="selectedDateSpan"></span> 
                <span id="selectedTimeSpan"></span>
                <form id="modalForm" method="post" enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="_method" id="methodField" value="">
                <input type="hidden" name="date" id="selectedDate">
                <input type="hidden" name="alasan" id="hiddenAlasan">
                <input type="hidden" name="id_fasilitas" value="{{ $hasilreq1['fasilitas']['id_fasilitas'] }}">
                <input type="hidden" name="times" id="selectedTime">
                    <div class="buttonsecbook">
                        <span id="btn-tidak" class="buttonlog setbuttonbook" onclick="closeModal()">Tidak</span>
                        <button id="btn-benar" class="buttonlog setbuttonbook" type="submit" disabled onclick="handleClick(event, this)">Benar</button>
                </div> 
            </form>
        </div>
    </div>
</div>
<script>

document.addEventListener('DOMContentLoaded', function () {
    const dateSpan = document.getElementById('selectedDateSpan');
    const timeSpan = document.getElementById('selectedTimeSpan');
    const submitButton = document.getElementById('btn-benar');
    const messageSpan = document.querySelector('span#statusMessage'); 
    const hiddenDateInput = document.getElementById('selectedDate');
    const hiddenTimeInput = document.getElementById('selectedTime');

    function checkIfReady() {
        const dateValue = dateSpan.textContent.trim();
        const timeValue = timeSpan.textContent.trim();

        if (dateValue && timeValue && timeValue !== "Period : ?") {
            const selectedDate = new Date(dateValue);
            const today = new Date();
            const twoDaysFromToday = new Date(today);
            twoDaysFromToday.setDate(today.getDate() + 15);

            // Normalize time to ignore time zone offsets
            selectedDate.setHours(0, 0, 0, 0);
            today.setHours(0, 0, 0, 0);
            twoDaysFromToday.setHours(0, 0, 0, 0);

            if (selectedDate >= today && selectedDate <= twoDaysFromToday) {
                submitButton.disabled = false;
                messageSpan.textContent = "Anda memilih";
            } else {
                submitButton.disabled = true;
                messageSpan.textContent = "Tanggal yang dipilih max : 15 hari ke depan";
            }
        } else {
            submitButton.disabled = true; 
            messageSpan.textContent = "Lengkapi dulu data anda."; 
        }
    }


    const observer = new MutationObserver(checkIfReady);
    observer.observe(dateSpan, { childList: true });
    observer.observe(timeSpan, { childList: true });

    checkIfReady();
});


</script>