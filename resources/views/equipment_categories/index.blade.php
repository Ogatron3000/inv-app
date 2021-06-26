@extends('layouts.main')

@section('page_title', 'Equipment Category List')

@section('additional_styles')
@endsection

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Equipment Category List',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Equipment Category List', 'link' => '/equipment-categories' ],
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
                            Equipment Category
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills">
                                <li class="nav-item ml-2">
                                    <a class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#new_equipment_category_modal">
                                        Add new equipment category
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
                            <th>FAQ</th>
                            @can('manage', \App\Models\EquipmentCategory::class)
                            <th>Edit</th>
                            <th>Delete</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($equipmentCategories as $category)
                            <tr class="clickable-row" data-href="{{ route('equipment-categories.show', $category) }}" >
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td><a href="{{ route('equipment-categories.show', $category) }}">FAQ</a></td>
                                @can('manage', \App\Models\EquipmentCategory::class)
                                <td>
                                    <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#edit_equipment_category_modal" data-id="{{ $category->id }}" data-equipment-category="{{ $category->name }}">
                                        <i class="fa fa-edit"></i>
                                        EDIT
                                    </button>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete_modal" data-id="{{ $category->id }}">
                                        <i class="fa fa-times"></i>
                                        DELETE
                                    </a>
                                    <form action="{{ route('equipment-categories.destroy', $category) }}" method="POST" id="delete_form_{{ $category->id }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

    @include('equipment_categories.new_equipment_category_modal')
    @include('equipment_categories.edit_equipment_category_modal')
    @include('partials.delete_modal', ['modalTitle' => 'Delete Equipment Category'])

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/helpers/deleteModal.js') }}"></script>
    <script>
        $('#edit_equipment_category_modal').on('show.bs.modal', function(e) {
            let button = $(e.relatedTarget),
                modal = $(this),
                equipmentCategoryId = button.data('id'),
                equipmentCategory = button.data("equipment-category");

            modal.find("#edit_equipment_category_form").attr("action", `/equipment-categories/${equipmentCategoryId}`);
            modal.find("#edit_equipment_category_input").val(equipmentCategory);
        });
    </script>
@endsection
