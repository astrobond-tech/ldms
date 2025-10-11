<?php echo e(Form::open(['route' => 'paper-cutting.store', 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('paper_name', __('Paper Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('paper_name', null, ['class' => 'form-control', 'placeholder' => __('Enter Paper Name')])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('heading', __('Heading'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('heading', null, ['class' => 'form-control', 'placeholder' => __('Enter Heading')])); ?>

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
            <?php echo e(Form::label('papercutting_file', __('Paper Cutting File'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::file('papercutting_file', ['class' => 'form-control'])); ?>

        </div>
    </div>
</div>

<div class="modal-footer">
    <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-secondary btn-rounded'])); ?>

</div>
<?php echo e(Form::close()); ?>


<script>
    var baseUrl = "<?php echo e(route('paper-cutting.store')); ?>";
</script>
<script src="<?php echo e(asset('js/custom/paperCutting.js?')); ?><?php echo e(time()); ?>"></script>
<?php /**PATH D:\xampp\htdocs\bdtech\ldms\resources\views/paper_cutting/create.blade.php ENDPATH**/ ?>