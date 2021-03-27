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

    public function getFirst() {
        return $this->first;
    }

    public function addFirst(int $element) {
        $new = new Node($element);
        if ($this->length == 0)
            $this->last = $new;
        else
            $new->next = $this->first;
        
        $this->first = $new;
        ++$this->length;
    }

    public function addMiddle(int $element, int $position) {
        if ($position <= 1) {
            $this->addFirst($element);
            return;
        }
        if ($position > $this->length) {
            $this->addLast($element);
            return;
        }
        --$position;
        $aux = $this->first;
        for ($i = 1; $i < $position; ++$i)
            $aux = $aux->next;

        $new = new Node($element);
        $new->next = $aux->next;
        $aux->next = $new;
        ++$this->length;
    }

    public function addLast(int $element) {
        $new = new Node($element);
        if ($this->length == 0)
            $this->first = $new;
        else
            $this->last->next = $new;

        $this->last = $new;
        ++$this->length;
    }

    function removeFirst() {
        $removed = $this->first;
        if ($this->length == 0)
            throw new Exception('Empty list.');
        if ($this->length > 1)
            $this->first = $this->first->next;
        --$this->length;
    }

    function removeLast() {
        if ($this->length == 0)
            throw new Exception('Empty list.');
        while (true) {

        }
        --$this->length;
    }

    function remove(int $element) {
       
    }

    function getLength() {
        return $this->length;
    }

    function toString() {
        $aux = $this->first;
        $list = '['. $aux->data;
        while (isset($aux->next)) {
            $aux = $aux->next;
            $list .= ', '. $aux->data;
        }
        return $list. ']';
    }
}