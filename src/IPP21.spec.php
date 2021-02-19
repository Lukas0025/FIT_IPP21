<?php
    $IPP21_LANG = [
        "types" => [
            "str",
            "int",
            "float",
            "bool",
            "var",
            "type"
        ],

        "instructions" => [
            "ADD" => [
                "op"  => "add",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["int", "float"]],
                    2 => ["type" => ["int", "float"]]
                ],
                "same"   => [],
                "write" => [
                    0 => [1,2] //slected by input
                ]
            ],

            "SUB" => [
                "args_count" => 3,
                "op"  => "sub",
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["int", "float"]],
                    2 => ["type" => ["int", "float"]]
                ],
                "same"   => [],
                "write" => [
                    0 => [1,2] //slected by input
                ]
            ],

            "MUL" => [
                "op"  => "mul",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["int", "float"]],
                    2 => ["type" => ["int", "float"]]
                ],
                "same"   => [],
                "write" => [
                    0 => [1,2] //slected by input
                ]
            ],

            "IDIV" => [
                "op"  => "idiv",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["int"]],
                    2 => ["type" => ["int"]]
                ],
                "same"   => [],
                "write" => [
                    0 => "int"
                ]
            ],

            "DIV" => [
                "op"  => "div",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["int", "float"]],
                    2 => ["type" => ["int", "float"]]
                ],
                "same"   => [],
                "write" => [
                    0 => "float"
                ]
            ],

            "LT" => [
                "op"  => "lt",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["int", "bool", "str", "float"]],
                    2 => ["type" => ["int", "bool", "str", "float"]]
                ],
                "same"   => [[1,2]],
                "write" => [
                    0 => "bool"
                ]
            ],

            "GT" => [
                "op"  => "gt",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["int", "bool", "str", "float"]],
                    2 => ["type" => ["int", "bool", "str", "float"]]
                ],
                "same"   => [[1,2]],
                "write" => [
                    0 => "bool"
                ]
            ],

            "EQ" => [
                "op"  => "eq",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["int", "bool", "str", "float"]],
                    2 => ["type" => ["int", "bool", "str", "float"]]
                ],
                "same"   => [[1,2]],
                "write" => [
                    0 => "bool"
                ]
            ],

            "\AND" => [
                "op"  => "and",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["bool"]],
                    2 => ["type" => ["bool"]]
                ],
                "same"   => [],
                "write" => [
                    0 => "bool"
                ]
            ],

            "OR" => [
                "op"  => "or",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["bool"]],
                    2 => ["type" => ["bool"]]
                ],
                "same"   => [],
                "write" => [
                    0 => "bool"
                ]
            ],

            "NOT" => [
                "op"  => "not",
                "args_count" => 2,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["bool"]]
                ],
                "same"   => [],
                "write" => [
                    0 => "bool"
                ]
            ],

            "INT2CHAR" => [
                "op"  => "int2char",
                "args_count" => 2,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["int"]]
                ],
                "same"   => [],
                "write" => [
                    0 => "int"
                ]
            ],

            "STRI2INT" => [
                "op"  => "stri2int",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["str"]],
                    2 => ["type" => ["int"]]
                ],
                "same"   => [],
                "write" => [
                    0 => "int"
                ]
            ],

            /**
             * I/O
             */

            "READ" => [
                "op"  => "read",
                "args_count" => 2,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["type"]]
                ],
                "same"   => [],
                "write" => [
                    0 => "1" // " means from data type in arg 1
                ]
            ],

            "WRITE" => [
                "op"  => "write",
                "args_count" => 1,
                "args" => [
                    0 => ["type" => ["var", "int", "str", "bool", "float"]]
                ],
                "same"   => [],
                "write" => []
            ],

            /**
             * Strings
             */

            "CONCAT" => [
                "op"  => "concat",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["str"]],
                    2 => ["type" => ["str"]]
                ],
                "same"   => [],
                "write" => [
                    0 => "str"
                ]
            ],

            "STRLEN" => [
                "op"  => "strlen",
                "args_count" => 2,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["str"]]
                ],
                "same"   => [],
                "write" => [
                    0 => "int"
                ]
            ],

            "GETCHAR" => [
                "op"  => "getchar",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["str"]],
                    2 => ["type" => ["int"]],
                ],
                "same"   => [],
                "write" => [
                    0 => "str"
                ]
            ],

            "SETCHAR" => [
                "op"  => "setchar",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["int"]],
                    2 => ["type" => ["str"]],
                ],
                "same"   => [],
                "write" => [
                    0 => "str"
                ]
            ],

            /**
             * TYPES
             */

            "TYPE " => [
                "op"  => "type",
                "args_count" => 2,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["int", "bool", "str", "float"]],
                ],
                "same"   => [],
                "write" => [
                    0 => "str"
                ]
            ],

            /**
             * PROGRAM CONTROL
             */

            "LABEL" => [
                "op"  => "label",
                "args_count" => 1,
                "args" => [
                    0 => ["type" => ["label"]],
                ],
                "same"   => [],
                "write" => []
            ],

            "JUMP" => [
                "op"  => "jump",
                "args_count" => 1,
                "args" => [
                    0 => ["type" => ["label"]],
                ],
                "same"   => [],
                "write" => []
            ],

            "MOVE" => [
                "op"  => "move",
                "args_count" => 2,
                "args" => [
                    0 => ["type" => ["var"]],
                    1 => ["type" => ["var", "int", "str", "bool", "float"]],
                ],
                "same"   => [],
                "write" => [
                    0 => 1
                ]
            ],

            "DEFVAR" => [
                "op"  => "defvar",
                "args_count" => 1,
                "args" => [
                    0 => ["type" => ["var"]],
                ],
                "same"   => [],
                "write" => []
            ],

            "JUMPIFNEQ" => [
                "op"  => "jumpifneq",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["label"]],
                    1 => ["type" => ["var", "int", "bool", "str", "float"]],
                    2 => ["type" => ["var", "int", "bool", "str", "float"]],
                ],
                "same"   => [[1,2]],
                "write" => []
            ],

            "JUMPIFEQ" => [
                "op"  => "jumpifeq",
                "args_count" => 3,
                "args" => [
                    0 => ["type" => ["label"]],
                    1 => ["type" => ["var", "int", "bool", "str", "float"]],
                    2 => ["type" => ["var", "int", "bool", "str", "float"]],
                ],
                "same"   => [[1,2]],
                "write" => []
            ],

            "EXIT" => [
                "op"  => "exit",
                "args_count" => 1,
                "args" => [
                    0 => ["type" => ["exit_code"]]
                ],
                "same"   => [],
                "write" => []
            ],

            /**
             * Debug
             */

            "DPRINT" => [
                "op"  => "dprint",
                "args_count" => 1,
                "args" => [
                    0 => ["type" => ["var", "int", "bool", "str", "float"]]
                ],
                "same"   => [],
                "write" => []
            ],

            "BREAK" => [
                "op"  => "break",
                "args_count" => 0,
                "args" => [],
                "same"   => [],
                "write" => []
            ],
            
        ]
    ];
?>