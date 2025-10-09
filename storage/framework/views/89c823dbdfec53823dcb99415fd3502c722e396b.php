<?php echo e(Form::open(['url' => 'reminder', 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <?php echo e(Form::hidden('document_id', $document->id, ['class' => 'form-control'])); ?>

        <div class="form-group  col-md-6">
            <?php echo e(Form::label('date', __('Date'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::date('date', null, ['class' => 'form-control'])); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('time', __('Time'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::time('time', null, ['class' => 'form-control'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('assign_user', __('Assign Users'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('assign_user[]', $users, null, ['class' => 'form-control hidesearch', 'multiple'])); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('subject', __('Subject'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('subject', null, ['class' => 'form-control', 'placeholder' => __('Enter reminder subject')])); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('message', __('Message'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => __('Enter reminder message'), 'rows' => 2])); ?>

        </div>
        <div class="form-group  col-md-12 text-end">
            <?php echo e(Form::submit(__('Create'), ['class' => 'btn btn-secondary btn-rounded'])); ?>

        </div>
    </div>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/khalid/Desktop/codecanyon-49249517-digital-document-saas-addon/main_file/resources/views/document/add_reminder.blade.php ENDPATH**/ ?>