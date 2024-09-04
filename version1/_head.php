<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<style>
    #info {
    position: fixed;
    color: #fff;
    background: #666;
    border: 1px solid #333;
    border-radius: 5px;
    padding: 10px 20px;
    left: 50%;
    translate: -50% 0;
    z-index: 999;

    top: -50px;
    opacity: 0;
}

#info:not(:empty) {
    animation: fade 5s;
}

@keyframes fade {
      0% { top: -100px; opacity: 0; }
     10% { top:  100px; opacity: 1; }
     90% { top:  100px; opacity: 1; }
    100% { top: -100px; opacity: 0; }
}

</style>
<body>
    <!-- Flash message -->
    <div id="info"><?= temp('info') ?></div>
    <main>
