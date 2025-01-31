@extends('layout.base')
@section('content')

<div class="mx-auto justify-center items-center p-5 mt-5 flex flex-wrap gap-1">
    <!-- Students crud -->
    <a href="{{ url('/kinderen') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Kinderen Crud</h5>
    </a>

    <!-- Products crud -->

    <a href="{{ url('/voorwerpen') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Voorwerpen Crud</h5>
    </a>

    <!-- Employes crud -->

    <a href="{{ url('/mentoren') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">mentoren Crud</h5>
    </a>

</div>
@stop