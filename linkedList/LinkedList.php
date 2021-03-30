<?php
require_once('Node.php');
class LinkedList {
    private Node $first, $last;
    private int $length;

    function __construct() {
        $this->first = new Node(0);
        $this->last = new Node(0);
        $this->length = 0;
    }

    /**
     * Returns the first element in the list.
     * 
     * @return Node
     */
    public function getFirst() {
        return ($this->length > 0?$this->first:null);
    }

    /**
     * Adds an element to the beginning of the list.
     * 
     * @param int $element
     */
    function addFirst(int $element) {
        $new = new Node($element);
        if ($this->length == 0)
            $this->last = $new;
        else
            $new->next = $this->first;
        
        $this->first = $new;
        ++$this->length;
    }

    /**
     * Adds an element to a specific position.
     * 
     * @param int $element
     * @param int $position
     */
    public function addMiddle(int $element, int $position) {
        if ($position <= 1) {
            $this->addFirst($element);
            return;
        }
        if ($position > $this->length) {
            $this->addLast($element);
            return;
        }
        if ($position > $this->length + 1)
            throw new Exception('Invalid position.');

        --$position;
        $aux = $this->first;
        for ($i = 1; $i < $position; ++$i)
            $aux = $aux->next;

        $new = new Node($element);
        $new->next = $aux->next;
        $aux->next = $new;
        ++$this->length;
    }

    /**
     * Adds an element to the end of the list.
     * 
     * @param int $element
     */
    public function addLast(int $element) {
        $new = new Node($element);
        if ($this->length == 0)
            $this->first = $new;
        else
            $this->last->next = $new;

        $this->last = $new;
        ++$this->length;
    }

    /**
     * Removes the first element from the list and returns it.
     * 
     * @return int
     */
    function removeFirst() {
        if ($this->length == 0)
            throw new Exception('Empty list.');
        $removed = $this->first->data;
        if ($this->length > 1)
            $this->first = $this->first->next;
        --$this->length;
        return $removed;
    }

    /**
     * Removes a specific element to the list.
     * 
     */
    function removeMiddle(int $position) {
        if ($position <= 1)
            return $this->removeFirst();
        else if ($position == $this->length)
            return $this->removeLast();
        if ($this->length == 0)
            throw new Exception('Empty list.');
        else if ($position > $this->length)
            throw new Exception('Invalid position.');
        
        $aux = $this->first;
        for ($i = 2; $i < $position; ++$i)
            $aux = $aux->next;
        $removed = $aux->next->data;
        $aux->next = $aux->next->next;
        --$this->length;
        return $removed;
    }

    function removeLast() {
        if ($this->length <= 1)
            return $this->removeFirst();
        $aux = $this->first;
        for ($i = 2; $i < $this->length; ++$i) {
            $aux = $aux->next;
        }
        $this->last = $aux;
        --$this->length;
        return $aux->next->data;
    }

    function remove(int $element) {
       
    }

    function getLength() {
        return $this->length;
    }

    function search($element) {

    }

    function toString() {
        if ($this->length == 0)
            return '[]';
        $aux = $this->first;
        $list = '['. $aux->data;
        for ($i = 2; $i <= $this->length; ++$i) {
            $aux = $aux->next;
            $list .= ', '. $aux->data;
        }
        return $list. ']'. $this->last->data;
    }
}