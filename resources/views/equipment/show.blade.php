@extends('layouts.main')

@section('page_title', 'Equipment details')

@section('content-header')
    @include('partials.content-header', [
        'content_header' => "Equipment details",
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Equipment List', 'link' => '/equipment' ],
            [ 'name' => 'Equipment Details', 'link' => '/equipment/' . $equipment->id ],
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
                            Equipment details
                        </h3>

                        <div class="card-tools">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#create_serial_number_modal">
                                        Add Serial Number
                                    </button>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div><!-- /.card-header -->

                <div class="card-body table-responsive">

                    <div class="row">
                        <div class="col-5 table-responsive">
                            <table class="table table-striped table-sm">
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $equipment->id }}</td>
                                </tr>
                                <tr>
                                    <td>Category:</td>
                                    <td>{{ $equipment->category->name }}</td>
                                </tr>
                                <tr>
                                    <td>Name:</td>
                                    <td>{{ $equipment->name }}</td>
                                </tr>
                                <tr>
                                    <td>Available quantity:</td>
                                    <td>{{ $equipment->available_quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td>{{ $equipment->description }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-7">
                            <table class="table table-hover table-sm table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Serial No.</th>
                                    <th>Controls</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($equipment->serialNumbers as $key => $sn)
                                    <tr style="@if($sn->is_used) text-decoration: line-through; @endif" >
                                        <td class="align-middle">{{ $key + 1 }}</td>
                                        <td class="align-middle">{{ $sn->serial_number }}</td>
                                        <td class="d-flex">
                                            <button class="btn btn-link text-dark d-block" data-toggle="modal" data-target="#edit_serial_number_modal" data-id="{{ $sn->id }}" data-serial-number="{{ $sn->serial_number }}">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            @if( ! $sn->is_used)
                                                <a id="delete_modal_button" class="btn btn-link text-dark d-block" data-toggle="modal" data-target="#delete_modal" data-id="{{ $sn->id }}">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                                <form action="{{ route('serial_numbers.destroy', [$equipment, $sn]) }}" method="POST" id="delete_form_{{ $sn->id }}">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="w-25 align-middle">{{ count($equipment->serialNumbers) + 1 }}</td>
                                    <form action="{{ route('serial_numbers.store', $equipment->id) }}" method="POST">
                                        @csrf
                                        <td>
                                            <div class="d-flex">
                                                <input type="text" id="serial_number" name="serial_number" class="form-control form-control-sm w-50 rounded-0  @error('serial_number') is-invalid @enderror" oninput="handleChange()" placeholder="Serial Number">
                                            </div>

                                            @error('serial_number')
                                            <span class="text-danger text-sm d-inline">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </td>
                                        <td><button id="serial_number_button" class="btn btn-sm btn-flat btn-primary ml-2" disabled>Add</button></td>
                                    </form>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

    @include('equipment.create_serial_number_modal')
    @include('equipment.edit_serial_number_modal')
    @include('partials.delete_modal', ['modalTitle' => 'Delete Serial Number'])

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/helpers/deleteModal.js') }}"></script>
    <script>
        const serialNumber = $('#serial_number');
        const serialNumberButton = $('#serial_number_button');

        function handleChange() {
            if ( ! serialNumber.val()) {
                serialNumberButton.attr('disabled', true);
            } else {
                serialNumberButton.attr('disabled', false);
            }
        }

        $('#edit_serial_number_modal').on('show.bs.modal', function(e) {
            let button = $(e.relatedTarget),
                modal = $(this),
                serialNumberId = button.data('id'),
                serialNumber = button.data("serial-number"),
                equipmentId = {{ $equipment->id }};

            modal.find("#edit_serial_number_form").attr("action", `/equipment/${equipmentId}/serial-numbers/${serialNumberId}`);
            modal.find("#edit_serial_number_input").val(serialNumber);
        });
    </script>
@endsection
