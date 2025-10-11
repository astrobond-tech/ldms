<?php echo e(Form::open(array('url'=>route('assign.return.store', $issue->id),'method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <p><strong><?php echo e(__('Client')); ?>:</strong> <?php echo e(optional($issue->user)->name); ?></p>
            <p><strong><?php echo e(__('Document')); ?>:</strong> <?php echo e(optional($issue->document)->name); ?></p>
            <?php if(optional($issue->document->essential)->rack): ?>
                <p><strong><?php echo e(__('Rack')); ?>:</strong> <?php echo e($issue->document->essential->rack); ?></p>
            <?php endif; ?>
            <?php if(optional($issue->document->essential)->shelf): ?>
                <p><strong><?php echo e(__('Shelf')); ?>:</strong> <?php echo e($issue->document->essential->shelf); ?></p>
            <?php endif; ?>
            <?php if(optional($issue->document->essential)->room): ?>
                <p><strong><?php echo e(__('Room')); ?>:</strong> <?php echo e($issue->document->essential->room); ?></p>
            <?php endif; ?>
            <?php if(optional($issue->document->essential)->cabinet): ?>
                <p><strong><?php echo e(__('Cabinet')); ?>:</strong> <?php echo e($issue->document->essential->cabinet); ?></p>
            <?php endif; ?>
            <p><strong><?php echo e(__('Issued Copies')); ?>:</strong> <?php echo e($issue->quantity); ?></p>
            <p><strong><?php echo e(__('Returned Copies')); ?>:</strong> <?php echo e($issue->returned_quantity); ?></p>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('return_quantity',__('Return Copies'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::number('return_quantity', 1, array('class'=>'form-control', 'required'=>'required', 'min'=>'1', 'max'=>($issue->quantity - $issue->returned_quantity)))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('return_date',__('Return Date'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::date('return_date', \Carbon\Carbon::now(), array('class'=>'form-control', 'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('return_notes',__('Notes'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('return_notes', null, array('class'=>'form-control', 'rows'=>3))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo e(Form::submit(__('Return'),array('class'=>'btn btn-secondary btn-rounded'))); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/khalid/Documents/ldms/resources/views/assign/return.blade.php ENDPATH**/ ?>