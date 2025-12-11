@extends('layouts.master')

@section('title', 'Edit Testimoni - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <h2 class="h4 mb-4">Edit Testimoni</h2>

    <div class="card border-0 shadow">
        <div class="card-body">
            <form action="{{ route('admin.testimoni.update', $testimoni) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.testimoni.form', ['mode' => 'edit'])
            </form>
        </div>
    </div>
</div>
@endsection
