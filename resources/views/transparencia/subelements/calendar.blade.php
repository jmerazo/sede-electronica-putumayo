@extends('layouts.sidebar')

@section('sidebar')
    @include('partials.sidebar', ['secciones' => $secciones])
@endsection

@section('main-content')
<div class="container">
    <h1>Calendario de Actividades y Eventos</h1>
    <div id="calendar"></div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
<style>
#calendar {
    max-width: 900px;
    margin: 0 auto;
    font-family: 'Montserrat', sans-serif;
}
.fc-toolbar-title {
    font-size: 1.5em;
    font-weight: bold;
    color: #333;
}
.fc-button-primary {
    background-color: #004884 !important; /* Color personalizado */
    border-color: #004884 !important;     /* Borde personalizado */
    color: #ffffff !important;            /* Color del texto en blanco */
}
.fc-button-primary:hover {
    background-color: #003366 !important; /* Color más oscuro al hacer hover */
    border-color: #003366 !important;
}
.fc-day-header {
    color: #004884;
    font-weight: bold;
}
.fc-daygrid-day-number {
    color: #333;
    font-weight: bold;
}
.fc-event-title {
    color: #fff;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof FullCalendar === 'undefined') {
        console.error('FullCalendar no se ha cargado.');
        return;
    }

    var calendarEl = document.getElementById('calendar');

    var events = @json($events);
    console.log('Original Events from Laravel:', events);

    var calendarEvents = events.map(event => ({
        title: event.title,
        start: event.start ? event.start.replace(' ', 'T') : null,
        end: event.end ? event.end.replace(' ', 'T') : null,
        description: event.description
    }));

    console.log('Formatted Events for FullCalendar:', calendarEvents);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay'
        },
        events: calendarEvents,
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },
        dayHeaderFormat: { weekday: 'short' },
        eventDisplay: 'block', // Muestra los eventos como bloques de color
    });

    calendar.render();
});
</script>
@endpush
