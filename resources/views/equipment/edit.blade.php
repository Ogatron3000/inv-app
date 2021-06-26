@extends('layouts.main')

@section('page_title', 'Edit Equipment details')

@section('content-header')
    @include('partials.content-header', [
        'content_header' => "Edit Equipment Details",
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Equipment List', 'link' => '/equipment' ],
            [ 'name' => 'Edit Equipment Details', 'link' => '/equipment/' . $equipment->id . '/edit' ],
        ]
    ])
@endsection

@section('content')

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus mr-1"></i>
                        Edit Equipment details
                    </h3>

                </div><!-- /.card-header -->

                <div class="card-body table-responsive">

                    <form action="/equipment/{{ $equipment->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-6">
                                <label for="catogory_select">Equipment category:</label>
                                <select name="equipment_category_id" id="catogory_select" class="form-control @error('equipment_category_id') is-invalid @endif">
                                    <option value="">- select a category -</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $equipment->equipment_category_id ? 'selected' : '' }} >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('equipment_category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="position_select">Name:</label>
                                <input type="text" id="position_select" name="name" value="{{ $equipment->name }}" class="form-control @error('name') is-invalid @endif" placeholder="Enter a name" />
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <label for="description_txt">Description:</label>
                                <textarea name="description" id="description_txt" class="form-control" placeholder="Enter equipment description" rows="4">{{ $equipment->description }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 offset-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat mt-4">
                                    SAVE EQUIPMENT DETAILS
                                </button>
                            </div>
                        </div>

                    </form>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

@endsection

@section('additional_scripts')
@endsection
