document.addEventListener("DOMContentLoaded", function () {
    const container = document.querySelector('.sedbooksect1');
    const root = document.documentElement;
    
    if (container) {
      const contentWidth = container.scrollWidth;
      const speed = 50;
      const duration = contentWidth / speed;
      root.style.setProperty('--duration', `${duration}s`);
    }
});

    function togglePanelWithScroll(panelId) {
        const panel = document.getElementById(panelId);
        panel.classList.toggle('active');

        if (panel.classList.contains('active')) {
            document.body.classList.add('no-scroll');
        } else {
            document.body.classList.remove('no-scroll');
        }
    }
        flatpickr("#datetimepicker1", {
            dateFormat: "Y-m-d H:i",
            inline: true,
            minDate: "today",
        });
    
        flatpickr("#datetimepicker2", {
            dateFormat: "Y-m-d H:i",
            inline: true,
            minDate: new Date(new Date().setMonth(new Date().getMonth() + 1)).setDate(1),
        });

//----------------------------------------------------------------------------

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
            }, 3000);
        }
        else if (NotifModal) {
            setTimeout(() => {
                NotifModal.style.display = 'none';
            }, 3000);
        }
});
var play = new Audio("sounds/Sail Over Seven Seas.mp3");
play.play();
//----------------------------------------------------------------------------

    function toggleBOKE(type, element) {
        const Booking = document.getElementById('Bookings');
        const Keluhan = document.getElementById('Keluhans');
        if  (type === 'Book'){
            Booking.classList.remove('hidden');
            Keluhan.classList.add('hidden');
        }
        else if (type === 'Kelu'){
            Keluhan.classList.remove('hidden');
            Booking.classList.add('hidden');
        }
        document.querySelectorAll('.subhistory').forEach(el => el.classList.remove('selected1'));
        element.classList.add('selected1');
    }

//----------------------------------------------------------------------------

