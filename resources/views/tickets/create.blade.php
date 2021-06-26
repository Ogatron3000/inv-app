@extends('layouts.main')

@section('page_title', 'Add New Ticket')

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Add New Ticket',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Ticket List', 'link' => '/tickets' ],
            [ 'name' => 'New Ticket', 'link' => '/tickets/create'],
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
                        New Ticket
                    </h3>

                </div><!-- /.card-header -->

                <div class="card-body table-responsive">

                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf

                        <input type="text" name="ticket_type[name]" value="{{ $ticketType }}" hidden>

                        @if($ticketType === \App\Models\Ticket::EQUIPMENT_TICKET)
                            @include('tickets.equipment.create')
                        @elseif($ticketType === \App\Models\Ticket::OFFICE_SUPPLIES_TICKET)
                            @include('tickets.office_supplies.create')
                        @elseif($ticketType === \App\Models\Ticket::REPAIR_TICKET)
                            @include('tickets.repair.create')
                        @endif

                        <div class="row mt-4">
                            <div class="col-12">
                                <label for="comment">Comment:</label>
                                <textarea name="comment[content]" id="comment" class="form-control @error('comment.content') is-invalid @endif" placeholder="Enter comment" rows="4">{{ old('comment.content') }}</textarea>
                                @error('comment.content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 offset-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat mt-4">
                                    SUBMIT REQUEST
                                </button>
                            </div>
                        </div>

                    </form>

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

    @include('partials.delete_modal', ['modalTitle' => 'Delete Ticket'])

@endsection

@section('additional_scripts')
@endsection
