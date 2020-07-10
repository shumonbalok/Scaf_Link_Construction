@extends('voyager::master')


@section('page_header')
<div class="container-fluid">
    <h1 class="page-title">
        <i class="voyager-news"></i> Posts
    </h1>
    <a href="http://127.0.0.1:8000/admin/posts/create" class="btn btn-success btn-add-new">
        <i class="voyager-plus"></i> <span>Add New</span>
    </a>
    <a class="btn btn-danger" id="bulk_delete_btn"><i class="voyager-trash"></i> <span>Bulk Delete</span></a>
<!-- /.modal -->

    <script>
    window.onload = function () {
        // Bulk delete selectors
        var $bulkDeleteBtn = $('#bulk_delete_btn');
        var $bulkDeleteModal = $('#bulk_delete_modal');
        var $bulkDeleteCount = $('#bulk_delete_count');
        var $bulkDeleteDisplayName = $('#bulk_delete_display_name');
        var $bulkDeleteInput = $('#bulk_delete_input');
        // Reposition modal to prevent z-index issues
        $bulkDeleteModal.appendTo('body');
        // Bulk delete listener
        $bulkDeleteBtn.click(function () {
            var ids = [];
            var $checkedBoxes = $('#dataTable input[type=checkbox]:checked').not('.select_all');
            var count = $checkedBoxes.length;
            if (count) {
                // Reset input value
                $bulkDeleteInput.val('');
                // Deletion info
                var displayName = count > 1 ? 'Posts' : 'Post';
                displayName = displayName.toLowerCase();
                $bulkDeleteCount.html(count);
                $bulkDeleteDisplayName.html(displayName);
                // Gather IDs
                $.each($checkedBoxes, function () {
                    var value = $(this).val();
                    ids.push(value);
                })
                // Set input value
                $bulkDeleteInput.val(ids);
                // Show modal
                $bulkDeleteModal.modal('show');
            } else {
                // No row selected
                toastr.warning('You haven&#039;t selected anything to delete');
            }
        });
    }
    </script>
</div>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
<div class="page-content read container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered" style="padding-bottom:5px;">
                <div class="panel-heading" style="border-bottom:0;">
                    <h3 class="panel-title">Order Title</h3>
                </div>

                <div class="panel-body" style="padding-top:0;">
                
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('javascript')
   
    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>
@stop
