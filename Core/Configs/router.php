<?php

return [
    "" => [
        "GET" => [
            "controller" => "MikhailovIgor\\Controllers\\HomePageController",
            "action" => "showProducts",
            "params" => "",
        ],
    ],
    "export/(.*)" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\ExportController",
            "action" => "makeExport",
            "params" => "$1",
        ],
    ],
    "signup" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\SignUpController",
            "action" => "showRegistrationForm",
            "params" => "",
        ],
    ],"signup/do" => [
        "POST" => [
            "controller" => "\\MikhailovIgor\\Controllers\\SignUpController",
            "action" => "doRegistration",
            "params" => "",
        ],
    ],
    "signin" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\SignInController",
            "action" => "showSignInForm",
            "params" => "",
        ],
    ],
    "signin/do" => [
        "POST" => [
            "controller" => "\\MikhailovIgor\\Controllers\\SignInController",
            "action" => "doSignIn",
            "params" => "",
        ],
    ],
    "signout" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\SignOutController",
            "action" => "signOut",
            "params" => "",
        ],
    ],
];

/*return [
    "/" => [
        "GET" => [
            "controller" => "MikhailovIgor\\Controllers\\HomePageController",
            "action" => "showUrls",
        ],
    ],
    "/hw1" => [
        "GET" => [
            "controller" => "MikhailovIgor\\Controllers\\HomeWork1Controller",
            "action" => "showHomeWork",
        ],
    ],
    "/hw2" => [
        "GET" => [
            "controller" => "MikhailovIgor\\Controllers\\HomeWork2Controller",
            "action" => "showHomeWork",
        ],
    ],
];*/