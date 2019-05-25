<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Multimedia</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>

<body style="background: #333;">

    <audio id="audio" src="audios/track.mp3" type="audio/mp3" autoplay></audio>

    <iframe id="iframe" src="media.php" width="100%" height="600" style="border: 0"></iframe>

    <script>
        var x = document.getElementById("audio");
        window.onload = function() {
            x.volume = "0.3";
        };
    </script>
</body>

</html>