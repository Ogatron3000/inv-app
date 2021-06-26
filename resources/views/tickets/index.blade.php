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
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-ticket-alt mr-1"></i>
                            Tickets
                        </h3>

                        <div class="card-tools">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#add_ticket_modal">
                                        Add new ticket
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
                            <th>Type</th>
                            <th>Employee</th>
                            <th>Status</th>
                            <th>Officer</th>
                            <th>Approval Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            @can('view', $ticket)
                                <tr class="clickable-row" data-href="/tickets/{{ $ticket->id }}" >
                                    <td>{{ $ticket->type }}</td>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>{{ $ticket->status }}</td>
                                    <td>{{ $ticket->officer_name }}</td>
                                    <td>{{ $ticket->approval_date_formatted }}</td>
                                    <td>
                                        @can('update', $ticket)
                                            <a href="/tickets/{{ $ticket->id }}/edit"
                                               class="btn btn-primary btn-sm btn-flat">
                                                <i class="fa fa-edit"></i>
                                                EDIT
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('update', $ticket)
                                            <a id="delete_modal_button" class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete_modal" data-id="{{ $ticket->id }}">
                                                <i id="delete_modal_icon" class="fa fa-times"></i>
                                                DELETE
                                            </a>
                                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" id="delete_form_{{ $ticket->id }}">
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
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    @include('tickets.add_ticket_modal')
    @include('partials.delete_modal', ['modalTitle' => 'Delete Ticket'])

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/helpers/deleteModal.js') }}"></script>
    <script src="{{ asset('js/helpers/clickableRow.js') }}"></script>
@endsection
