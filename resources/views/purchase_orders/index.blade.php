@extends('layouts.main')

@section('page_title', 'Tickets list')

@section('additional_styles')
    <style>
        .clickable-row{ cursor: pointer; }
    </style>
@endsection

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Ticket List',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Ticket list', 'link' => '/tickets' ],
        ]
    ])
@endsection

@section('content')

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-ticket-alt mr-1"></i>
                        Purchase Orders
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive">

                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Officer</th>
                            <th>HR Officer</th>
                            <th>Delivery Deadline</th>
                            <th>Price</th>
                            <th>Approved</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchaseOrders as $order)
                            @can('view', $order)
                                <tr class="clickable-row" data-href="{{ route('purchase-orders.show', $order->id) }}" >
                                    <td>{{ $order->officer_name }}</td>
                                    <td>{{ $order->hr_officer_name }}</td>
                                    <td>{{ $order->delivery_deadline_formatted }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->is_approved }}</td>
                                    <td>
                                        @can('update', $order)
                                            <a href="/tickets/{{ $order->id }}/edit" class="btn btn-primary btn-sm btn-flat">
                                                <i class="fa fa-edit"></i>
                                                EDIT
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('update', $order)
                                            <a id="delete_modal_button" class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete_modal" data-id="{{ $order->id }}">
                                                <i id="delete_modal_icon" class="fa fa-times"></i>
                                                DELETE
                                            </a>
                                            <form action="{{ route('purchase-orders.destroy', $order) }}" method="POST" id="delete_form_{{ $order->id }}">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endcan
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="d-flex justify-content-end mb-0">
                        {{ $purchaseOrders->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    @include('partials.delete_modal', ['modalTitle' => 'Delete Purchase Order'])

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/helpers/deleteModal.js') }}"></script>
    <script src="{{ asset('js/helpers/clickableRow.js') }}"></script>
@endsection
