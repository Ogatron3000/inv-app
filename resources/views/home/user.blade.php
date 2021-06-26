@extends('layouts.main')
@section('page_title', 'Dashboard')

@section('additional_styles')
@endsection

@section('content')

    <div class="row">
        <div class="col-12">

            @include('partials.unread_notifications')

            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user mr-1"></i>
                        Equipment File
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
                </div><!-- /.card-header -->

                <div class="card-body table-responsive">

                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->department_name }}</td>
                            <td>{{ $user->position_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="row mt-4">
                        <div class="col-12 table-responsive">
                            <h5 class="my-3">
                                Equipment
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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items = $user->items()->paginate(10) as $key => $item)
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
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mb-0">
                                {{ $items->links() }}
                            </div>
                        </div>
                    </div>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

    @include('tickets.add_ticket_modal')

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/home/markNotifications.js') }}"></script>
@endsection

