<?php
class Node {
    public int $data;
    public Node $next;

    function __construct(int $data) {
        $this->data = $data;
    }
}