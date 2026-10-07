<?php
interface middleware{
    public function handle(string ...$args):void;
}