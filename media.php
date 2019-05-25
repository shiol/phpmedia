<?php
echo '<form id="form" method="post">';

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

//select random image and show image box
$src = $a[array_rand($a)];
echo '<div class="box">';
echo '<img src="' . $src . '" height="300">';
echo '</div>';

//check score
$score = 0;
if (isset($_POST['score']))
    $score += (int)$_POST['score'];

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
    echo '<audio id="audio" src="audios/goal.wav" type="audio/wav" autoplay></audio>';
} else if (($type == 'jpg' || $type == 'png' || $type == 'bmp') && $answer == 'matricial') {
    $score += 1;
    echo '<audio id="audio" src="audios/goal.wav" type="audio/wav" autoplay></audio>';
} else if ($type == 'gif'  && $answer == 'animation') {
    $score += 1;
    echo '<audio id="audio" src="audios/goal.wav" type="audio/wav" autoplay></audio>';
} else if ($answer != 'clear' && isset($_POST['action'])) {
    echo '<audio id="audio" src="audios/error.wav" type="audio/wav" autoplay></audio>';
}

//clean score
if ($answer == 'clear') {
    $score = 0;
    echo '<audio id="audio" src="audios/clear.wav" type="audio/wav" autoplay></audio>';
}

//show score box
echo '<div class="box">';
echo 'Score: ';
echo $score . ' / 10';
echo '</div>';

//show question box
echo '<div class="box">';
echo 'O que eu sou?';
echo '</div>';

//if user won, then disabled answers buttons
if ($score == 10) {
    echo '<div class="box">';
    echo '<input type="hidden" name="action" value="submit" />';
    echo '<input type="submit" name="answer" value="vetorial" disabled>';
    echo '<input type="submit" name="answer" value="matricial" disabled>';
    echo '<input type="submit" name="answer" value="animation" disabled>';
    echo '<input type="submit" name="answer" value="clear">';
    echo '</div>';
} else {
    echo '<div class="box">';
    echo '<input type="hidden" name="action" value="submit" />';
    echo '<input type="submit" name="answer" value="vetorial">';
    echo '<input type="submit" name="answer" value="matricial">';
    echo '<input type="submit" name="answer" value="animation">';
    echo '<input type="submit" name="answer" value="clear">';
    echo '</div>';
}

//if user won, show win box
if ($score == 10) {
    $score = 0;
    echo '<div class="box">Você venceu!</div>';
    echo '<audio id="audio" src="audios/won.wav" type="audio/wav" autoplay></audio>';
}

//post score result
echo '<input type="hidden" name="score" value="' . $score . '">';

echo '</form>';
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

    body {
        background: #333;
    }

    input[type=button],
    input[type=submit],
    input[type=reset] {
        border-radius: 10px;
        min-width: 100px;
        min-height: 30px;
        margin-left: 10px;
    }
</style>