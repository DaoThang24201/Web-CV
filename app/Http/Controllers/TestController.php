<?php

namespace App\Http\Controllers;

use App\Enums\FiletypeEnum;
use App\Enums\PostStatusEnum;
use App\Models\Company;
use App\Models\File;
use App\Models\Language;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class TestController extends Controller
{
    private $model;
    private $table;

    public function __construct()
    {
        $this->model = User::query();
        $this->table = (new User())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function test()
    {
        $companyName = 'DA CAP';
        $language = 'PHP';
        $city = 'HG';
        $link = 'aasjdhac';

        $company = Company::firstOrCreate([
            'name' => $companyName,
        ], [
            'city' => $city,
            'country' => 'VietNam',
        ]);

        $post = Post::create([
            'job_title' => $language,
            'company_id' => $company->id,
            'city' => $city,
            'status' => PostStatusEnum::ADMIN_APPROVED,
            //'status' =>1,
        ]);

        $languages = explode(',', $language);
        foreach ($languages as $language) {
            Language::firstOrCreate([
                'name' => trim($language),
            ]);
        }

        File::create([
           'post_id' => $post->id,
            'link' => $link,
            'type' => FiletypeEnum::JD,
        ]);

    }
}
