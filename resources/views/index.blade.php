@extends('layouts.app')

@section('content')
    <br>
    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="text-align: center; font-size: 40px">My Cameras</h1>

    <div class="p-6">
        @foreach ($cameras as $camera)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-lg font-bold">{{ $camera->name }}</h3>
                    <img src="{{ $camera->url }}" alt="{{ $camera->name }}" class="border rounded w-full max-w-md">
                </div>
            </div>
            <br>
        @endforeach
    </div>
@endsection
