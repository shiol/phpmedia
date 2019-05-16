<form id="form" method="post">
    <div class="box">
        <?php

        //directory
        $dir = 'images';
        $a = array();
        $random = mt_rand();

        //load array with random image
        if ($handle = opendir($dir)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    array_push($a, $dir . '/' . $entry);
                }
            }
            closedir($handle);
        }

        //select random image
        $src = $a[array_rand($a)];
        echo '<img src="' . $src . '" width="300">';

        //start session
        session_start();

        //check score
        $score = 0;
        if (isset($_SESSION['score']))
            $score = (int)$_SESSION['score'];
        else
            $_SESSION['score'] = $score;

        //start type
        $type = explode('.', $src)[1];
        echo '<input type="hidden" name="type" value="' . $type . '" />';

        //check type and answer
        $answer = '';
        if (isset($_POST['action']) && isset($_POST['type']) && isset($_POST['answer'])) {
            $type = $_POST['type'];
            $answer = $_POST['answer'];
        }

        //add score
        if ($type == 'svg' && $answer == 'vetorial') {
            $score += 1;
            $_SESSION['score'] = $score;
            echo '<audio id="audio" src="audios/goal.wav" type="audio/wav" autoplay></audio>';
        } else if (($type == 'jpg' || $type == 'png' || $type == 'bmp') && $answer == 'bitmap') {
            $score += 1;
            $_SESSION['score'] = $score;
            echo '<audio id="audio" src="audios/goal.wav" type="audio/wav" autoplay></audio>';
        } else if ($type == 'gif'  && $answer == 'animation') {
            $score += 1;
            $_SESSION['score'] = $score;
            echo '<audio id="audio" src="audios/goal.wav" type="audio/wav" autoplay></audio>';
        }

        //clean score
        if ($answer == 'clear') {
            unset($_SESSION['score']);
        }

        ?>
    </div>

    <div class="box">
        Score: <?php if (isset($_SESSION['score'])) echo $_SESSION['score'] . ' / 10';
                else echo '0' . ' / 10'; ?>
    </div>

    <div class="box">
        O que eu sou?
    </div>

    <div class="box">
        <input type="hidden" name="action" value="submit" />
        <input type="submit" name="answer" value="vetorial">
        <input type="submit" name="answer" value="bitmap">
        <input type="submit" name="answer" value="animation">
        <input type="submit" name="answer" value="clear">
    </div>
</form>

<?php
//check if user won
if (isset($_SESSION['score'])) {
    $score = (int)$_SESSION['score'];
    if ($score == 10) {
        unset($_SESSION['score']);
        echo '<div class="box">Você venceu!</div>';
    }
}
?>

<style>
    .box {
        border: 1px solid gray;
        border-radius: 10px;
        margin: 10px;
        padding: 10px;
        text-align: center;
        width: auto;
        color: lightgray;
    }
</style>

<script>
    function send() {
        var iframe = document.getElementById('iframe');
        iframe.src = iframe.src;
    }
</script>