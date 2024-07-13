<!-- resources/views/calendario.blade.php -->

<x-app-layout>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="grid grid-cols-2 gap-4">
                <!-- Day Grid Calendar -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                    <div id="dayGridCalendar"></div>
                </div>

                <!-- Time Grid Calendar -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                    <div id="timeGridCalendar"></div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var dayGridEl = document.getElementById('dayGridCalendar');
                var timeGridEl = document.getElementById('timeGridCalendar');

                // Day Grid Calendar
                var dayGridCalendar = new FullCalendar.Calendar(dayGridEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: ''
                    },
                    events: @json($events),
                    height: 'auto', 
                    contentHeight: 'auto', 
                    eventDisplay: 'block', 
                    titleFormat: { 
                        month: 'long', 
                        year: 'numeric'
                    },
                    views: {
                        dayGridMonth: {
                            titleFormat: { month: 'long', year: 'numeric' } 
                        }
                    },
                    allDaySlot: false 
                });
                dayGridCalendar.render();

                // Time Grid Calendar
                var timeGridCalendar = new FullCalendar.Calendar(timeGridEl, {
                    initialView: 'timeGridWeek',
                    headerToolbar: {
                        left: '',
                        center: '',
                        right: ''
                    },
                    events: @json($events),
                    slotMinTime: '08:00:00',
                    slotMaxTime: '15:00:00',
                    height: 'auto',
                    contentHeight: 'auto', 
                    eventDisplay: 'block', 
                    titleFormat: { 
                        month: 'long', 
                        year: 'numeric'
                    },
                    views: {
                        timeGridWeek: {
                            titleFormat: { month: 'long', year: 'numeric' } 
                        }
                    },
                    allDaySlot: false 
                });
                timeGridCalendar.render();
            });
        </script>
        <style>
            .fc {
                font-size: 0.8em;
            }
        </style>
    @endpush
</x-app-layout>
