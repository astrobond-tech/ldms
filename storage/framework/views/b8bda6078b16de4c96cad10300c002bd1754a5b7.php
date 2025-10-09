<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Document Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('document.index')); ?>"><?php echo e(__('Document')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#"><?php echo e(__('Details')); ?></a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php echo $__env->make('document.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="col-lg-9">
                        <div class="email-body">
                            <?php if(Gate::check('create reminder')): ?>
                                <div class="row align-items-center g-2">
                                    <div class="col">
                                        <h5><?php echo e(__('Reminder')); ?></h5>
                                    </div>
                                    <div class="col-auto">
                                        <?php if(Gate::check('create reminder')): ?>
                                            <a class="btn btn-secondary btn-sm ml-20 customModal" href="#"
                                                data-size="lg"
                                                data-url="<?php echo e(route('document.add.reminder', $document->id)); ?>"
                                                data-title="<?php echo e(__('Create Reminder')); ?>"> <i
                                                    class="ti ti-plus mr-5"></i><?php echo e(__('Create Reminder')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="collapse" id="collapse1">
                                    <?php echo e(Form::open(['url' => 'reminder', 'method' => 'post'])); ?>

                                    <?php echo e(Form::hidden('document_id', $document->id, ['class' => 'form-control'])); ?>

                                    <div class="row">
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

                                    <?php echo e(Form::close()); ?>

                                </div>
                            <?php endif; ?>
                            <div class="card">
                                <div class="card-body pt-0">
                                    <div class="dt-responsive table-responsive">
                                        <table class="table table-hover advance-datatable">
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('Date')); ?></th>
                                                    <th><?php echo e(__('Time')); ?></th>
                                                    <th><?php echo e(__('Subject')); ?></th>
                                                    <th><?php echo e(__('Created By')); ?></th>
                                                    <?php if(Gate::check('show reminder')): ?>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reminder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr role="row">
                                                        <td><?php echo e(dateFormat($reminder->date)); ?></td>
                                                        <td><?php echo e(timeFormat($reminder->time)); ?></td>
                                                        <td> <?php echo e($reminder->subject); ?> </td>
                                                        <td> <?php echo e(!empty($reminder->createdBy) ? $reminder->createdBy->name : '-'); ?>

                                                        </td>
                                                        <?php if(Gate::check('show reminder')): ?>
                                                            <td>
                                                                <a class="avtar avtar-xs btn-link-warning text-warning customModal"
                                                                    data-size="lg" data-bs-toggle="tooltip"
                                                                    data-bs-original-title="<?php echo e(__('Show')); ?>"
                                                                    href="#"
                                                                    data-url="<?php echo e(route('reminder.show', encrypt($reminder->id))); ?>"
                                                                    data-title="<?php echo e(__('Details')); ?>"> <i
                                                                        data-feather="eye"></i></a>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Desktop/codecanyon-49249517-digital-document-saas-addon/main_file/resources/views/document/reminder.blade.php ENDPATH**/ ?>