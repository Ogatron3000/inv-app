<div class="card-tools">
    <ul class="nav nav-pills">
        @if($ticket->isOpen())
            @if( ! $ticket->hasOfficer())
                @can('manage', $ticket)
                    <li class="nav-item">
                        <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#estimate_finish_date_modal">
                            Manage
                        </button>
                    </li>
                @endcan
            @else
                @can('control', $ticket)
                    <li class="nav-item">
                        <form action="{{ route('tickets.release', $ticket->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary btn-sm btn-flat">
                                Release
                            </button>
                        </form>
                    </li>
                    <li class="nav-item ml-2">
                        <form action="{{ route('tickets.approve', $ticket) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary btn-sm btn-flat">
                                Finish
                            </button>
                        </form>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#reject_ticket_modal">
                            Close
                        </a>
                    </li>
                @endcan
            @endif
        @endif
    </ul>
</div>

{{-- closing divs from main file --}}
    </div>
</div><!-- /.card-header -->

<div class="card-body table-responsive">
    <table class="table table-sm">
        <thead>
        <tr>
            <th>Type</th>
            <th>Employee</th>
            <th>Status</th>
            <th>Officer</th>
            <th>Equipment</th>
            <th>Approval Date</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $ticket->type }}</td>
            <td>{{ $ticket->user->name }}</td>
            <td>{{ $ticket->status }}</td>
            <td>{{ $ticket->officer_name }}</td>
            <td>{{ $ticket->ticketable->equipment->name }}</td>
            <td>{{ $ticket->approval_date_formatted }}</td>
        </tr>
        </tbody>
    </table>
{{-- continued in main file --}}
