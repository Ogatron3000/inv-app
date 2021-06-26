<div class="row mt-4">
    <div class="col-12 table-responsive">
        <h5 class="my-3">
            Employee Equipment
            @can('manage', \App\Models\UserEquipment::class)
                <button type="button"
                        class="btn btn-sm btn-flat btn-primary float-right"
                        data-toggle="modal"
                        data-target="#new_item_modal"
                        id="new_item_modal_button"
                >
                    Assign Equipment
                </button>
            @endcan
        </h5>

        <table class="table table-sm table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Equipment</th>
                <th>Serial No.</th>
                <th>Admin</th>
                <th>Date</th>
                <th>Returned</th>
                <th>Return date</th>
                @can('manage', \App\Models\UserEquipment::class)
                <th>Return</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($userEquipment as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->equipment->full_name }}</td>
                    <td>{{ $item->serial_no }}</td>
                    <td>{{ $item->admin_name }}</td>
                    <td>{{ $item->start_date }}</td>
                    <td>
                        @if($item->returned)
                            <i class="fa fa-check-circle"></i>
                        @else
                            <i class="fa fa-times-circle"></i>
                        @endif
                    </td>
                    <td>{{ $item->returned_date_formated }}</td>
                    @can('manage', \App\Models\UserEquipment::class)
                    <td>
                        @if(!$item->returned)
                            <form action="/user-equipment/return/{{ $item->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning btn-flat btn-sm">
                                    Return equipment
                                </button>
                            </form>
                        @endif
                    </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end mb-0">
            {{ $userEquipment->links() }}
        </div>
    </div>
</div>
