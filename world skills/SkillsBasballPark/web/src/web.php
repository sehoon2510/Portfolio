<?php
    use App\Router;

    Router::get("/init", "MainController@indexPage");

    Router::get("/", "MainController@indexPage");
    Router::post("/sign-up", "MainController@SignUp");
    Router::get("/sign-in", "MainController@SignIn", "guest");
    Router::get("/logout", "MainController@logout", "login");
    Router::get("/getUser", "MainController@getUser");

    Router::get("/information", "MainController@InformationPage");

    Router::get("/statistics", "MainController@StatisticsPage");

    Router::get("/reservation", "MainController@ReservationPage");
    Router::get("/reservation/gamedata", "MainController@ReservationGameList");
    Router::post("/reservation/add", "MainController@ReservationAdd", "login");
    Router::get("/reservation/delete", "MainController@ReservationDelete", "manager");
    Router::get("/reservation/pass", "MainController@ReservationPass", "manager");
    Router::get("/reservation/admin", "MainController@ReservationAdmin", "admin");
    Router::get("/reservation/userBuy", "MainController@ReservationBuy", "login");
    Router::post("/reservation/red", "MainController@ReservationRed", "login");

    Router::get("/goods", "MainController@GoodsPage");
    Router::get("/goods/item", "MainController@GoodsItems");
    Router::get("/goods/user", "MainController@UserGoods", "user");
    Router::get("/goods/cart", "MainController@CartGoods", "user");
    Router::post("/goods/buy", "MainController@BuyGoods", "user");
    Router::get("/goods/page", "MainController@BuyPage", "user");
    Router::post("/goods/add", "MainController@GoodsAdd", "manager");

    Router::get("/mypage", "MainController@Mypage", "user");

    Router::connect();