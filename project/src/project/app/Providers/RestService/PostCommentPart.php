<?php

namespace App\Providers\RestService;

use Illuminate\Foundation\Application;
use App\Http\Controllers\PostCommentController;
use App\Http\Repositories\Classes\PostCommentRepositoryImpl;
use App\Http\Requests\RestRequests\RestRequest;
use App\Http\Requests\RestRequests\PostCommentRestRequest;
use App\Http\Services\Classes\PostCommentServiceImpl;
use App\Http\Services\Interfaces\PostCommentService;
use Illuminate\Support\ServiceProvider;

class PostCommentPart{
    static function run()
    {
        app()->singleton(PostCommentRestRequest::class, function () {
            return new PostCommentRestRequest();
        });

        app()->singleton(PostCommentService::class, function () {
            return new PostCommentServiceImpl(new PostCommentRepositoryImpl());
        });

        app()->singleton(PostCommentController::class, function () {
            return new PostCommentController(app()->make(PostCommentService::class), app()->make(PostCommentRestRequest::class));
        });
    }

    static function mainRun(){
        app()->singleton(RestRequest::class, function () {
            return app()->make(PostCommentRestRequest::class);
        });
    }
}
