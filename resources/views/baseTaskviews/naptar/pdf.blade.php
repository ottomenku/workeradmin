@php
$savecalid=$data['savecal']['id'] ?? 0;
$savecalname=$data['savecal']['savecalname'] ?? '';
@endphp



@extends('layouts.backend_pdf')
@section('content')
<h3>{{ $data['worker_name'] }}</h3>
<h2>{{ $data['ev'] }}: {{ $data['ho'] }}</h2>
{{ $savecalname }}
@include('calendar.pdf_print')
@include('calendar.calendar')
@endsection