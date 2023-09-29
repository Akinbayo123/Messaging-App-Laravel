<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamschat.dreamguystech.com/mobile/template-bootstrap/chat.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Sep 2023 10:44:49 GMT -->
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#000">
<title>DreamsChat - HTML Mobile Template</title>
<base href="/public">
<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
</head>
<body>

<div id="message-container">
    {{ $slot }}

</div>
    <script>
   window.onload = function() {
        // Replace 'latest-message-id' with the actual ID of the latest message
        //var latestMessageId =
        
        // Scroll to the latest message element
        var latestMessageElement = document.getElementById('message-' + latest);
        if (latestMessageElement) {
            latestMessageElement.scrollIntoView({ behavior: 'smooth' });
        }
    };
    </script>
<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/script.js"></script>
</body>

</html>