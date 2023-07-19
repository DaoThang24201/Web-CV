<?php

namespace App\Http\Controllers;

use App\Imports\PostImport;
use App\Models\Post;
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

    public function index()
    {
        return $this->model->paginate();
    }

    public function import_csv(Request $request) {
        Excel::import(new PostImport, $request->file('file'));
    }
}
