@extends('layouts.main')

@section('page_title', 'Document details')

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Ticket Details',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Ticket list', 'link' => '/tickets' ],
            [ 'name' => 'Ticket details', 'link' => '/tickets/' . $ticket->id ],
        ]
    ])
@endsection

@section('content')

    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-ticket-alt mr-1"></i>
                            Ticket Details
                        </h3>

                        @if($ticket->isEquipmentTicket())
                            @include('tickets.equipment.show')
                        @elseif($ticket->isOfficeSuppliesTicket())
                            @include('tickets.office_supplies.show')
                        @elseif($ticket->isRepairTicket())
                            @include('tickets.repair.show')
                        @endif

                    <hr class="mt-5">

                    <div class="row">
                        <div class="col-6">
                            @include('partials.comments', ['commentable' => $ticket])
                        </div>

                        <div class="col-6">
                            @include('partials.activities', ['activities' => $ticket->activities])
                        </div>
                    </div>

                </div><!-- /.card-body -->
            </div><!-- /.card -->

        </div>
    </div>

    @include('tickets.reject_ticket_modal')
    @include('tickets.repair.estimate_finish_date_modal')

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/documents/serial_numbers.js') }}"></script>
@endsection

