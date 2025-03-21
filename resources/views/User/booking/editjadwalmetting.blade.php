@extends('User.index')
@section('maincontent')
@include('User.layouts.headerbackuser')
   
        <div class="col">
            <div class="subprogress">
                <div class="sublaptprogress">
                    <div class="subjadwalicon">
                        <img src="/img/icon-aksesbersama_0.png" alt="">
                    </div>
                  
                    <div class="subjadwalfasilitas">
                        <span style="font-size: 14px; font-weight: 600;">{{ $hasilreq1["fasilitas"]["fasilitas"] }} {{ $hasilreq1["fasilitas"]["unit_nomor"] }}</span>
                        <div class="subjadwaldatefasilitas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/>
                            </svg>
                            <span>{{ $hasilreq1["date"] }}</span>
                        </div>  
                        <div class="subjadwaldatefasilitas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/>
                            </svg>
                            <span>{{ $hasilreq1["start_time"] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="col">
                <div class="section2">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                        <path d="M16 3v4" />
                        <path d="M8 3v4" />
                        <path d="M4 11h16" />
                        <path d="M7 14h.013" />
                        <path d="M10.01 14h.005" />
                        <path d="M13.01 14h.005" />
                        <path d="M16.015 14h.005" />
                        <path d="M13.015 17h.005" />
                        <path d="M7.01 17h.005" />
                        <path d="M10.01 17h.005" />
                    </svg>
                    <h2 style="font-weight: 700"> Tentukan Tanggal</h2>   
                </div>

                <form>
                <div class="subsection2">
                        <div  class="datetimepicker" id="datetimepicker1">
                            <input type="hidden"  >
                        </div> <!-- Flatpickr pertama -->
                        <div  class="datetimepicker" id="datetimepicker2">
                            <input type="hidden"  >
                        </div> <!-- Flatpickr pertama -->
                </div>
            </form>
                    {{-- <div id="datepicker"></div>   
                    <script>
                    $( "#datepicker" ).datepicker();
                    $( ".selector" ).datepicker( "setDate", "10/12/2012" );
                    $( ".selector" ).datepicker( "refresh" );
                    $( ".selector" ).datepicker( "option", { disabled: true } );
                    </script> --}}    
        </div>
        <div class="col">  
            <div class="sectiondetailbook">
                <div class="section2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M11.795 21H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4"/>
                        <path d="M14 18a4 4 0 1 0 8 0a4 4 0 1 0-8 0m1-15v4M7 3v4m-4 4h16"/>
                        <path d="M18 16.496V18l1 1"/></g>
                    </svg>
                        <h2>Detail Booking</h2>
                </div>
                <div class="subsectiondelbook">
                    <div class="subsectionjudul">
                        <h3>Pilih Tanggal</h3>
                    </div>
                    <h4>Fasilitas yang dibooking : {{ $hasilreq1['fasilitas']['fasilitas']  }}</h4>
                    <div class="detailjam-container">
                    </div>
                </div>                
            </div>
        </div>
    <div class="col">  
        <div class="sectionwaktu">
            <div class="section2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M17 3.34a10 10 0 1 1-14.995 8.984L2 12l.005-.324A10 10 0 0 1 17 3.34M12 6a1 1 0 0 0-.993.883L11 7v5l.009.131a1 1 0 0 0 .197.477l.087.1l3 3l.094.082a1 1 0 0 0 1.226 0l.094-.083l.083-.094a1 1 0 0 0 0-1.226l-.083-.094L13 11.585V7l-.007-.117A1 1 0 0 0 12 6"/>
                </svg>
                    <h2>Tentukan Waktu</h2>
            </div>

                <div class="subsectionwaktu">
                    <a style="float: left" href="javascript:void(0)"> 
                        <div class="subwaktujdl" onclick="toggleAMPM1('AM', this)">
                        <span>AM</span>
                        </div>
                    </a>
                    <a style="float: right;" href="javascript:void(0)"> 
                        <div class="subwaktujdl" onclick="toggleAMPM1('PM', this)">
                        <span>PM</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
    <div class="col">  

        <div class="sectiondetailbook">
            <div class="section2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M16.519 16.501c.175-.136.334-.295.651-.612l3.957-3.958c.096-.095.052-.26-.075-.305a4.3 4.3 0 0 1-1.644-1.034a4.3 4.3 0 0 1-1.034-1.644c-.045-.127-.21-.171-.305-.075L14.11 12.83c-.317.317-.476.476-.612.651q-.243.311-.412.666c-.095.2-.166.414-.308.84l-.184.55l-.292.875l-.273.82a.584.584 0 0 0 .738.738l.82-.273l.875-.292l.55-.184c.426-.142.64-.212.84-.308q.355-.17.666-.412m5.849-5.809a2.163 2.163 0 1 0-3.06-3.059l-.126.128a.52.52 0 0 0-.148.465c.02.107.055.265.12.452c.13.375.376.867.839 1.33s.955.709 1.33.839c.188.065.345.1.452.12a.53.53 0 0 0 .465-.148z"/><path fill="currentColor" fill-rule="evenodd" d="M4.172 3.172C3 4.343 3 6.229 3 10v4c0 3.771 0 5.657 1.172 6.828S7.229 22 11 22h2c3.771 0 5.657 0 6.828-1.172C20.981 19.676 21 17.832 21 14.18l-2.818 2.818c-.27.27-.491.491-.74.686a5 5 0 0 1-.944.583a8 8 0 0 1-.944.355l-2.312.771a2.083 2.083 0 0 1-2.635-2.635l.274-.82l.475-1.426l.021-.066c.121-.362.22-.658.356-.944q.24-.504.583-.943c.195-.25.416-.47.686-.74l4.006-4.007L18.12 6.7l.127-.127A3.65 3.65 0 0 1 20.838 5.5c-.151-1.03-.444-1.763-1.01-2.328C18.657 2 16.771 2 13 2h-2C7.229 2 5.343 2 4.172 3.172M7.25 9A.75.75 0 0 1 8 8.25h6.5a.75.75 0 0 1 0 1.5H8A.75.75 0 0 1 7.25 9m0 4a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75m0 4a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75" clip-rule="evenodd"/>
                </svg>
                    <h2>Alasan Perubahan</h2>
            </div>
            <div class="list_formbook">
                <textarea id="alasan" cols="30" rows="1" placeholder="Tulis Alasan" maxlength="150" required></textarea>
                <span id="charCount">150 karakter</span>
            </div>
              
            <div class="button_form">

                <button type="button" class="sec_batal sec_siz" onclick="closeModal()">Batal</button>

                <button class="sec_sub sec_siz triggermodal" data-target="showbooking" data-index="index8" data-route="{{ route('updatebookingmetting', ['id' => $hasilreq1['id_booking']]) }}" onclick="getSelectedValues()">Ajukan Perubahan</button>
            </div>
        </div>

    </div>
@include('User.layouts.confirm1')           
    <script>
        const apiBaseUrl = "{{ env('API_BASE_URL') }}";
        let idFasilitas;
            document.addEventListener("DOMContentLoaded", function () {
            idFasilitas = {{ $hasilreq1['id_fasilitas'] ?? 'null' }};
         });

        document.addEventListener('DOMContentLoaded', function () {
            const modalForm = document.getElementById('modalForm');
            const methodField = document.getElementById('methodField');
            const hiddenAlasan = document.getElementById('hiddenAlasan');
            const alasanInput = document.getElementById('alasan');
            modalForm.addEventListener('submit', function () {
                
                if (alasanInput.value.trim() === '') {
                    alert(`Alasan Perubahan wajib diisi`);
                    event.preventDefault(); 
                    return;
                } else {
                        if (alasanInput && hiddenAlasan) {
                        hiddenAlasan.value = alasanInput.value.trim();
                    }
                } 
            });   

            document.querySelectorAll('.triggermodal').forEach(button => {
                button.addEventListener('click', function () {
                    const route = this.getAttribute('data-route');
                    const method = 'PUT';

                    modalForm.setAttribute('action', route);

                    methodField.value = method;
                });
            });

            function handleCharCount(textareaId, charCountId, maxLength) {
                const textarea = document.getElementById(textareaId);
                const charCount = document.getElementById(charCountId);

                if (!textarea || !charCount) {
                    console.error(`Elemen dengan ID ${textareaId} atau ${charCountId} tidak ditemukan.`);
                    return;
                }

                textarea.addEventListener("input", function () {
                    const currentLength = textarea.value.length;
                    charCount.textContent = `${maxLength - currentLength} karakter`;
                });
            }

            handleCharCount("alasan", "charCount", 150);
            handleCharCount("textreport", "charreport", 150);
});

     </script>
     <script src="/js/datetime.js"></script>   
@endsection  
