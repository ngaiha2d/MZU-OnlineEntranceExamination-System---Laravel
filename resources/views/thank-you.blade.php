@extends('layout/layout-common')

@section('space-work')

    <div class="container">
        <div class="text-center">
            <h2>Thanks for submitting your Exam, {{ Auth::user()->name}}</h2>
            <a href="/logout" class="btn btn-info"> Go back</a>
        </div>

    </div>

@endsection