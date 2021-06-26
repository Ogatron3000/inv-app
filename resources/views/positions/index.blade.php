@extends('layouts.main')

@section('page_title', 'Position List')

@section('additional_styles')
@endsection

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Position List',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Position List', 'link' => '/positions' ],
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
                            Position
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills">
                                <li class="nav-item ml-2">
                                    <a class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#new_position_modal">
                                        Add new position
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
                            <th>Department</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($positions as $position)
                            <tr data-href="{{ route('positions.show', $position) }}" >
                                <td>{{ $position->id }}</td>
                                <td>{{ $position->name }}</td>
                                <td>{{ $position->department->name }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#edit_position_modal" data-id="{{ $position->id }}" data-position="{{ $position->name }}">
                                        <i class="fa fa-edit"></i>
                                        EDIT
                                    </button>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete_modal" data-id="{{ $position->id }}">
                                        <i class="fa fa-times"></i>
                                        DELETE
                                    </a>
                                    <form action="{{ route('positions.destroy', $position) }}" method="POST" id="delete_form_{{ $position->id }}">
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

    @include('positions.new_position_modal')
    @include('positions.edit_position_modal')
    @include('partials.delete_modal', ['modalTitle' => 'Delete Position'])

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/helpers/deleteModal.js') }}"></script>
    <script>
        $('#edit_position_modal').on('show.bs.modal', function(e) {
            let button = $(e.relatedTarget),
                modal = $(this),
                positionId = button.data('id'),
                position = button.data("position");

            modal.find("#edit_position_form").attr("action", `/positions/${positionId}`);
            modal.find("#edit_position_input").val(position);
        });
    </script>
@endsection
