@extends('layouts.master')

@section('title', 'Tambah Highlight - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <h2 class="h4 mb-4">Tambah Highlight</h2>

    <div class="card border-0 shadow">
        <div class="card-body">
            <form action="{{ route('admin.highlight.store') }}" method="POST">
                @csrf
                @include('admin.highlight.form', ['mode' => 'create'])
            </form>
        </div>
    </div>
</div>
@endsection
