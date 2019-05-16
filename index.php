<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Multimedia</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <script src="midi.js"></script>
</head>

<body style="background: #333;">

    <audio id="audio" src="audios/file_example_WAV_1MG.wav" type="audio/wav" autoplay></audio>

    <script>
        MIDIjs.play('audios/Destiny.mid');
    </script>

    <iframe id="iframe" src="media.php" width="100%" height="600" style="border: 0"></iframe>

</body>

</html>