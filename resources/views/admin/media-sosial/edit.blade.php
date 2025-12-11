@extends('layouts.master')

@section('title', 'Edit Media Sosial - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <h2 class="h4 mb-4">Edit Media Sosial</h2>

    <div class="card border-0 shadow">
        <div class="card-body">
            <form action="{{ route('admin.media-sosial.update', $mediaSosial) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.media-sosial.form', ['mode' => 'edit'])
            </form>
        </div>
    </div>
</div>
@endsection
