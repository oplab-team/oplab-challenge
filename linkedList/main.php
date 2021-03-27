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
        <button name="submit" value="2">Add to the end</button>
        <button name="submit" value=""></button>
    </form>
    <?php
    require_once('LinkedList.php');
    $linkedList = new LinkedList();
    $linkedList->addFirst(1);
    
    echo $linkedList->toString(). '<br>';
    $linkedList->addFirst(2); // 2-1

    echo $linkedList->toString(). '<br>';
    $linkedList->addLast(4); // 2-1-4

    echo $linkedList->toString(). '<br>';
    $linkedList->addMiddle(3, 3); // 2-3-4

    echo $linkedList->toString(). '<br>';
    if (isset($_GET['submit'])) {
        $linkedList = new LinkedList();
        switch($_GET['submit']) {
            case 1:
                $linkedList->addFirst($_GET['element']);
                break;
            case 2:
                break;
            case 3:
                break;
        }
    }
    ?>
</body>
</html>