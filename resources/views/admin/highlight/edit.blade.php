@extends('layouts.master')

@section('title', 'Edit Highlight - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <h2 class="h4 mb-4">Edit Highlight</h2>

    <div class="card border-0 shadow">
        <div class="card-body">
            <form action="{{ route('admin.highlight.update', $highlight->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.highlight.form', ['mode' => 'edit'])
            </form>
        </div>
    </div>
</div>
@endsection
