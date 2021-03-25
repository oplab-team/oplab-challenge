<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bubble Short</title>
</head>
<body>
    <form action="">
        <label for="arr">Digite um array (vetor):</label>
        <input type="text" id="arr" name="arr" placeholder="Ex: 1 2 9 4 78"
            value="<?php echo isset($_GET['arr'])?$_GET['arr']:'' ?>">
        <button name="submit" value="submit">Short</button>
    </form>
    <div id="result">
        <?php
            /**
             * Receives an array and returns it sorted
             * 
             * @param array $arr
             * @return array
             */
            function bubbleShort(array $arr) {
                do {
                    $hasChanged = false;
                    for ($i = 0; $i < count($arr) - 1; ++$i) {
                        if ($arr[$i] > $arr[$i + 1]) {
                            $aux = $arr[$i];
                            $arr[$i] = $arr[$i + 1];
                            $arr[$i + 1] = $aux;
                            $hasChanged = true;
                        }
                    }
                } while ($hasChanged);
                return $arr;
            }
            // Check if the submit button was pressed
            if ($_GET['submit']) {
                try {
                    $arr = explode(' ', $_GET['arr']);
                    $arr = bubbleShort($arr);
                    echo '<p>Array (vetor) ordenado:</p><p>';
                    foreach($arr as $e) {
                        echo $e. ' ';
                    }
                    echo '</p>';
                } catch (Exception $e) {
                    echo '<p style="color: red">Ocorreu um erro ao tentar ordenar o vetor, '. 
                        'verifique os dados e os envie novamente.</p>';
                }
            }
        ?>
    </div>
</body>
</html>