$(document).ready(function () {
    $(document).on('click', '.triggermodal', function () {
        var target = $(this).data('target');
        $('#' + target).css('display', 'flex');
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

//----------------------------------------------------------------------------     

$(document).ready(function () {
    $('.trigger-galery-modal').on('click', function () {
    var imgSrc = $(this).find('img').attr('src');
    $('#modal-image').attr('src', imgSrc);
    $('#showImg').css('display', 'flex');
    var currentImageIndex = $('.trigger-galery-modal').index(this);
    setupImageNavigation(currentImageIndex);
});

//----------------------------------------------------------------------------

        function setupImageNavigation(index) {
            $('.scroll-btn').off('click').on('click', function (e) {
                e.preventDefault();
                var direction = $(this).hasClass('left-btn') ? -1 : 1;
                var newImageIndex = index + direction;
                var imageCount = $('.trigger-galery-modal').length;
                if (newImageIndex >= 0 && newImageIndex < imageCount) {
                    $('.trigger-galery-modal').eq(newImageIndex).click();
                }
            });
        }
            
            $('.closemodal').on('click', function () {
                $('#showImg').css('display', 'none');
            });
        });
        
        function closeModal() {
            document.querySelectorAll(".sec_modal").forEach(modal => {
                modal.style.display = "none";
            });
    
            const targetModal = event.target.getAttribute("data-target");
            if (targetModal) {
                document.getElementById(targetModal).style.display = "block";
            }
        }
    
        function togglePassword(event, inputId) {
            event.stopPropagation();
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.querySelector(`[data-toggle-id="${inputId}"]`);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.innerHTML = ` <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><g fill="none">
                    <path fill="#9b9b9b" d="M9.528 7a8.5 8.5 0 0 0-8.5 8.5v7a8.5 8.5 0 0 0 15 5.477a8.5 8.5 0 0 0 15-5.477v-7a8.5 8.5 0 0 0-15-5.477A8.48 8.48 0 0 0 9.528 7"/><path fill="#fff" d="M9.528 8a7.5 7.5 0 0 0-7.5 7.5v7a7.5 7.5 0 0 0 14 3.744a7.5 7.5 0 0 0 14-3.744v-7a7.5 7.5 0 0 0-14-3.744A7.5 7.5 0 0 0 9.528 8"/>
                    <path fill="#d3d3d3" d="M15.028 15.5c0-1.364.364-2.642 1-3.744A7.53 7.53 0 0 0 12.226 8.5h-.167c1.094.656 1.938 3.25 1.938 4.5v12.125c0 1.375-.157 3.093-1.937 4.437a7.53 7.53 0 0 0 3.968-3.318a7.47 7.47 0 0 1-1-3.744zm15 0a7.5 7.5 0 0 0-4.802-7h-.167c1.656 1.094 2.906 3.063 2.906 4.531V25c0 1.375-1.124 3.218-2.905 4.562a7.5 7.5 0 0 0 4.968-7.062z"/>
                    <path fill="#321b41" d="M6.59 13a3.5 3.5 0 0 0-3.5 3.5v5a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 0 0-3.5-3.5m12.938 0a3.5 3.5 0 0 0-3.5 3.5v5a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 0 0-3.5-3.5"/><path fill="#f4f4f4" d="M8.766 16.861c.372-.31.355-.942-.038-1.414s-1.012-.603-1.384-.294s-.354.942.039 1.414c.392.471 1.012.603 1.383.294m12.997 0c.371-.31.354-.942-.039-1.414s-1.012-.603-1.383-.294c-.372.309-.354.942.038 1.414c.393.471 1.012.603 1.384.294"/></g>
                    </svg> `;
            } else {
                passwordInput.type = "password";
                toggleIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                <path fill="currentColor" d="M9.5 7A8.5 8.5 0 0 0 1 15.5v7a8.5 8.5 0 0 0 15 5.477A8.5 8.5 0 0 0 31 22.5v-7a8.5 8.5 0 0 0-15-5.477A8.48 8.48 0 0 0 9.5 7m5.345 4.8A8.5 8.5 0 0 0 14 15.5v7c0 1.326.304 2.581.845 3.7A6.5 6.5 0 0 1 3 22.5v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0v-1a6.5 6.5 0 0 1 11.845-3.7M16 15.5a6.5 6.5 0 1 1 13 0v7a6.5 6.5 0 1 1-13 0v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0zm-7.324 1.361c-.371.31-.99.177-1.383-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294s.41 1.105.038 1.414m13.02-1.414c.393.472.41 1.105.04 1.414c-.372.31-.992.177-1.384-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294"/>
                </svg>
                `;
            }
        }

        function togglePanel(panelId) {
            const panel = document.getElementById(panelId);
            if (panel) {
                panel.classList.toggle('active');
            }
        }

        function closePanel(panelId) {
            const panel = document.getElementById(panelId);
            if (panel) {
                panel.classList.remove('active');
            }
        }

        const toggleSidebar = document.getElementById('toggleSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        if (toggleSidebar) {
            toggleSidebar.addEventListener('click', () => togglePanel('sidebar'));
        }
        if (closeSidebar) {
            closeSidebar.addEventListener('click', () => closePanel('sidebar'));
        }

        const toggleCari = document.getElementById('toggleCari');
        const closePencarian = document.getElementById('closepencarian');
        if (toggleCari) {
            toggleCari.addEventListener('click', () => togglePanel('pencarian'));
        }
        if (closePencarian) {
            closePencarian.addEventListener('click', () => closePanel('pencarian'));
        }

        const toggleReport = document.getElementById('toggleReport');
        const closeReport = document.getElementById('closereport');
        if (toggleReport) {
            toggleReport.addEventListener('click', () => togglePanel('report'));
        }
        if (closeReport) {
            closeReport.addEventListener('click', () => closePanel('report'));
        }



        let allSelectedFiles = []; // Menyimpan semua file yang dipilih

        function previewImages() {
            const images = document.querySelector('#images');
            const previewContainer = document.querySelector('#image-preview-container');
            let invalidFiles = 0;
        
            Array.from(images.files).forEach((file) => {
                // Validasi apakah file adalah gambar
                if (!file.type.startsWith('image/')) {
                    invalidFiles++;
                    return;
                }
        
                // Cek apakah file sudah ada di allSelectedFiles
                const fileExists = allSelectedFiles.some(
                    existingFile => existingFile.name === file.name && existingFile.lastModified === file.lastModified
                );
        
                if (!fileExists) {
                    allSelectedFiles.push(file); // Tambahkan file baru
                    updateFileNames();
                }
            });
        
            if (invalidFiles > 0) {
                alert(`${invalidFiles} file bukan gambar dan tidak ditambahkan.`);
            }
        
            // Perbarui tampilan preview dan nama file
            //previewContainer.innerHTML = '';
            renderPreview();
            updateFileNames();
        
            // Reset input file agar memungkinkan memilih file yang sama lagi
            //images.value = '';
        }
        
        function renderPreview() {
            const previewContainer = document.querySelector('#image-preview-container');
            previewContainer.innerHTML = ''; // Hapus konten lama
        
            allSelectedFiles.forEach((file) => {
                const oFReader = new FileReader();
                const imgElement = document.createElement('img');
                imgElement.classList.add('img-preview');
                imgElement.style.maxWidth = '150px';
                imgElement.style.margin = '5px';
        
                oFReader.onload = function (oFREvent) {
                    imgElement.src = oFREvent.target.result; // Set gambar dari file
                };
        
                // Tambahkan event klik untuk menghapus file
                imgElement.addEventListener('click', () => {
                    allSelectedFiles = allSelectedFiles.filter(
                        f => f.name !== file.name || f.lastModified !== file.lastModified
                    );
        
                    if (allSelectedFiles.length === 0) {
                        document.querySelector('#images').value = '';
                    }
        
                    renderPreview();
                    updateFileNames();
                });
        
                oFReader.readAsDataURL(file); // Baca file sebagai URL data
                previewContainer.appendChild(imgElement);
            });
        
     
        }
        
        function updateFileNames() {
            const fileNameContainer = document.querySelector('#file-names');
            fileNameContainer.innerHTML = ''; // Hapus konten lama untuk update daftar
        
            allSelectedFiles.forEach((file) => {
                const fileNameElement = document.createElement('div');
                fileNameElement.textContent = file.name;
                fileNameContainer.appendChild(fileNameElement);
            });
        
            console.log('Daftar file yang dipilih:', allSelectedFiles.map(f => f.name));
        }
        
        function sendAllFiles() {
            const formData = new FormData();
        
            // Tambahkan token CSRF
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
            // Tambahkan semua file dari allSelectedFiles ke FormData
            allSelectedFiles.forEach((file) => {
                
                formData.append('images[]', file);
            });
        
            // Debug: Tampilkan isi FormData secara eksplisit
            //console.log('FormData sebelum dikirim:');
            // for (let [key, value] of formData.entries()) {
            //     console.log(`${key}:`, value instanceof File ? value.name : value);
            // }
        }
        
        let isButtonActive = true; 

        if (sessionStorage.getItem("isButtonActive") === "false") {
            isButtonActive = false;
        }
    
        function handleClick(event, element) {
            if (!isButtonActive) {
                event.preventDefault();
                return;
            }

            isButtonActive = false; 
            sessionStorage.setItem("isButtonActive", "false");
            window.location.href = element.href;
    
            setTimeout(() => {
                isButtonActive = true;
                sessionStorage.setItem("isButtonActive", "true"); 
            }, 5000);
        }
    
        window.addEventListener("load", () => {
            isButtonActive = true; 
            sessionStorage.setItem("isButtonActive", "true");
        });
//----------------------------------------------------------------------------       
//     let allSelectedFiles = [];
//     function updateFileNames() {
//         const fileNameContainer = document.querySelector('#file-names');
//         fileNameContainer.textContent = '';
//         allSelectedFiles.forEach(file => {
//             const fileNameElement = document.createElement('div');
//             fileNameElement.textContent = file.name;
//             fileNameContainer.appendChild(fileNameElement);
//         });
//     }
// //----------------------------------------------------------------------------
//     function previewImages() {
//         const images = document.querySelector('#images');
//         const previewContainer = document.querySelector('#image-preview-container');
//         let invalidFiles = 0;
  
//         Array.from(images.files).forEach((file) => {
//             if (!file.type.startsWith('image/')) {
//                 invalidFiles++;
//                 return;
//             }

//             const fileExists = allSelectedFiles.some(
//                 existingFile => existingFile.name === file.name && existingFile.lastModified === file.lastModified
//             );

//             if (!fileExists) {
//                 allSelectedFiles.push(file);
//             }
//         });

//         if (invalidFiles > 0) {
//             alert(`${invalidFiles} file bukan gambar dan tidak ditambahkan.`);
//         }
//         previewContainer.innerHTML = '';
//         renderPreview();
//         updateFileNames();
//     }
// //----------------------------------------------------------------------------
//     function renderPreview() {
//         const previewContainer = document.querySelector('#image-preview-container');
//         previewContainer.innerHTML = '';

//         allSelectedFiles.forEach((file) => {
//             const oFReader = new FileReader();
//             const imgElement = document.createElement('img');
//             imgElement.classList.add('img-preview');
//             imgElement.style.maxWidth = '150px';
//             imgElement.style.margin = '5px';
            
//             oFReader.onload = function (oFREvent) {
//                 imgElement.src = oFREvent.target.result;
//             };

//             imgElement.addEventListener('click', () => {
//                 allSelectedFiles = allSelectedFiles.filter(
//                     f => f.name !== file.name || f.lastModified !== file.lastModified
//                 );

//                 if (allSelectedFiles.length === 0) {
//                     document.querySelector('#images').value = '';
//                 }

//                 renderPreview();
//                 updateFileNames();
//             });

//             oFReader.readAsDataURL(file);
//             previewContainer.appendChild(imgElement);
//         });
//         console.log('Daftar file saat ini:', allSelectedFiles);
//     }
// //----------------------------------------------------------------------------
//     function sendAllFiles() {
//         const formData = new FormData();
//         const files = allSelectedFiles;
//         formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
//         files.forEach((file) => {
//             console.log('Menambahkan file:', file.name);
//             formData.append('images[]', file);
//         });
        
//     }

//----------------------------------------------------------------------------
$(document).ready(function () {
    function filterTable(prefix, rowClass) {
        var searchValues = {};
        $('input[id^="' + prefix + '-"]').each(function () {
            var targetClass = $(this).attr('id').split('-')[1];
            searchValues[targetClass] = $(this).val().toLowerCase().trim();
        });

        $('a[id^="' + prefix + '-"], span[id^="' + prefix + '-"]').each(function () {
            if ($(this).data('search-active')) {
                var targetClass = $(this).attr('id').split('-')[1];
                searchValues[targetClass] = $(this).text().toLowerCase().trim();
            }
        });

        $('div.' + rowClass).each(function () {
            var isVisible = true;
            $.each(searchValues, function (targetClass, searchValue) {
                var text = $(this).find('.' + targetClass).text().toLowerCase().trim();
                if (!text.includes(searchValue)) {
                    isVisible = false;
                    return false;
                }
            }.bind(this));
            $(this).toggle(isVisible);
        });
    }

    $('body').on('keyup change', 'input[id^="searchData1-"]', function () {   
        filterTable('searchData1', 'sectionresult');
    });

    $('body').on('click', 'a[id^="searchData2-"], span[id^="searchData2-"]', function () {
        $('a[id^="searchData2-"], span[id^="searchData2-"]').removeData('search-active');
        $(this).data('search-active', true);
        filterTable('searchData2', 'sectionkategori');
    });

    const defaultElement = $('a[id^="searchData2-"], span[id^="searchData2-"]').first();
    if (defaultElement.length) {
        defaultElement.data('search-active', true);
        filterTable('searchData2', 'sectionkategori');
    }
});
//----------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function () {
    const defaultElement = document.querySelector('.buttonlog.setbutton:first-child');
    if (defaultElement) {
        defaultElement.classList.add('selected'); 
        const defaultText = defaultElement.querySelector('span').textContent.toLowerCase().trim();
        filterTable(defaultText, 'sectionkategori');
    }
});
//---------------------------------------------------------------------------

