

@extends('layout.base')
@section('content')
<div class="w-1/2 mx-auto mt-5">
    <h1 class="text-center">Create Employe</h1>
    <form action="{{ route('employes.store') }}" method="post" class="max-w-md mx-auto" enctype="multipart/form-data">
        @csrf
        <!-- firstname -->
        <div class="mb-4">
            <label for="firstname" class="block font-medium text-gray-700">Firstname</label>
            <input type="text" name="firstname" id="firstname" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" placeholder="Voornaam">
            @error('firstname')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- lastname -->
        <div class="mb-4">
            <label for="lastname" class="block font-medium text-gray-700">lastname</label>
            <input type="text" name="lastname" id="lastname" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" placeholder="Achternaam">
            @error('lastname')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- email -->
        <div class="mb-4">
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" placeholder="Email">
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- wachtwoord -->
        <div class="mb-4">
            <label for="wachtwoord" class="block font-medium text-gray-700">Wachtwoord</label>
            <input type="password" name="wachtwoord" id="wachtwoord" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" placeholder="Wachtwoord">
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- admin -->
        <div class="mb-4">
            <label for="admin" class="block font-medium text-gray-700">Beheerder</label>
            <input type="checkbox" name="admin" id="admin" class="w-6 h-6">
            @error('admin')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <button type="submit" style="background-color: #019AAC;" class="bg-indigo-500 text-white w-full py-2 px-4 rounded hover:bg-indigo-600">Create Employe</button>
        </div>
        <div>
            <a href="{{ url('/employes') }}" style="background-color: #C8304E;" class="bg-indigo-500 text-white block text-center w-full py-2 px-4 rounded hover:bg-indigo-600">Back</a>
        </div>
    </form>
</div>


@stop
