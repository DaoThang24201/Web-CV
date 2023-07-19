@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-2">
            <div class="page-title-box">
                <h4 class="page-title">{{$title ?? ''}}</h4>
            </div>
        </div>
        <div class="col-10">
            <form action="" id="form-filter" class="form-inline">
                <div class="col-2 mt-3">
                    <div class="form-group">
                        <select id="role" name="role" class="form-control select-filter">
                            <option selected>-- Choose Role --</option>
                            @foreach($roles as $role => $value)
                                <option value="{{$value}}" @if((string)$value === $selectedRole) selected @endif>
                                    {{$role}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-2 mt-3">
                    <div class="form-group">
                        <select id="city" name="city" class="form-control select-filter">
                            <option selected>-- Choose City --</option>
                            @foreach($cities as $city)
                                <option @if($city === $selectedCity) selected @endif>
                                    {{$city}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-2 mt-3">
                    <div class="form-group">
                        <select id="company" name="company" class="form-control select-filter">
                            <option selected>-- Choose Company --</option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}" @if($company->id == $selectedCompany) selected @endif>
                                    {{$company->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Information</th>
                                <th>Role</th>
                                <th>Position</th>
                                <th>City</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $each)
                            <tr>
                                <td>{{$each->id}}</td>
                                <td class="table-user">
                                    <a href="{{route("admin.$table.show", $each)}}">
                                        <img src="{{$each->avatar}}" class="mr-2 rounded-circle"/>
                                        {{$each->name}}
                                    </a> - {{$each->getGenderName()}}
                                </td>
                                <td>
                                    <a href="mailto:{{$each->email}}">
                                        {{$each->email}}
                                    </a>
                                    <br>
                                    <a href="tel:{{$each->phone}}">
                                        {{$each->phone}}
                                    </a>
                                </td>
                                <td>
                                    {{$each->getRoleName()}}
                                </td>
                                <td>
                                    {{$each->position}}
                                </td>
                                <td>
                                    {{$each->city}}
                                </td>
                                <td>
                                    {{optional($each->company)->name}}
                                </td>
                                <td class="table-action">
                                    <form action="#" method="post" class="form-group">
                                        @csrf
                                        <button class="btn btn-info">
                                            <i class="mdi mdi-pencil btn-info"></i>
                                        </button>
                                    </form>
                                    <form action="{{route("admin.$table.destroy", $each)}}" method="post"  class="form-group">
                                        @csrf
                                        <button class="btn btn-danger">
                                            <i class="mdi mdi-delete btn-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination pagination-rounded mb-0 justify-content-center">
                            {{$data->links()}}
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.select-filter').change(function () {
                $('#form-filter').submit()
            })
        })
    </script>
@endpush
