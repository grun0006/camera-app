@extends('layouts.app')

@section('content')
    <div>
        <br>
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="text-align: center; font-size: 40px">Admin Dashboard</h1>
        <br>
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
             <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                 <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add New User</h2>
                 <br>
                 <form method="POST" action="{{ route('users.store') }}">
                     @csrf
                     <div class="mb-2">
                         <input type="text" name="name" class="form-control" placeholder="Name" required>
                     </div>
                     <div class="mb-2">
                         <input type="email" name="email" class="form-control" placeholder="Email" required>
                     </div>
                     <div class="mb-2">
                         <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" class="btn btn-primary sm:rounded-lg" style="background-color: darkgrey">Create User</button>
                 </form>
             </div>

             <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                 <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add New Camera</h2>
                 <br>
                 <form method="POST" action="{{ route('cameras.store') }}">
                     @csrf
                     <div class="mb-2">
                         <input type="text" name="name" class="form-control" placeholder="Camera Name" required>
                     </div>
                     <div class="mb-2">
                         <input type="url" name="stream_url" class="form-control" placeholder="HTTP Stream URL" required>
                     </div>
                     <button type="submit" class="btn btn-primary sm:rounded-lg" style="background-color: darkgrey">Add Camera</button>
                 </form>
             </div>
         </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" style="margin-top: 25px">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">All Users permissions</h2>
                <br>
                @foreach ($users as $user)
                    <div>
                        <h3>name: {{ $user->name }}</h3>

                        <form method="POST" action="{{ route('users.cameras.update') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <div>
                                    @foreach ($cameras as $camera)
                                        <input class="form-check-input" type="checkbox" name="camera_ids[]" value="{{ $camera->id }}" {{ $user->cameras->contains($camera->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="camera_{{ $camera->id }}">
                                            {{ $camera->name }}
                                        </label>

                                    @endforeach
                                </div>
                            <br>
                            <button type="submit" class="btn btn-primary sm:rounded-lg" style="background-color: darkgrey">
                                Update
                            </button>
                        </form>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" style="margin-top: 25px">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">All Cameras</h2>
                <br>
                 @foreach ($cameras as $camera)
                     <div>
                         <form method="POST" action="{{ route('cameras.destroy', $camera->id) }}" onsubmit="return confirm('Delete {{ $camera->name }}?');">
                             @csrf
                             @method('DELETE')

                             <label>{{ $camera->name }}</label>
                             <button class="btn btn-sm btn-outline-danger sm:rounded-lg" style="background-color: #f53003">Delete</button>
                         </form>
                     </div>
                     <br>
                 @endforeach
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" style="margin-top: 25px">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">All Users</h2>
                <br>
                @foreach ($users as $user)
                    <div>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Delete {{ $user->name }}?');">
                            @csrf
                            @method('DELETE')

                            <label>{{ $user->name }}</label>
                            <button class="btn btn-sm btn-outline-danger sm:rounded-lg" style="background-color: #f53003">Delete</button>
                        </form>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
