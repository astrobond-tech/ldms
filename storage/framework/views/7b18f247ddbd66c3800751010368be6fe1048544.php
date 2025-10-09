<?php echo e(Form::model($subscription, array('route' => array('subscriptions.update', encrypt($subscription->id)), 'method' => 'PUT'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('title',__('Title'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter subscription title'),'required'=>'required'))); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('interval', __('Interval'),array('class'=>'form-label'))); ?>

            <?php echo Form::select('interval', $intervals, null,array('class' => 'form-control hidesearch','required'=>'required')); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('package_amount',__('Package Amount'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('package_amount',null,array('class'=>'form-control','placeholder'=>__('Enter package amount'),'step'=>'0.01'))); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('user_limit',__('User Limit'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('user_limit',null,array('class'=>'form-control','placeholder'=>__('Enter user limit'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('document_limit',__('Document Limit'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('document_limit',null,array('class'=>'form-control','placeholder'=>__('Enter document limit'),'required'=>'required'))); ?>

        </div>

        <div class="form-group col-md-6">
            <div class="form-check form-switch custom-switch-v1 mb-2">

                <input class="form-check-input input-secondary" type="checkbox" name="enabled_document_history" <?php echo e($subscription->enabled_document_history==1?'checked':''); ?>

                    id="enabled_document_history">

                <?php echo e(Form::label('enabled_document_history', __('Show Document History'), ['class' => 'form-label'])); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="form-check form-switch custom-switch-v1 mb-2">
                <input type="checkbox" class="form-check-input input-secondary" name="enabled_logged_history" <?php echo e($subscription->enabled_logged_history==1?'checked':''); ?>

                    id="enabled_logged_history">
                <?php echo e(Form::label('enabled_logged_history', __('Show User Logged History'), ['class' => 'form-label'])); ?>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">

    <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-secondary btn-rounded'))); ?>

</div>
<?php echo e(Form::close()); ?>



<?php /**PATH /home/khalid/Desktop/codecanyon-49249517-digital-document-saas-addon/main_file/resources/views/subscription/edit.blade.php ENDPATH**/ ?>