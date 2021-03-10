<?php

return [
    "" => [
        "GET" => [
            "controller" => "MikhailovIgor\\Controllers\\HomePageController",
            "action" => "showUrls",
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
    "registration" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\RegistrationController",
            "action" => "showRegistrationForm",
            "params" => "",
        ],
    ],"registration/do" => [
        "POST" => [
            "controller" => "\\MikhailovIgor\\Controllers\\RegistrationController",
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