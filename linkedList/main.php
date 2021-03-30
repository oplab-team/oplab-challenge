<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linked List</title>
</head>
<body>
    <form action="">
        <label for="element">Element: </label>
        <input type="number" id="element" name="element">
        <button name="submit" value="1">Add to the beginning</button>
        <button name="submit" value="">Add to the middle</button>
        <button name="submit" value="2">Add to the end</button>
    </form>
    <?php
    require_once('LinkedList.php');
    $linkedList = new LinkedList();

    $linkedList->addFirst(1);
    echo $linkedList->toString(). '<br>';
    $linkedList->addMiddle(3, 2);
    $linkedList->addMiddle(0, 1);
    echo $linkedList->toString(). '<br>';
    try {
        echo $linkedList->removeMiddle(2). '<br>';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $linkedList->addFirst(2);
    echo $linkedList->toString(). '<br>';
    $linkedList->addLast(4);
    echo $linkedList->toString(). '<br>';

    if (isset($_GET['submit'])) {
        $linkedList = new LinkedList();
        switch($_GET['submit']) {
            case 1:
                $linkedList->addFirst($_GET['element']);
                break;
            case 2:
                $linkedList->addMiddle($_GET['element']);
                break;
            case 3:
                $linkedList->addLast($_GET['element']);
                break;
            case 4:
                break;
        }
    }
    ?>
</body>
</html>