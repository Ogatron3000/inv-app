<div class="card-tools">
    <ul class="nav nav-pills">
        @if($ticket->isOpen())
            @if( ! $ticket->hasOfficer())
                @can('manage', $ticket)
                    <li class="nav-item">
                        <form action="{{ route('tickets.manage', $ticket->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary btn-sm btn-flat">
                                Manage
                            </button>
                        </form>
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
                        @if( ! $ticket->purchaseOrder)
                            <a href="{{ route('purchase-orders.create', $ticket) }}" class="btn btn-primary btn-sm btn-flat">
                                Submit PR
                            </a>
                        @elseif($ticket->purchaseOrder->isApproved())
                            <form action="{{ route('tickets.approve', $ticket) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-primary btn-sm btn-flat">
                                    Approve
                                </button>
                            </form>
                        @endif
                    </li>
                    <li class="nav-item ml-2">
                        <a class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#reject_ticket_modal">
                            Reject
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

    @can('control', $ticket)
        @if($ticket->isOpen() && $ticket->purchaseOrder)
            @if($ticket->purchaseOrder->isOpen())
                <p><a href="{{ route('purchase-orders.show', $ticket->purchaseOrder->id) }}">Purchase order</a> submitted.</p>
            @elseif($ticket->purchaseOrder->isApproved())
                <p><a href="{{ route('purchase-orders.show', $ticket->purchaseOrder->id) }}">Purchase order</a> has been <span class="text-success">approved.</span> You can now approve the ticket.</p>
            @elseif($ticket->purchaseOrder->isRejected())
                <p class="text-danger"><a href="{{ route('purchase-orders.show', $ticket->purchaseOrder->id) }}">Purchase order</a> has been denied.</p>
            @endif
        @endif
    @endcan

    <table class="table table-sm">
        <thead>
        <tr>
            <th>Type</th>
            <th>Employee</th>
            <th>Status</th>
            <th>Officer</th>
            <th>Office Item</th>
            <th>Quantity</th>
            <th>Approval Date</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $ticket->type }}</td>
            <td>{{ $ticket->user->name }}</td>
            <td>{{ $ticket->status }}</td>
            <td>{{ $ticket->officer_name }}</td>
            <td>{{ $ticket->ticketable->office_item }}</td>
            <td>{{ $ticket->ticketable->quantity }}</td>
            <td>{{ $ticket->approval_date_formatted }}</td>
        </tr>
        </tbody>
    </table>
{{-- continued in main file --}}
