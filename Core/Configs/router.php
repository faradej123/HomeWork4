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
    "cart/addproduct/(.*)" => [
        "POST" => [
            "controller" => "\\MikhailovIgor\\Controllers\\CartController",
            "action" => "addToCart",
            "params" => "$1",
        ],
    ],
    "admin" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\AdminController",
            "action" => "showAdminPanel",
            "params" => "",
        ],
    ],
    "cart" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\CartController",
            "action" => "showCart",
            "params" => "",
        ],
    ],
    "cart/confirmorder" => [
        "POST" => [
            "controller" => "\\MikhailovIgor\\Controllers\\CartController",
            "action" => "confirmOrder",
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