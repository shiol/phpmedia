<form id="form" method="post">
    <div class="box">
        <?php

        //diretorio de imagens
        $dir = 'images';
        $a = array();
        $random = mt_rand();

        //carrega array com imagem aleatoria
        if ($handle = opendir($dir)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    array_push($a, $dir . '/' . $entry);
                }
            }
            closedir($handle);
        }

        //seleciona imagem aleatoria e carrega
        $src = $a[array_rand($a)];
        echo '<img src="' . $src . '" width="300">';

        //inicia session
        session_start();

        //verifica score
        $score = 0;
        if (isset($_SESSION['score']))
            $score = (int)$_SESSION['score'];
        else
            $_SESSION['score'] = $score;

        //inicia tipo
        $type = explode('.', $src)[1];
        echo '<input type="hidden" name="type" value="' . $type . '" />';

        //verifica tipo e resposta
        $answer = '';
        if (isset($_POST['action']) && isset($_POST['type']) && isset($_POST['answer'])) {
            $type = $_POST['type'];
            $answer = $_POST['answer'];
        }

        //adiciona score
        if ($type == 'svg' && $answer == 'vetorial') {
            $score += 1;
            $_SESSION['score'] = $score;
        } else if (($type == 'jpg' || $type == 'png' || $type == 'bmp') && $answer == 'bitmap') {
            $score += 1;
            $_SESSION['score'] = $score;
        } else if ($type == 'gif'  && $answer == 'animation') {
            $score += 1;
            $_SESSION['score'] = $score;
        }

        //limpa score
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