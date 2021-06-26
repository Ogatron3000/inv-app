@extends('layouts.main')

@section('page_title', 'Employees List')

@section('additional_styles')
    <style>
        .clickable-row{ cursor: pointer; }
    </style>
@endsection

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Employees List',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Employees List', 'link' => '/users' ],
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
                            <i class="fas fa-users mr-1"></i>
                            Employees
                        </h3>
                        @can('manage', \App\Models\User::class)
                            <div class="card-tools">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#export_choice_modal">
                                            Export
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn btn-sm btn-flat btn-primary ml-2" href="/users/create">Add new employee</a>
                                    </li>
                                </ul>
                            </div>
                        @endcan
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive">

                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            @can('manage', \App\Models\User::class)
                            <th>Edit</th>
                            <th>Delete</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="clickable-row" data-href="/users/{{ $user->id }}" >
                                <td>{{ $user->id }}</td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>{{ $user->email }}</td>
                                @can('manage', \App\Models\User::class)
                                <td>
                                    <a href="/users/{{ $user->id }}/edit" class="btn btn-primary btn-sm btn-flat">
                                        <i class="fa fa-edit"></i>
                                        EDIT
                                    </a>
                                </td>
                                <td>
                                    <a id="delete_modal_button" class="btn btn-danger btn-sm btn-flat @if($user->id == auth()->id()) disabled @endif" data-toggle="modal" data-target="#delete_modal" data-id="{{ $user->id }}">
                                        <i id="delete_modal_icon" class="fa fa-times"></i>
                                        DELETE
                                    </a>
                                    <form action="/users/{{ $user->id }}" method="POST" id="delete_form_{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.card-body -->

                <div class="card-footer">
                    <div class="d-flex justify-content-end mb-0">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    @include('partials.delete_modal', ['modalTitle' => 'Delete Ticket'])
    @include('users.export.export_choice_modal')
    @include('users.export.export_group_modal')
    @include('users.export.export_custom_modal')

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/vendor/typeahead.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/helpers/deleteModal.js') }}"></script>
    <script src="{{ asset('js/helpers/clickableRow.js') }}"></script>
    <script>
        $('.livesearch').select2({
            placeholder: 'Select user',
            ajax: {
                url: '{{ route('users.autocomplete') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endsection
