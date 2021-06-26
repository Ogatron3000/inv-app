@extends('layouts.main')

@section('page_title', 'Document details')

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Employees Details',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Employees List', 'link' => '/users' ],
            [ 'name' => 'Employee Details', 'link' => '/users/'.$user->id ],
        ]
    ])
@endsection

@section('content')

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user mr-1"></i>
                        Employee Equipment File
                    </h3>
                    @can('manage', \App\Models\User::class)
                        <div class="card-tools">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <form action="{{ route('export.user_equipment') }}" method="POST">
                                        @csrf
                                        <input type="text" name="userIds[]" hidden value="{{ $user->id }}">
                                        <button class="btn btn-sm btn-flat btn-primary">
                                            Export
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endcan
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
                            <td>{{ $user->role_name }}</td>
                        </tr>
                        </tbody>
                    </table>

                    @include('users.items_table')

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

    @include('users.new_item_modal')

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/documents/serial_numbers.js') }}"></script>
    <script>
        $(document).ready(function(){
            const urlSearchParams = new URLSearchParams(window.location.search);
            const { closeTicketId } = Object.fromEntries(urlSearchParams.entries());

            if (closeTicketId) {
                $("#new_item_modal_button").click();

                $.ajax({
                    'url' : '/equipment-by-ticket/' + closeTicketId,
                    'type' : 'GET',
                    'success': (response) => {
                        const {equipment} = response;

                        let options = '<option value="" selected>- select equipment -</option>'
                        equipment.forEach((e) => {
                            options += `<option value=\"${e.id}\">${e.name}</option>`;
                        });
                        $("#equipment_select").html(options);

                        $('<input>').attr({
                            type: 'hidden',
                            name: 'ticket_id',
                            value: closeTicketId,
                        }).appendTo('#new_item_form');
                    }
                });
            }
        })
    </script>
@endsection

