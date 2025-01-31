@extends('layout.loginbase')
@section('content')
<div class="bg-white p-4 md:p-8 rounded-lg lg:my-10">
    <div class=" mx-auto mt-5 ">
        <h1 class="text-center">Mentor Login</h1>
        <form action="{{ route('login') }}" method="POST" class="max-w-md mx-auto">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4 w-full">
                <button type="submit" class="bg-[#019AAC] text-white py-2 px-4 rounded w-full text-center">Login</button>
            </div>
        </form>
    </div>
</div>
{{-- <div class="relative mt-10"> --}}

@endsection