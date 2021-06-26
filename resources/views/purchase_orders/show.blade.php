@extends('layouts.main')

@section('page_title', 'Purchase Order Details')

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Purchase Order Details',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Purchase Order List', 'link' => route('purchase-orders.index') ],
            [ 'name' => 'Purchase Order Details', 'link' => route('purchase-orders.show', $purchaseOrder) ],
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
                            <i class="fas fa-ticket-alt mr-1"></i>
                            Purchase Order Details
                        </h3>

                        @if($purchaseOrder->isOpen())
                            @can('manage', $purchaseOrder)
                                <div class="card-tools">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <form action="{{ route('purchase-orders.approve', $purchaseOrder->id) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal">
                                                    Approve
                                                </button>
                                            </form>
                                        </li>
                                        <li class="nav-item ml-2">
                                            <a class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#reject_purchase_order_modal">
                                                Reject
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endcan
                        @endif

                    </div>
                </div><!-- /.card-header -->

                <div class="card-body table-responsive">

                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Officer</th>
                            <th>HR Officer</th>
                            <th>Delivery Deadline</th>
                            <th>Price</th>
                            <th>Approved</th>
                            @can('view', $purchaseOrder->ticket)
                            <th>Ticket</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $purchaseOrder->officer_name }}</td>
                            <td>{{ $purchaseOrder->hr_officer_name }}</td>
                            <td>{{ $purchaseOrder->delivery_deadline_formatted }}</td>
                            <td>{{ $purchaseOrder->price }}</td>
                            <td>{{ $purchaseOrder->is_approved }}</td>
                            @can('view', $purchaseOrder->ticket)
                            <td><a href="{{ route('tickets.show', $purchaseOrder->ticket_id) }}">Go to ticket</a></td>
                            @endcan
                        </tr>
                        </tbody>
                    </table>

                    <hr class="mt-5">

                    <div class="row">
                        <div class="col-6">
                            @include('partials.comments', ['commentable' => $purchaseOrder])
                        </div>

                        <div class="col-6">
                            @include('partials.activities', ['activities' => $purchaseOrder->activities])
                        </div>
                    </div>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

    @include('purchase_orders.reject_purchase_order_modal')

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/documents/serial_numbers.js') }}"></script>
@endsection

