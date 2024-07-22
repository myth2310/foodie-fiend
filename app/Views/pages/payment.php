<!DOCTYPE html>
<html>
<head>
    <title>Midtrans Payment</title>
</head>
<body>
    <button id="pay-button">Pay!</button>

    <!-- Load Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= config('Midtrans')->clientKey ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('<?= $snapToken ?>');
        };
    </script>
</body>
</html>
