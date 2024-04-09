<?php
    use App\Router;

    Router::get("/init", "ActionController@init");
    Router::get("/", "ViewController@main");
    Router::get("/users/find-id", "ApiController@findUserId");
    Router::post("/users/join", "ActionController@join", "guest");
    Router::post("/users/login", "ActionController@login", "guest");
    Router::get("/users/logout", "ActionController@logout");
    Router::get("/users/last-login", "ViewController@lastlogin");
    
    Router::get("/reservation", "ViewController@reservation");

    Router::start();