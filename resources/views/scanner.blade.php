<!DOCTYPE html>
<html>
<head>
    <title>QR Code Scanner</title>
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<body>
    
    <h1>QR Code Scanner</h1>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <div id="reader" width="600px"></div>
    <form id="qr-form" action="{{ route('scanner.scan') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="qr_code" id="qr-code">
        <button type="submit">Submit</button>
    </form>
    
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Handle the result here
            document.getElementById('qr-code').value = decodedText;
            document.getElementById('qr-form').submit();
        }

        function onScanFailure(error) {
            // Handle the error here
            console.warn(`QR error = ${error}`);
        }

        // Initialize the scanner after the page has loaded
        window.addEventListener('load', function() {
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
    </script>
</body>
</html>
