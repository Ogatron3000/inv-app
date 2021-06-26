@extends('layouts.main')
@section('page_title', 'Dashboard')

@section('additional_styles')
@endsection

@section('content-header')
    @include('partials.content-header', [
        'content_header' => 'Equipment Category FAQ',
        'breadcrumbs' => [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Equipment Category List', 'link' => route('equipment-categories.index') ],
            [ 'name' => 'Equipment Category FAQ', 'link' =>  route('equipment-categories.show', $equipmentCategory)],
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
                            <i class="fas fa-laptop-code mr-1"></i>
                            {{ $equipmentCategory->name }} FAQ
                        </h3>
                        @can('manage', \App\Models\EquipmentCategory::class)
                            <div class="card-tools">
                                <ul class="nav nav-pills">
                                    <li class="nav-item ml-2">
                                        <a class="btn btn-sm btn-flat btn-primary" data-toggle="modal" data-target="#new_faq_modal">
                                            Add new FAQ
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body table-responsive">

                    @foreach($equipmentCategory->faq as $faq)
                        <div class="card card-default collapsed-card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    {{ $faq->question }}
                                </h3>
                                <div class="card-tools">
                                    @can('manage', \App\Models\EquipmentCategory::class)
                                        <button class="btn btn-tool" data-toggle="modal" data-target="#edit_faq_modal" data-id="{{ $faq->id }}" data-question="{{ $faq->question }}" data-answer="{{ $faq->answer }}">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <div class="d-inline">
                                            <a id="delete_modal_button" class="btn btn-tool" data-toggle="modal" data-target="#delete_modal" data-id="{{ $faq->id }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <form action="{{ route('faq.destroy', $faq) }}" method="POST" id="delete_form_{{ $faq->id }}" class="d-none">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </div>
                                    @endcan
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>{{ $faq->answer }}</div>
                            </div>
                        </div>
                    @endforeach

                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>

    @include('equipment_categories.faq.new_faq_modal')
    @include('equipment_categories.faq.edit_faq_modal')
    @include('partials.delete_modal', ['modalTitle' => 'Delete Equipment Category'])

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/helpers/deleteModal.js') }}"></script>
    <script>
        $('#edit_faq_modal').on('show.bs.modal', function(e) {
            let button = $(e.relatedTarget),
                modal = $(this),
                faqId = button.data('id'),
                question = button.data("question"),
                answer = button.data("answer");

            modal.find("#edit_faq_form").attr("action", `/faq/${faqId}`);
            modal.find("#question").val(question);
            modal.find("#answer").val(answer);
        });
    </script>
@endsection
