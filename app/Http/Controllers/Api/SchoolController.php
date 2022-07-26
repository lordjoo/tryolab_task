<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\SchoolService;

class SchoolController extends Controller
{

    private ApiResponse $response;
    private SchoolService $service;

    public function __construct(ApiResponse $response)
    {
        $this->response = $response;
        $this->service = new SchoolService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $students = $this->service->getAll();
            return $this->response->success("DATA_FETCHED",$students)->return();
        } catch (\Exception $e) {
            return $this->response->error($e->getMessage());
        }
    }

}
