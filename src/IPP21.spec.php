<?php
    $IPP21_LANG = [
        "instructions" => [
            "ADD" => [
                "op"  => "add",
                "args_count" => 3,
            ],

            "SUB" => [
                "args_count" => 3,
                "op"  => "sub"
            ],

            "MUL" => [
                "op"  => "mul",
                "args_count" => 3
            ],

            "IDIV" => [
                "op"  => "idiv",
                "args_count" => 3
            ],

            "DIV" => [
                "op"  => "div",
                "args_count" => 3
            ],

            "LT" => [
                "op"  => "lt",
                "args_count" => 3
            ],

            "GT" => [
                "op"  => "gt",
                "args_count" => 3
            ],

            "EQ" => [
                "op"  => "eq",
                "args_count" => 3
            ],

            "AND" => [
                "op"  => "and",
                "args_count" => 3
            ],

            "OR" => [
                "op"  => "or",
                "args_count" => 3
            ],

            "NOT" => [
                "op"  => "not",
                "args_count" => 2
            ],

            "INT2CHAR" => [
                "op"  => "int2char",
                "args_count" => 2
            ],

            "STRI2INT" => [
                "op"  => "stri2int",
                "args_count" => 3
            ],

            /**
             * I/O
             */

            "READ" => [
                "op"  => "read",
                "args_count" => 2
            ],

            "WRITE" => [
                "op"  => "write",
                "args_count" => 1
            ],

            /**
             * Strings
             */

            "CONCAT" => [
                "op"  => "concat",
                "args_count" => 3
            ],

            "STRLEN" => [
                "op"  => "strlen",
                "args_count" => 2
            ],

            "GETCHAR" => [
                "op"  => "getchar",
                "args_count" => 3
            ],

            "SETCHAR" => [
                "op"  => "setchar",
                "args_count" => 3
            ],

            /**
             * TYPES
             */

            "TYPE " => [
                "op"  => "type",
                "args_count" => 2
            ],

            /**
             * PROGRAM CONTROL
             */

            "LABEL" => [
                "op"  => "label",
                "args_count" => 1
            ],

            "JUMP" => [
                "op"  => "jump",
                "args_count" => 1
            ],

            "JUMPIFNEQ" => [
                "op"  => "jumpifneq",
                "args_count" => 3
            ],

            "JUMPIFEQ" => [
                "op"  => "jumpifeq",
                "args_count" => 3
            ],

            "EXIT" => [
                "op"  => "exit",
                "args_count" => 1
            ],

            /**
             * Debug
             */

            "DPRINT" => [
                "op"  => "dprint",
                "args_count" => 1
            ],

            "BREAK" => [
                "op"  => "break",
                "args_count" => 0
            ],

            "PUSHS" => [
                "op"  => "pushs",
                "args_count" => 1
            ],

            "POPS" => [
                "op"  => "pops",
                "args_count" => 1
            ],

            "TYPE" => [
                "op"  => "type",
                "args_count" => 2
            ],

            /**
             * functions
             */

            "MOVE" => [
                "op"  => "move",
                "args_count" => 2
            ],

            "CREATEFRAME" => [
                "op"  => "CREATEFRAME",
                "args_count" => 0
            ],

            "PUSHFRAME" => [
                "op"  => "PUSHFRAME",
                "args_count" => 0
            ],

            "POPFRAME" => [
                "op"  => "POPFRAME",
                "args_count" => 0
            ],

            "DEFVAR" => [
                "op"  => "defvar",
                "args_count" => 1
            ],

            "CALL" => [
                "op"  => "CALL",
                "args_count" => 1
            ],

            "RETURN" => [
                "op"  => "RETURN",
                "args_count" => 0
            ]
            
        ]
    ];
?>