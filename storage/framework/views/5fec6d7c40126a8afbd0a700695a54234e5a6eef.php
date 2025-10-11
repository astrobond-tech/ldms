<?php echo e(Form::open(array('route'=>array('reminder.store'),'method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('date',__('Date'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('date',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('time',__('Time'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::time('time',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('document_id',__('Document'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::select('document_id',$documents,null,array('class'=>'form-control hidesearch'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('assign_user',__('Assign Users'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::select('assign_user[]',$users,null,array('class'=>'form-control hidesearch','multiple'))); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('subject',__('Subject'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('subject',null,array('class'=>'form-control','placeholder'=>__('Enter reminder subject')))); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('message',__('Message'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('message',null,array('class'=>'form-control','placeholder'=>__('Enter reminder message'),'rows'=>2))); ?>

        </div>
        <div class="form-group  col-md-12 text-end">
            <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-secondary btn-rounded'))); ?>

        </div>
    </div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/khalid/Documents/ldms/resources/views/reminder/create.blade.php ENDPATH**/ ?>