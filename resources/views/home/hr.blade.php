@extends('layouts.main')
@section('page_title', 'Dashboard')

@section('additional_styles')
    <style>
        .clickable-row{ cursor: pointer; }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">

            @include('partials.unread_notifications')

            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-money-check mr-1"></i>
                        Purchase Orders by Status
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive">

                    @forelse($purchaseOrderGroups as $key => $group)
                        <div class="card card-default collapsed-card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    {{ $key }}
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Officer</th>
                                        <th>HR Officer</th>
                                        <th>Delivery Deadline</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($group as $purchaseOrder)
                                        <tr class="clickable-row" data-href="{{ route('purchase-orders.show', $purchaseOrder) }}" >
                                            <td>{{ $purchaseOrder->id }}</td>
                                            <td>{{ $purchaseOrder->officer_name }}</td>
                                            <td>{{ $purchaseOrder->hr_officer_name }}</td>
                                            <td>{{ $purchaseOrder->delivery_deadline_formatted }}</td>
                                            <td>{{ $purchaseOrder->price }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex justify-content-center">
                            No tickets yet.
                        </div>
                    @endforelse

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/home/markNotifications.js') }}"></script>
    <script src="{{ asset('js/helpers/clickableRow.js') }}"></script>
@endsection

