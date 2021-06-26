@extends('layouts.main')

@section('page_title', 'Equipment list')

@section('additional_styles')
    <style>
        .clickable-row{ cursor: pointer; }
    </style>
@endsection

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Equipment List',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Equipment List', 'link' => '/equipment' ],
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
                            Equipment
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="btn btn-sm btn-flat btn-primary" href="{{ route('export.equipment') }}">Export</a>
                                </li>
                                <li class="nav-item ml-2">
                                    <a class="btn btn-sm btn-flat btn-primary" href="/equipment/create">Add new equipment</a>
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
                            <th>Category</th>
                            <th>Name</th>
                            <th>Qty. available</th>
                            <th>Description</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($equipment as $e)
                            <tr class="clickable-row" data-href="/equipment/{{ $e->id }}" >
                                <td>{{ $e->id }}</td>
                                <td>
                                    {{ $e->category->name }}
                                </td>
                                <td>{{ $e->name }}</td>
                                <td>{{ $e->available_quantity }}</td>
                                <td>{{ $e->short_description }}</td>
                                <td>
                                    <a href="/equipment/{{ $e->id }}/edit" class="btn btn-primary btn-sm btn-flat">
                                        <i class="fa fa-edit"></i>
                                        EDIT
                                    </a>
                                </td>
                                <td>
                                    <a id="delete_modal_button" class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete_modal" data-id="{{ $e->id }}">
                                        <i id="delete_modal_icon" class="fa fa-times"></i>
                                        DELETE
                                    </a>
                                    <form action="/equipment/{{ $e->id }}" method="POST" id="delete_form_{{ $e->id }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="d-flex justify-content-end mb-0">
                        {{ $equipment->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    @include('partials.delete_modal', ['modalTitle' => 'Delete Equipment'])

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/helpers/deleteModal.js') }}"></script>
    <script src="{{ asset('js/helpers/clickableRow.js') }}"></script>
@endsection
