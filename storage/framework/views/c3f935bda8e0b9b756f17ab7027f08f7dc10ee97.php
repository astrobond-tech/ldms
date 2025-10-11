<?php echo e(Form::open(['route' => 'document-store.store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('document_name', __('Document Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('document_name', null, ['class' => 'form-control', 'placeholder' => __('Enter Document Name')])); ?>

        </div>
        <div class="form-group col-md-6">
            <!-- Availability Type -->
            <div class="form-group col-md-12">
                <?php echo e(Form::label('availability_type', __('Availability Type'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::select('availability_type', ['' => __('-- Select --'), 'offline' => __('Offline Only'), 'online' => __('Online Only'), 'both' => __('Both (Offline & Online)')], old('availability_type'), ['class' => 'form-control', 'id' => 'availabilityType', 'required'])); ?>

                <small class="form-text text-muted d-block mt-2">
                    <strong>Offline:</strong> Book in physical location (Room, Rack, Shelf, Box)<br>
                    <strong>Online:</strong> PDF file only<br>
                    <strong>Both:</strong> Physical location + PDF file
                </small>
            </div>
            <?php echo e(Form::file('document_file', ['class' => 'form-control'])); ?>

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
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('Enter Description')])); ?>

        </div>
    </div>
</div>

<div class="modal-footer">
    <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-secondary btn-rounded'])); ?>

    <button type="button" class="btn btn-light btn-rounded" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH D:\xampp\htdocs\bdtech\ldms\resources\views/document_store/create.blade.php ENDPATH**/ ?>