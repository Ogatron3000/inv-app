@extends('layouts.main')

@section('page_title', 'Edit Ticket Details')

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Edit Ticket Details',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Ticket List', 'link' => '/tickets' ],
            [ 'name' => 'Edit Ticket Details', 'link' => '/tickets/' . $ticket->id . '/edit'],
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
                        Edit Ticket Details
                    </h3>

                </div><!-- /.card-header -->

                <div class="card-body table-responsive">

                    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        @if($ticket->isEquipmentTicket())
                            @include('tickets.equipment.edit')
                        @elseif($ticket->isOfficeSuppliesTicket())
                            @include('tickets.office_supplies.edit')
                        @elseif($ticket->isRepairTicket())
                            @include('tickets.repair.edit')
                        @endif

                        <div class="row">
                            <div class="col-4 offset-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat mt-4">
                                    UPDATE REQUEST
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
