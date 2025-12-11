@extends('layouts.master')

@section('title', 'Tambah Testimoni - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <h2 class="h4 mb-4">Tambah Testimoni</h2>

    <div class="card border-0 shadow">
        <div class="card-body">
            <form action="{{ route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.testimoni.form', ['mode' => 'create'])
            </form>
        </div>
    </div>
</div>
@endsection
