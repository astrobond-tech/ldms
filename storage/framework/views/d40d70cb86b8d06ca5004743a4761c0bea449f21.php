<?php echo e(Form::open(['route' => 'book-assign.store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('assign_to', __('Assign To'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('assign_to', $clients, null, ['class' => 'form-control hidesearch'])); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('name', __('Book Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter book name')])); ?>

        </div>

        <div class="form-group col-md-3">
            <?php echo e(Form::label('room_no', __('Room No'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('room_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Room No')])); ?>

        </div>

        <div class="form-group col-md-3">
            <?php echo e(Form::label('rack_no', __('Rack No'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('rack_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Rack No')])); ?>

        </div>

        <div class="form-group col-md-3">
            <?php echo e(Form::label('shelf_no', __('Shelf No'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('shelf_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Shelf No')])); ?>

        </div>

        <div class="form-group col-md-3">
            <?php echo e(Form::label('box_no', __('Box No'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('box_no', null, ['class' => 'form-control', 'placeholder' => __('Enter Box No')])); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('document', __('Document'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::file('document', ['class' => 'form-control'])); ?>

        </div>

        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('SUBMIT'), ['class' => 'btn btn-secondary btn-rounded'])); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH D:\xampp\htdocs\bdtech\ldms\resources\views/book_assign/create.blade.php ENDPATH**/ ?>