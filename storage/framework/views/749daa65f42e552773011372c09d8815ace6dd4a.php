<?php echo e(Form::open(['url' => 'Stage', 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('title', __('title'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Title')])); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('color', __('color'), ['class' => 'form-label'])); ?>

            <?php echo Form::input('color', 'color', null, ['class' => 'form-control','style' => 'height: 50px;']); ?>

        </div>
    </div>
</div>
<div class="modal-footer">

    <?php echo e(Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded'])); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/khalid/Desktop/codecanyon-49249517-digital-document-saas-addon/main_file/resources/views/stage/create.blade.php ENDPATH**/ ?>