@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Header with Calendar Title --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="m-0">Calendar</h4>

        {{-- View Mode Selector --}}
        <x-view-mode-selector />

    </div>

    {{-- FullCalendar Toolbar --}}
    <div class="d-flex gap-2 mb-3">
        <button id="fc-prev" class="btn btn-light">Prev</button>
        <button id="fc-next" class="btn btn-light">Next</button>
        <button id="fc-today" class="btn btn-outline-primary">Today</button>

        <select id="fc-view-select" class="form-select w-auto">
            <option value="dayGridMonth">Month</option>
            <option value="timeGridWeek">Week</option>
            <option value="timeGridDay">Day</option>
        </select>
    </div>

    {{-- Calendar Container --}}
    <div id="fullcalendar"></div>

</div>

@endsection

{{-- Include FullCalendar --}}
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

{{-- Include our custom calendar JS --}}
<script src="{{ asset('js/schedule/calendar.js') }}"></script>
@endsection
