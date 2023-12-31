<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class UserController extends Controller
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

    public function index(Request $request)
    {
        $selectedRole = $request->get('role');
        $selectedCity = $request->get('city');
        $selectedCompany = $request->get('company');

        $query = $this->model->clone()
            ->with('company:id,name');

        if (!empty($selectedRole) && $selectedRole !== '-- Choose Role --') {
            $query->where('role', $selectedRole);
        }

        if (!empty($selectedCity) && $selectedCity !== '-- Choose City --') {
            $query->where('city', $selectedCity);
        }

        if (!empty($selectedCompany) && $selectedCompany !== '-- Choose Company --') {
            $query->whereHas('company', function ($q) use($selectedCompany){
                return $q->where('id', $selectedCompany);
            });
        }

        $data = $query->paginate()->withQueryString();

        /*$data = $this->model
            ->when($request->has('role'), function ($q) {
                return $q->where('role', request('role'));
            })
            ->when($request->has('city'), function ($q) {
                return $q->where('city', request('city'));
            })
            ->with('company:id,name')
            ->paginate();*/

        $roles = UserRoleEnum::asArray();

        $cities = $this->model->clone()
            ->distinct()
            ->pluck('city');

        $companies = Company::query()
            ->get([
                'id',
                'name'
            ]);

        return view("admin.$this->table.index", [
            'data' => $data,
            'roles' => $roles,
            'cities' => $cities,
            'companies' => $companies,
            'selectedRole' => $selectedRole,
            'selectedCity' => $selectedCity,
            'selectedCompany' => $selectedCompany,
        ]);
    }

    public function destroy($userId)
    {
        User::destroy($userId);
        return redirect()->back();
    }
}
