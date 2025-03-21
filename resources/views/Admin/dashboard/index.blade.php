<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="icon" type="image/icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="images/aksesbersama.png" alt="Logo">
            </div>
            @include('Admin.dashboard.partials.sidebar')
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            
            <div class="sec_navbar">
                @include('Admin.dashboard.partials.navbar')
            </div>
            
            <div class="content_body">
                <div class="aplay_code">
                    @yield('content')
                </div>
                {{-- <footer class="footer">
                    <p>© Copyright 2010 - 2024 Akses Bersama Rights Reserved.</p>
                </footer> --}}
            </div>
        </main>
        @include('Admin.dashboard.main.pushnotification')
    </div>

    <script>
        document.querySelector('.user').addEventListener('click', function(e) {
            e.stopPropagation();
            document.querySelector('.user').classList.toggle('active');
        });
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.user')) {
                document.querySelector('.user').classList.remove('active');
            }
        });
    </script>

    <script>
        const apiBaseUrl = "{{ config('services.api_base_url') }}";
        document.addEventListener("DOMContentLoaded", function () {
            const iconBox = document.querySelector(".icon-box");
            iconBox.addEventListener("click", function () {
                this.classList.add("shake");
                setTimeout(() => {
                    this.classList.remove("shake");
                }, 500);
            });
        });

    class Calendar {
    constructor() {
        this.date = new Date();
        this.selectedDate = null;
        this.monthDisplay = document.getElementById('monthDisplay');
        this.calendarDays = document.getElementById('calendarDays');
        document.getElementById('prevMonth').addEventListener('click', () => this.navigateMonth(-1));
        document.getElementById('nextMonth').addEventListener('click', () => this.navigateMonth(1));
        this.render();
    }

    navigateMonth(delta) {
        this.date.setMonth(this.date.getMonth() + delta);
        this.render();
    }

    getMonthData() {
        const year = this.date.getFullYear();
        const month = this.date.getMonth();
        
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        
        const startingDayOfWeek = firstDay.getDay() || 7;
        const daysInMonth = lastDay.getDate();
        
        return { startingDayOfWeek, daysInMonth, year, month };
    }

    render() {
        const { startingDayOfWeek, daysInMonth, year, month } = this.getMonthData();
        this.monthDisplay.textContent = new Date(year, month)
            .toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
        this.calendarDays.innerHTML = '';
        
        for (let i = 1; i < startingDayOfWeek; i++) {
            const prevMonthDay = document.createElement('div');
            prevMonthDay.className = 'calendar-day other-month';
            const prevMonthDate = new Date(year, month, 1 - (startingDayOfWeek - i));
            prevMonthDay.textContent = prevMonthDate.getDate();
            this.calendarDays.appendChild(prevMonthDay);
        }
        
        const today = new Date();
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            dayElement.textContent = day;
            if (year === today.getFullYear() && 
                month === today.getMonth() && 
                day === today.getDate()) {
                dayElement.classList.add('today');
            }
            
            if (this.selectedDate && 
                year === this.selectedDate.getFullYear() && 
                month === this.selectedDate.getMonth() && 
                day === this.selectedDate.getDate()) {
                dayElement.classList.add('selected');
            }
            
            dayElement.addEventListener('click', () => {
                this.selectedDate = new Date(year, month, day);
                document.querySelectorAll('.calendar-day.selected')
                    .forEach(el => el.classList.remove('selected'));
                dayElement.classList.add('selected');
                //console.log('Selected date:', this.selectedDate);
            });
            
            this.calendarDays.appendChild(dayElement);
        }
        
        const remainingCells = 42 - (startingDayOfWeek - 1 + daysInMonth);
        for (let i = 1; i <= remainingCells; i++) {
            const nextMonthDay = document.createElement('div');
            nextMonthDay.className = 'calendar-day other-month';
            nextMonthDay.textContent = i;
            this.calendarDays.appendChild(nextMonthDay);
        }
    }
}
        document.addEventListener('DOMContentLoaded', () => {
            new Calendar();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>