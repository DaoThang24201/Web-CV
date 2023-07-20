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
                        <ul class="pagination pagination-rounded mt-3 mb-0 justify-content-center" id="pagination">

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
                url: '{{route('api.posts')}}',
                dataType: 'json',
                data: {page: {{ request()->get('page') ?? 1 }} },
                success: function (response) {
                    response.data.forEach(function (each) {

                        let location = (each.district && each.city) ? each.district + ' - ' + each.city : each.city
                        let remotable = each.remotable ? 'x' : ''
                        let is_partime = each.is_partime ? 'x' : ''
                        let range_salary = (each.min_salary && each.max_salary) ? each.min_salary + ' - ' + each.max_salary : ''
                        let range_date = (each.start_date && each.end_date) ? each.start_date + ' - ' + each.end_date : ''
                        let is_pinned = each.is_pinned ? 'x' : ''
                        let u = new Date(each.created_at)
                        let created_at = convertTime(each.created_at)


                        $('#table-data').append($('<tr>')
                            .append($('<td>').append(each.id))
                            .append($('<td>').append(each.job_title))
                            .append($('<td>').append(location))
                            .append($('<td>').append(remotable))
                            .append($('<td>').append(is_partime))
                            .append($('<td>').append(range_salary))
                            .append($('<td>').append(range_date))
                            .append($('<td>').append(each.status_name))
                            .append($('<td>').append(is_pinned))
                            .append($('<td>').append(created_at))
                        )
                    })
                    renderPagination(response.pagination)
                },
                error: (function(response) {

                }),
            })

            $(document).on('click', '#pagination li a', function (event) {
                event.preventDefault();
                let page = $(this).text();
                let urlParams = new URLSearchParams(window.location.search);
                urlParams.set('page', page);
                window.location.search = urlParams;
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
