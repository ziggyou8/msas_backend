<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="MSAS API documentation",
     *      description=" Ministère de la santé et de l'action sociale API with in Laravel & passport",
     *      @OA\Contact(
     *          email="magueye717@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="MSAS API Server"
     * )
     * 
     * @OA\SecurityScheme(
     *      securityScheme="bearerAuth",
     *      type="http",
     *      scheme="bearer",
     * ),
     *
     *
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
