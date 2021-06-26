@extends('layouts.main')

@section('page_title', 'Role List')

@section('additional_styles')
@endsection

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Role List',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Role List', 'link' => '/roles' ],
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
                            Role
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills">
                                <li class="nav-item ml-2">
                                    <a class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#new_role_modal">
                                        Add new role
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
                        @foreach($roles as $role)
                            <tr data-href="{{ route('roles.show', $role) }}" >
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#edit_role_modal" data-id="{{ $role->id }}" data-role="{{ $role->name }}">
                                        <i class="fa fa-edit"></i>
                                        EDIT
                                    </button>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete_modal" data-id="{{ $role->id }}">
                                        <i class="fa fa-times"></i>
                                        DELETE
                                    </a>
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" id="delete_form_{{ $role->id }}">
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

    @include('roles.new_role_modal')
    @include('roles.edit_role_modal')
    @include('partials.delete_modal', ['modalTitle' => 'Delete Role'])

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/helpers/deleteModal.js') }}"></script>
    <script>
        $('#edit_role_modal').on('show.bs.modal', function(e) {
            let button = $(e.relatedTarget),
                modal = $(this),
                roleId = button.data('id'),
                role = button.data("role");

            modal.find("#edit_role_form").attr("action", `/roles/${roleId}`);
            modal.find("#edit_role_input").val(role);
        });
    </script>
@endsection
