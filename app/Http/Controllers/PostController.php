<?php

namespace App\Http\Controllers;

use App\Imports\PostImport;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = Post::query();
    }

    public function index(): JsonResponse
    {
        $data = $this->model->paginate();
        foreach ($data as $each) {
            $each->append('currency_salary_code');
            $each->append('status_name');
        }

        return response()->json([
            'success' => true,
            'data' => $data->getCollection(),
            'pagination' => $data->linkCollection(),
        ]);
    }
}
