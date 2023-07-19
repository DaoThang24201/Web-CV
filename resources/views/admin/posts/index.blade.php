@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-2">
            <div class="page-title-box">
                <h4 class="page-title">{{$title ?? ''}}</h4>
            </div>
        </div>
       {{-- <div class="col-10">
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
        </div>--}}
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.posts.create')}}" class="btn btn-primary">
                        Create
                    </a>
                    <label for="csv" class="btn btn-primary mb-0 ml-3">
                        Import CSV
                    </label>
                    <input type="file" name="csv" id="csv" class="d-none" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
                </div>
                <div class="card-body">
                    <table class="table table-striped table-centered mb-0" id="table-data">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Title</th>
                            <th>Location</th>
                            <th>Remotable</th>
                            <th>Is Part-Time</th>
                            <th>Range Salary</th>
                            <th>Date Range</th>
                            <th>Status</th>
                            <th>Is Pinned</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination pagination-rounded mb-0 justify-content-center">
                            {{--{{$data->links()}}--}}
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
            $.ajax({
                url: '{{route('api.posts.index')}}',
                dataType: 'json',
                data: {param1: 'value1'},
            })

            $('#csv').change(function (event) {
                let formData = new FormData();
                formData.append('file', $(this)[0].files[0]);
                $.ajax({
                    url: '{{route('admin.posts.import_csv')}}',
                    type: 'POST',
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    success: function (response) {
                        $.toast({
                            heading: 'Import Success',
                            text: 'Your data have been imported.',
                            showHideTransition: 'slide',
                            position: 'top-center',
                            icon: 'success',
                        })
                    },
                    error: (function(response) {

                    }),
                })
            })
        });
    </script>
@endpush
