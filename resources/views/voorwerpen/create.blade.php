@extends('layout.base')
@section('content')
<div class="lg:w-1/2 px-2 lg:px-0 mx-auto mt-5">
    <form action="{{ route('voorwerpen.store') }}" method="POST" class="max-w-md mx-auto">
        @csrf


        <!-- Naam -->
        <div class="mb-4">
            <label for="Naam" class="block font-medium text-gray-700 mb-2">Naam</label>
            <input type="text" name="Naam" id="Naam" placeholder="Naam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Naam')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Beschrijving -->
        <div class="mb-4">
            <label for="Beschrijving" class="block font-medium text-gray-700 mb-2">Beschrijving</label>
            <textarea name="Beschrijving" id="Beschrijving" placeholder="Beschrijving" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"></textarea>
            @error('Beschrijving')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- CategorieUUID -->
        <div class="mb-4">
            <label for="CategorieUUID" class="block font-medium text-gray-700 mb-2">Domein</label>
            <select name="CategorieUUID" id="CategorieUUID" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                @foreach($Categories as $category)
                <option value="{{ $category->UUID }}">{{ $category->Naam }}</option>
                @endforeach
            </select>
            @error('CategorieUUID')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- leeftijd begin -->
        <div class="mb-4">
            <label for="QR" class="block font-medium text-gray-700 mb-2">Leeftijd</label>
            <input type="text" name="leeftijd" id="leeftijd" placeholder="Leeftijd" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('QR')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- leeftijd eind -->
        <div class="mb-4">
            <label for="QR" class="block font-medium text-gray-700 mb-2">tot</label>
            <input type="text" name="leeftijdtot" id="leeftijdtot" placeholder="Leeftijd" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('QR')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- Notities -->
        <!-- <div class="mb-4">
            <label for="Notities" class="block font-medium text-gray-700">Notities</label>
            <textarea name="Notities" id="Notities" placeholder="Notities" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"></textarea>
            @error('Notities')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div> -->

        <!-- QR -->
        <!-- <div class="mb-4">
            <label for="QR" class="block font-medium text-gray-700">QR</label>
            <input type="text" name="QR" id="QR" placeholder="QR" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('QR')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div> -->

        <!-- Foto -->

        <!-- Display Uploaded Image -->
        <div id="image-preview" class="mb-4 w-full h-64 bg-gray-200 flex items-center justify-center rounded-md overflow-hidden">
            <p class="text-gray-500">Geen foto geselecteerd</p>
        </div>

        <!-- Buttons for Actions -->
        <div class="flex gap-4 mb-4 w-full">
            <!-- Button to Open Camera -->
            <button type="button" id="capture-photo" class="bg-[#019AAC] w-full text-white px-4 py-2 rounded shadow hover:bg-indigo-600">
                Maak Foto
            </button>

            <!-- Button to Upload Photo -->
            <label for="foto-input" class="bg-[#019AAC] text-white px-4 w-full text-center py-2 rounded shadow cursor-pointer hover:bg-gray-600">
                Zoek Foto
                <input type="file" name="Foto" id="foto-input" accept="image/*" class="hidden">
            </label>
        </div>



        <!-- Actief -->
        <!-- <div class="mb-4">
            <label for="Actief" class="block font-medium text-gray-700">Actief</label>
            <select name="Actief" id="Actief" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('Actief')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div> -->



        


        <!-- Aanmaakdatum -->
        {{-- <div class="mb-4">
            <label for="Aanmaakdatum" class="block font-medium text-gray-700">Aanmaakdatum</label>
            <input type="date" name="Aanmaakdatum" id="Aanmaakdatum" placeholder="Aanmaakdatum" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Aanmaakdatum')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
</div> --}}

<div class="mb-4 w-full">
    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-indigo-600 w-full text-center">Submit</button>
</div>
<div>
    <a href="{{ url('/voorwerpen') }}" class="text-blue-500">Terug</a>
</div>
</form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fileInput = document.getElementById('foto-input');
        const imagePreview = document.getElementById('image-preview');
        const capturePhotoButton = document.getElementById('capture-photo');

        if (fileInput && imagePreview && capturePhotoButton) {
            // Display selected image
            fileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        imagePreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover" alt="Selected Image">`;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Open camera for capturing photo
            capturePhotoButton.addEventListener('click', () => {
                fileInput.setAttribute('capture', 'camera');
                fileInput.click();
            });
        } else {
            console.error("Elements not found: Ensure 'foto-input', 'image-preview', and 'capture-photo' exist in the DOM.");
        }
    });
</script>