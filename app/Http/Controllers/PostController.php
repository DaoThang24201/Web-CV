<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

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
}
