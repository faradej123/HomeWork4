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
    "admin" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\AdminController",
            "action" => "showAdminPanel",
            "params" => "",
        ],
    ],
    "admin/order-list" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\AdminController",
            "action" => "showOrders",
            "params" => "",
        ],
    ],
    "admin/product-edit" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\AdminController",
            "action" => "showProductEditPanel",
            "params" => "",
        ],
    ],
    "admin/deleteproduct/(.*)" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\AdminController",
            "action" => "deleteProduct",
            "params" => "$1",
        ],
    ],
    "admin/createproduct" => [
        "POST" => [
            "controller" => "\\MikhailovIgor\\Controllers\\AdminController",
            "action" => "createProduct",
            "params" => "",
        ],
    ],
    "admin/xmlexport" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\AdminController",
            "action" => "xmlExport",
            "params" => "",
        ],
    ],
    "admin/jsonexport" => [
        "GET" => [
            "controller" => "\\MikhailovIgor\\Controllers\\AdminController",
            "action" => "jsonExport",
            "params" => "",
        ],
    ],
];