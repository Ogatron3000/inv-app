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
                        @if($ticket->ticketable->requestedEquipmentInStock())
                            <a href="{{ route('users.show', [$ticket->user_id, 'closeTicketId' => $ticket->id]) }}" class="btn btn-primary btn-sm btn-flat">
                                Approve
                            </a>
                        @elseif( ! $ticket->purchaseOrder)
                            <a href="{{ route('purchase-orders.create', $ticket) }}" class="btn btn-primary btn-sm btn-flat">
                                Submit PR
                            </a>
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
        @if($ticket->isOpen())
            @if($ticket->ticketable->requestedEquipmentInStock())
                <p class="text-success">Request equipment available in stock.</p>
            @else
                @if( ! $ticket->purchaseOrder)
                    <p class="text-warning">Requested item is not currently in stock. Please submit a purchase order. (PO)</p>
                @elseif($ticket->purchaseOrder->isApproved())
                    <p>
                        <a href="{{ route('purchase-orders.show', $ticket->purchaseOrder->id) }}">Purchase order</a> has been <span class="text-success">approved.</span>
                        <br>
                        <span class="text-dark">Do you want to <a href="{{ route('equipment.create') }}">add equipment?</a></span>
                    </p>
                @elseif($ticket->purchaseOrder->isRejected())
                    <p class="text-danger"><a href="{{ route('purchase-orders.show', $ticket->purchaseOrder->id) }}">Purchase order</a> has been denied.</p>
                @else
                    <p><a href="{{ route('purchase-orders.show', $ticket->purchaseOrder->id) }}">Purchase order</a> submitted.</p>
                @endif
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
            <td>{{ $ticket->ticketable->equipmentCategory->name }}</td>
            <td>{{ $ticket->approval_date_formatted }}</td>
        </tr>
        </tbody>
    </table>
{{-- continued in main file --}}
