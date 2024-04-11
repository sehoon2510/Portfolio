<?php

    use APP\Router;

    Router::get("/", "MainController@indexPage");
    Router::get("/store", "MainController@storePage");

    Router::get("/knowhows", "MainController@knowhowsPage");
    Router::get("/knowhows/data", "MainController@knowhowsData");
    Router::post("/knowhows/write", "MainController@knowhowsWrite");
    Router::post("/knowhows/rivew", "MainController@knowhowsRivew");

    Router::get("/specialist", "MainController@specialistPage");
    Router::post("/experts/reviews", "MainController@specialistReview");

    Router::get("/estimates", "MainController@estimatesPage");
    Router::post("/estimates/write", "MainController@estimatesWrite");
    Router::post("/estimates/review", "MainController@estimatesReview");
    Router::get("/estimates/get", "MainController@estimatesGet");
    Router::post("/estimates/check", "MainController@estimatesCheck");

    Router::post("/sign-up", "UserController@signUp");
    Router::post("/sign-in", "UserController@signIn");
    Router::get("/logout", "UserController@logout", "user");
    Router::get("/test", "MainController@indexPage");

    Router::connect();