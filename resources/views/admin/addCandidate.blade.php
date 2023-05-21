@extends('layout/admin-layout')
@section('space-work')



<div class="container mt-5 text-center">
    <h2 class="mb-4">
        Import candidate
    </h2>
    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
            <div class="custom-file text-center">
                <input type="file" name="file" id="customFile">
            </div>
        </div>
        <button class="btn btn-outline-primary">Import Candidate</button>
        
    </form>
    <div class="text-center">
        <br>
        @if(Session::has('success'))
        <p style="color:green">{{Session::get('success') }}</p>
        @endif
      </div>
</div>

@endsection