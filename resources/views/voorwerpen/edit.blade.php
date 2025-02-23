@extends('layout.base') @section('content')
<div class="lg:w-1/2 px-2 lg:px-0 mx-auto mt-5">
    <form
        action="{{ route('voorwerpen.update', $voorwerp->UUID) }}"
        method="POST"
        class="max-w-md mx-auto"
    >
    @method('PUT')
        @csrf

        <!-- Naam -->
        <div class="mb-4">
            <label for="Naam" class="block font-medium text-gray-700 mb-2"
                >Naam</label
            >
            <input
                type="text"
                name="Naam"
                id="Naam"
                placeholder="Naam"
                class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"
                value="{{ $voorwerp->Naam }}"
            />
            @error('Naam')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Beschrijving -->
        <div class="mb-4">
            <label
                for="Beschrijving"
                class="block font-medium text-gray-700 mb-2"
                >Beschrijving</label
            >
            <textarea
            {{-- {{dd($voorwerp)}} --}}
                name="Beschrijving"
                id="Beschrijving"
                placeholder="Beschrijving"
                class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"
            >{{ $voorwerp->Beschrijving }}</textarea>
            @error('Beschrijving')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Notitie -->
        <div class="mb-4">
            <label
                for="Notities"
                class="block font-medium text-gray-700 mb-2"
                >Notitie</label
            >
            <textarea
            {{-- {{dd($voorwerp)}} --}}
                name="Notities"
                id="Notities"
                placeholder="Notitie"
                class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"
            >{{ $voorwerp->Notities }}</textarea>
            @error('Notitie')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- CategorieUUID -->
        <div class="mb-4">
            <label for="CategorieUUID" class="block font-medium text-gray-700">Domein</label>
            <select name="CategorieUUID" id="CategorieUUID" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                @foreach($Categories as $category)
                    <option value="{{ $category->UUID }}" {{ $category->UUID == $voorwerp->categorie->UUID ? 'selected' : '' }}>
                        {{ $category->Naam }}
                    </option>
                @endforeach
            </select>
            @error('CategorieUUID')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- leeftijd begin -->
        <div class="mb-4">
            <label for="leeftijd_van" class="block font-medium text-gray-700 mb-2"
                >Leeftijd</label
            >
            <input
                type="number"
                name="leeftijd_van"
                id="leeftijd_van"
                placeholder="Leeftijd"
                value="{{ $voorwerp->leeftijd_van }}"
                class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"
            />
            @error('leeftijd_van')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- leeftijd eind -->
        <div class="mb-4">
            <label for="leeftijd_tot" class="block font-medium text-gray-700 mb-2"
                >tot</label
            >
            <input
                type="number"
                name="leeftijd_tot"
                id="leeftijd_tot"
                placeholder="Leeftijd"
                value="{{ $voorwerp->leeftijd_tot }}"
                class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"
            />
            @error('leeftijd_tot')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- QR -->
        <div class="mb-4">
            <label for="QR" class="block font-medium text-gray-700">QR</label>
            <img src="{{ $voorwerp->qr->qr }}" alt="QR Code" class="h-1/10">
            @error('QR')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Foto -->

        <!-- Display Uploaded Image -->
        <div
            id="image-preview"
            class="mb-4 w-full h-64 bg-gray-200 flex-col flex items-center justify-center rounded-md overflow-hidden"
        >

            @if (optional($voorwerp->Foto)->Foto)
            <img
                src="{{ optional($voorwerp->Foto)->Foto }}"
                alt="Uploaded Image"
                class="w-full h-full object-cover"
            />
            @else 
                <p class="text-gray-500">Geen foto geselecteerd</p>
            @endif
        </div>

        <input type="hidden" name="Foto" id="foto-base64">

        <!-- Buttons for Actions -->
        <div class="flex gap-4 mb-4 w-full">
            <!-- Button to Open Camera -->
            <button
                type="button"
                id="capture-photo"
                class="bg-[#019AAC] w-full text-white px-4 py-2 rounded shadow hover:bg-indigo-600"
            >
                Maak Foto
            </button>

            <!-- Button to Upload Photo -->

                <input
                    type="file"
                    name="ZoekFoto"
                    id="foto-input"
                    accept="image/*"
                    class="hidden"
                />
                <button type="button" id="select-photo" class="bg-[#019AAC] text-white px-4 w-full text-center py-2 rounded shadow cursor-pointer hover:bg-gray-600" >Zoek Foto</button>
        </div>


        <!-- Aanmaakdatum -->
        {{--
        <div class="mb-4">
            <label for="Aanmaakdatum" class="block font-medium text-gray-700"
                >Aanmaakdatum</label
            >
            <input
                type="date"
                name="Aanmaakdatum"
                id="Aanmaakdatum"
                placeholder="Aanmaakdatum"
                class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"
            />
            @error('Aanmaakdatum')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        --}}

        <!-- Actief -->
        <div class="mb-4">
            <label for="Actief" class="block font-medium text-gray-700">Actief</label>
            <select name="Actief" id="Actief" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                <option value="1" {{ $voorwerp->Actief == 1 ? 'selected' : '' }}>Ja</option>
                <option value="0" {{ $voorwerp->Actief == 0 ? 'selected' : '' }} >Nee</option>
            </select>
            @error('Actief')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div> 

        <div class="mb-4 w-full">
            <button
                type="submit"
                class="bg-[#019AAC] text-white py-2 px-4 rounded  w-full text-center"
            >
                Update
            </button>
        </div>
        <a
            href="{{ url('/voorwerpen') }}"
            class="block text-white w-full bg-[#C8304E] text-center py-2 rounded"
        >
            Annuleren
        </a>
    </form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const fileInput = document.getElementById("foto-input");
        const imagePreview = document.getElementById("image-preview");
        const capturePhotoButton = document.getElementById("capture-photo");
        const fotoBase64Input = document.getElementById("foto-base64");
        const selectPhotoButton = document.getElementById("select-photo");

        let video = null;
        let canvas = null;
        let context = null;

        if (fileInput && imagePreview && capturePhotoButton) {
            // Display selected image
            // fileInput.addEventListener("change", (event) => {
            //     const file = event.target.files[0];
            //     if (file) {
            //         const reader = new FileReader();
            //         reader.onload = (e) => {
            //             imagePreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover" alt="Selected Image">`;
            //         };
            //         reader.readAsDataURL(file);
            //     }
            // });

            fileInput.addEventListener("change", (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        canvas = document.createElement("canvas");
                        context = canvas.getContext("2d");
                        const img = new Image();
                        img.src = e.target.result;
                        img.onload = () => {
                            // Set canvas dimensions to the image dimensions
                            canvas.width = img.width;
                            canvas.height = img.height;
                            // Draw the image on the canvas
                            context.drawImage(img, 0, 0, img.width, img.height);
                            // Compress the image and get the Base64 string
                            const compressedBase64 = canvas.toDataURL('image/jpeg', 0.5); // Adjust the quality as needed
                            // Set the Base64 string to the hidden input
                            fotoBase64Input.value = compressedBase64;
                            // Display the compressed image
                            imagePreview.innerHTML = `<img src="${compressedBase64}" class="w-full h-full object-cover" alt="Selected Image">`;
                            fileInput.value = null; // Clear the input to allow selecting the same file again
                        };
                    };
                    reader.readAsDataURL(file);
                }
            });

            selectPhotoButton.addEventListener("click", () => {
            fileInput.click();
        });

            // Open camera for capturing photo
            capturePhotoButton.addEventListener("click", (event) => {
                event.preventDefault();
                // Check if getUserMedia is supported (for desktop browsers)
                if (
                    navigator.mediaDevices &&
                    navigator.mediaDevices.getUserMedia
                ) {
                    // Request camera access
                    navigator.mediaDevices
                        .getUserMedia({ video: true })
                        .then((stream) => {
                            // Create a video element to display the live camera stream
                            video = document.createElement("video");
                            video.srcObject = stream;
                            video.play();
                            video.setAttribute(
                                "class",
                                "w-full h-[82%] object-cover"
                            );

                            // Create a canvas to capture the image from the video
                            canvas = document.createElement("canvas");
                            context = canvas.getContext("2d");

                            // Insert video element into the image preview area
                            imagePreview.innerHTML = "";
                            imagePreview.appendChild(video);

                            // Add a "Capture" button below the video feed
                            const captureButton =
                                document.createElement("button");
                            captureButton.textContent = "Maak foto";
                            captureButton.classList.add(
                                "bg-[#019AAC]",
                                "text-white",
                                "px-4",
                                "py-2",
                                "rounded",
                                "mt-0",
                                "w-full", // Full width
                                "shadow",
                                "hover:bg-[#017f87]" // Darker shade for hover
                            );
                            imagePreview.appendChild(captureButton);

                            // Capture the photo when "Capture" button is clicked
                            captureButton.addEventListener("click", (event) =>  {
                                event.preventDefault()
                                // Set canvas size to match video size
                                canvas.width = video.videoWidth;
                                canvas.height = video.videoHeight;

                                // Draw video frame to canvas
                                context.drawImage(
                                    video,
                                    0,
                                    0,
                                    canvas.width,
                                    canvas.height
                                );

                                // Convert the image to a Data URL and update the preview

                                const resizedCanvas = document.createElement("canvas");
                                const resizedContext = resizedCanvas.getContext("2d");
                                const maxWidth = 800; // Set the desired width
                                const scaleSize = maxWidth / canvas.width;
                                resizedCanvas.width = maxWidth;
                                resizedCanvas.height = canvas.height * scaleSize;
                                resizedContext.drawImage(canvas, 0, 0, resizedCanvas.width, resizedCanvas.height);

                                const compressedDataUrl = resizedCanvas.toDataURL("image/jpeg", 0.5); // 0.7 is the quality (0 to 1)

                                imagePreview.innerHTML = `<img src="${compressedDataUrl}" class="w-full h-full object-cover" alt="Captured Image">`;

                                // Set the base64 string to the hidden input
                                fotoBase64Input.value = compressedDataUrl;

                                // const dataUrl = canvas.toDataURL();
                                // console.log(dataUrl);
                                // imagePreview.innerHTML = `<img src="${dataUrl}" class="w-full h-full object-cover" alt="Captured Image">`;

                                // Stop the video stream after capture
                                stream
                                    .getTracks()
                                    .forEach((track) => track.stop());
                            });
                        })
                        .catch((error) => {
                            console.error(
                                "Camera access denied or error occurred:",
                                error
                            );
                        });
                } else {
                    alert("Camera not supported in this browser.");
                }
            });
        } else {
            console.error(
                "Elements not found: Ensure 'foto-input', 'image-preview', and 'capture-photo' exist in the DOM."
            );
        }
    });
</script>
@stop