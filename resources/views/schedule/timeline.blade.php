@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Timeline View</h4>

        <x-view-mode-selector />
    </div>

    {{-- Timeline Rows --}}
    <div id="timeline-container">

        {{-- Each work order timeline row --}}
        <x-view-mode-selector />

    </div>

</div>

@endsection
