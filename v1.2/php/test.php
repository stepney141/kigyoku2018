<?php

class X
{
    public static function f()
    {
        static $x;
        if (isset($x)) {
            echo "yes";
        } else {
            echo "no";
        }
    }
}

X::f();