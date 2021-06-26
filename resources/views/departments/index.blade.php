@extends('layouts.main')

@section('page_title', 'Department List')

@section('additional_styles')
@endsection

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Department List',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Department List', 'link' => '/departments' ],
        ]
    ])
@endsection

@section('content')

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-laptop-code mr-1"></i>
                            Department
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills">
                                <li class="nav-item ml-2">
                                    <a class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#new_department_modal">
                                        Add new department
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive">

                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($departments as $department)
                            <tr data-href="{{ route('departments.show', $department) }}" >
                                <td>{{ $department->id }}</td>
                                <td>{{ $department->name }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#edit_department_modal" data-id="{{ $department->id }}" data-department="{{ $department->name }}">
                                        <i class="fa fa-edit"></i>
                                        EDIT
                                    </button>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete_modal" data-id="{{ $department->id }}">
                                        <i class="fa fa-times"></i>
                                        DELETE
                                    </a>
                                    <form action="{{ route('departments.destroy', $department) }}" method="POST" id="delete_form_{{ $department->id }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

    @include('departments.new_department_modal')
    @include('departments.edit_department_modal')
    @include('partials.delete_modal', ['modalTitle' => 'Delete Department'])

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/helpers/deleteModal.js') }}"></script>
    <script>
        $('#edit_department_modal').on('show.bs.modal', function(e) {
            let button = $(e.relatedTarget),
                modal = $(this),
                departmentId = button.data('id'),
                department = button.data("department");

            modal.find("#edit_department_form").attr("action", `/departments/${departmentId}`);
            modal.find("#edit_department_input").val(department);
        });
    </script>
@endsection
