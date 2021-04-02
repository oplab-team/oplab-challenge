<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linked List</title>
    <style>
        #radios {
            list-style: none;
        }

        ul#linked_list {
            display: inline-block;
            padding: 0;
        }

        ul#linked_list li {
            display: inline-block;
        }

        .error {
            font-weight: bolder;
            color: red;
        }
    </style>
</head>
<body>
    <form action="">
        <label for="element">Element: </label>
        <input type="number" id="element" name="element" required>
        <label for="element">Position: </label>
        <input type="number" id="position" name="position" disabled required>
        <ul id="radios">
            <li>
                <input type="radio" id="add_first" name="operation" checked value="add_first">
                <label for="add_first">Add to the beginning</label>
            </li>
                <input type="radio" id="add_middle" name="operation" value="add_middle">
                <label for="add_middle">Add to the middle</label>
            <li>
                <input type="radio" id="add_last" name="operation" value="add_last">
                <label for="add_last">Add to the end</label>
            </li>
            <li>
                <input type="radio" id="remove_first" name="operation" value="remove_first">
                <label for="remove_first">Remove from the beginning</label>
            </li>
            <li>
                <input type="radio" id="remove_middle" name="operation" value="remove_middle">
                <label for="remove_middle">Remove from the middle</label>
            </li>
            <li>
                <input type="radio" id="remove_last" name="operation" value="remove_last">
                <label for="remove_last">Remove from the end</label>
            </li>
            <li>
                <input type="radio" id="remove" name="operation" value="remove">
                <label for="remove">Remove</label>
            </li>
            <li>
                <input type="radio" id="search" name="operation" value="search">
                <label for="search">Search</label>
            </li>
        </ul>
        <button name="submit" id="submit">Submit</button>
    </form>
    <?php
    require_once('LinkedList.php');
    if (!isset($_SESSION))
        session_start();

    // The linked list is stored in a session variable for next uses
    if (!isset($_SESSION['linked_list']))
        $_SESSION['linked_list'] = new LinkedList();
    
    if (isset($_GET['submit'])) {
        // Available operations for the linked list
        $listOperations = [
            'add_first' => function (array $node) {
                $_SESSION['linked_list']->addFirst($node['element']);
                return 'Item "'. $node['element']. '" successfully added to the beginning.';
            }, 'add_middle' => function (array $node) {
                $_SESSION['linked_list']->addMiddle($node['position'], $node['element']);
                return 'Item "'. $node['element'].
                    '" successfully added to the middle (position: '. $node['position'].').';
            }, 'add_last' => function (array $node) {
                $_SESSION['linked_list']->addLast($node['element']);
                return 'Item "'. $node['element']. '" successfully added to the end.';
            }, 'remove_first' => function () {
                return 'Item "'.$_SESSION['linked_list']->removeFirst().
                    '" successfully removed from the beginning.';
            }, 'remove_middle' => function (array $node) {
                return 'Item "'. $_SESSION['linked_list']->removeMiddle($node['position']).
                    '" successfully removed (position: '. $node['position']. ').';
            }, 'remove_last' => function () {
                return 'Item "'. $_SESSION['linked_list']->removeLast().
                    '" successfully removed from the end.';
            }, 'remove' => function (array $node) {
                return 'Item "'. $_SESSION['linked_list']->remove($node['element']).
                    '" succesfully removed.';
            }, 'search' => function (array $node) {
                $position = $_SESSION['linked_list']->search($node['element']);
                if ($position > 0)
                    return '"'. $node['element']. '" found in position '. $position. '.';
                return 'Element not found';
            }
        ];

        // Inputs
        $operation = empty($_GET['operation'])?'add_first':$_GET['operation'];
        $position = empty($_GET['position'])?-1:(int)$_GET['position'];
        $element = empty($_GET['element'])?-1:(int)$_GET['element'];
        // Processing and output
        try {
            if (is_int($element) && is_int($position)) {
                if (isset($listOperations[$operation]))
                    echo $listOperations[$operation](
                        [ 'element' => $element, 'position' => $position ]
                    );
            } else
                throw new Exception('Element and/or position invalid.');
        } catch (Exception $e) {
            echo '<p class="error">'. $e->getMessage(). '</p>';
        }
        echo '<div>Linked list: '. $_SESSION['linked_list']->getFormatedList(). '</div>';
    }
    ?>
    <script>
        // Enables and disables the inputs (element and position)
        function requireElement(isRequired) {
            document.getElementById('element').disabled = !isRequired;
        }

        function requirePosition(isRequired) {
            document.getElementById('position').disabled = !isRequired;
        }

        // Sets the activation of the element input based on the operation
        const requiredElement = {
            add_first: true, add_middle: true, add_last: true,
            remove_first: false, remove_middle: false, remove_last: false,
            remove: true, search: true
        }

        // Sets the activation of the position input based on the operation
        const requiredPosition = {
            add_first: false, add_middle: true, add_last: false,
            remove_first: false, remove_middle: true, remove_last: false,
            remove: false, search: false
        };
        
        // Uses the data structures above to set the activation of the inputs
        Object.keys(requiredElement).forEach(i => {
            document.getElementById(i).onclick = () => {
                requireElement(requiredElement[i]);
                requirePosition(requiredPosition[i]);
            };
        });
    </script>
</body>
</html>