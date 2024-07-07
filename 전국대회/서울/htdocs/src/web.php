<?php

    use App\Router;

    Router::get("/", "MainController@indexPage");
    Router::get("/signup", "MainController@signupPage");
    Router::get("/login", "MainController@loginPage");
    Router::get("/message", "MainController@messagePage");
    Router::get("/festivalList", "MainController@festivalListPage");
    Router::get("/festivalData/{id}", "MainController@festivalDataPage");
    Router::get("/festivalNotice/{id}", "MainController@festivalNoticePage");
    Router::get("/festivalNoticeData/{id}", "MainController@festivalNoticeDataPage");
    Router::get("/festivalNoticeWrtie/{id}", "MainController@festivalNoticeWrtiePage");
    Router::get("/festivalAdd", "MainController@festivalAddPage");
    Router::get("/festivalEdit/{id}", "MainController@festivalEditPage");
    Router::get("/mypage", "MainController@myPage");

    Router::post("/signup", "UserController@signUp");
    Router::post("/login", "UserController@login");
    Router::get("/logout", "UserController@logout");
    Router::post("/festivalGood", "FestivalController@GoodAdd");
    Router::post("/messageAccept", "FestivalController@messageAccept");
    Router::post("/festivalTicket", "FestivalController@TicketBuy");
    Router::post("/festivalAttend", "FestivalController@FestivalAttend");
    Router::post("/festivalReview", "FestivalController@FestivalReview");
    Router::post("/festivalAdd", "FestivalController@FestivalAdd");
    Router::post("/festivalEdit", "FestivalController@FestivalEdit");
    Router::post("/questionAdd", "FestivalController@QuestionAdd");
    Router::post("/answerAdd", "FestivalController@AnswerAdd");
    Router::post("/festivalNoticeWrtie", "FestivalController@festivalNoticeWrtie");
    Router::post("/messageAction", "MainController@messageAction");    

    Router::RouterStart();