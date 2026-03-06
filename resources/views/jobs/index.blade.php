@extends('layouts.app')

@section('title', 'Browse Jobs – QuickHire')

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush

@section('content')
{{--
    The entire search + listing UI is handled by the JobSearch React component.
    Initial jobs are passed via data attributes so the first render is instant (no loading flash).
--}}
<div
    id="job-search-root"
    data-jobs="{{ json_encode($jobs->items()) }}"
    data-total="{{ $jobs->total() }}"
></div>
@endsection
