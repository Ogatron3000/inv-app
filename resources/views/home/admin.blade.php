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
                        <i class="fas fa-laptop-code mr-1"></i>
                        Tickets by Status
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive">

                    @forelse($ticketGroups as $key => $group)
                        <div class="card card-default collapsed-card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    {{ $key }}
                                    <span class="text-gray">{{ '(' . $group->count() . ')' }}</span>
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
                                        <th>User</th>
                                        <th>Officer</th>
                                        <th>Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($group as $ticket)
                                        @can('view', $ticket)
                                            <tr class="clickable-row" data-href="{{ route('tickets.show', $ticket) }}" >
                                                <td>{{ $ticket->id }}</td>
                                                <td>{{ $ticket->user->name }}</td>
                                                <td>{{ $ticket->officer_name }}</td>
                                                <td>{{ $ticket->created_at }}</td>
                                            </tr>
                                        @endcan
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

