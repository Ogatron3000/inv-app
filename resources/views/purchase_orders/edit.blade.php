@extends('layouts.main')

@section('page_title', 'Edit Purchase Order')

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Ticket Details',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Purchase Order List', 'link' => '/purchase-orders' ],
            [ 'name' => 'Edit Purchase Order', 'link' => '/purchase-orders/' . $purchaseOrder->id . '/edit'],
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
                        Edit Purchase Order
                    </h3>

                </div><!-- /.card-header -->

                <div class="card-body table-responsive">

                    <div>
                        <form action="{{ route('purchase-orders.update', $purchaseOrder) }}" method="POST">
                            @method('PUT')
                            @csrf

                            @if(isset($purchaseOrder->ticket->ticketable->equipmentCategory) && $purchaseOrder->ticket->ticketable->equipmentInStock)
                                <div class="row" id="office_supplies_inputs">
                                    <div class="col-6">
                                        <label for="delivery_deadline">Delivery Deadline:</label>
                                        <input id="delivery_deadline" type="date" name="delivery_deadline" class="form-control  @error('delivery_deadline') is-invalid @endif" value="{{ old('delivery_deadline') }}">
                                        @error('delivery_deadline')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="price">Price:</label>
                                        <input id="price" type="number" step="1" min="0" name="price" class="form-control  @error('price') is-invalid @endif" value="{{ old('price') }}" placeholder="Enter price">
                                        @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-4">
                                <div class="col-12">
                                    <label for="description">Description:</label>
                                    <textarea name="description" id="description" class="form-control" placeholder="Enter description" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 offset-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat mt-4">
                                        UPDATE
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

@endsection

@section('additional_scripts')
@endsection
