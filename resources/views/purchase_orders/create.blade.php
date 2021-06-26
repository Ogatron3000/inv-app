@extends('layouts.main')

@section('page_title', 'Add New Purchase Order')

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'New Purchase Order',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Ticket Details', 'link' => '/tickets/' . $ticket->id],
            [ 'name' => 'New Purchase Order', 'link' => '/tickets/' . $ticket->id . '/purchase-orders/create'],
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
                        New Purchase Order
                    </h3>

                </div><!-- /.card-header -->

                <div class="card-body table-responsive">
                    <h5>
                        <a href="{{ route('tickets.show', $ticket->id) }}">
                            Ticket
                        </a>
                    </h5>
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Officer</th>
                            @if($ticket->isEquipmentTicket())
                                <th>Equipment</th>
                            @elseif($ticket->isOfficeSuppliesTicket())
                                <th>Office Item</th>
                                <th>Quantity</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $ticket->type }}</td>
                            <td>{{ $ticket->status }}</td>
                            <td>{{ $ticket->officer->name }}</td>
                            @if($ticket->isEquipmentTicket())
                                <td>{{ $ticket->ticketable->equipmentCategory->name }}</td>
                            @elseif($ticket->isOfficeSuppliesTicket())
                                <td>{{ $ticket->ticketable->office_item }}</td>
                                <td>{{ $ticket->ticketable->quantity }}</td>
                            @endif
                        </tr>
                        </tbody>
                    </table>

                    <hr class="my-5">

                    <div>
                        <form action="{{ route('purchase-orders.store', $ticket) }}" method="POST">
                            @csrf

                            <div class="row" id="office_supplies_inputs">
                                <div class="col-6">
                                    <label for="delivery_deadline">Delivery Deadline:</label>
                                    <input id="delivery_deadline" type="date" name="purchase_order[delivery_deadline]" class="form-control  @error('purchase_order.delivery_deadline') is-invalid @endif" value="{{ old('purchase_order.delivery_deadline') }}">
                                    @error('purchase_order.delivery_deadline')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="price">Price:</label>
                                    <input id="price" type="number" step="1" min="0" name="purchase_order[price]" class="form-control  @error('purchase_order.price') is-invalid @endif" value="{{ old('purchase_order.price') }}" placeholder="Enter price">
                                    @error('purchase_order.price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <label for="comment">Comment:</label>
                                    <textarea name="comment[content]" id="comment" class="form-control @error('comment.content') is-invalid @endif" placeholder="Enter comment" rows="4">{{ old('comment.content') }}</textarea>
                                    @error('comment.content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 offset-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat mt-4">
                                        SUBMIT REQUEST
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
