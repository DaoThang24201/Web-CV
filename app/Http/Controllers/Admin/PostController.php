<?php

namespace App\Http\Controllers\Admin;

use App\Imports\PostImport;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    private $model;
    private $table;

    public function __construct()
    {
        $this->model = Post::query();
        $this->table = (new Post())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function index()
    {


        return view('admin.posts.index');
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function importCsv(Request $request)
    {
        Excel::import(new PostImport(),request()->file('file'));
    }
}
