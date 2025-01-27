@extends('layout.base')
@section('content')

<div class="">dasda</div>
<div id="reader" class="w-full"></div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code scanned = ${decodedText}`, decodedResult);

            // Stop the scanner after a successful scan
            html5QrCode.stop().then(() => {
                console.log("QR Code scanning stopped.");
                // Optionally, process the scanned text (e.g., send it to the backend)
            }).catch(err => {
                console.error("Failed to stop QR Code scanner.", err);
            });
        }

        function onScanError(error) {
            console.error(error);
        }

        const html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start({
                facingMode: "environment"
            }, // Use the back camera
            {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess,
            onScanError
        ).catch(err => console.error(err));
    });
</script>

@endsection
