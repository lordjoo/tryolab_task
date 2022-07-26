<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    private ApiResponse $response;
    private StudentService $service;

    public function __construct(ApiResponse $response)
    {
        $this->response = $response;
        $this->service = new StudentService();
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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        try {
            $student = $this->service->create($request->all());
            return $this->response->success("DATA_CREATED",$student)->return();
        } catch (\Exception $e) {
            return $this->response->error($e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        try {
            $student = $this->service->update($id, $request->all());
            return $this->response->success("DATA_UPDATED",$student)->return();
        } catch (\Exception $e) {
            return $this->response->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        try {
            $student = $this->service->delete($id);
            return $this->response->success("DATA_DELETED",$student)->return();
        } catch (\Exception $e) {
            return $this->response->error($e->getMessage());
        }
    }

}
