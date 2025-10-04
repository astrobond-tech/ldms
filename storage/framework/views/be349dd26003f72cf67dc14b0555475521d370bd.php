<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Reminder')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
    </li>
    <li class="breadcrumb-item active">
        <a href="#"><?php echo e(__('Reminder')); ?></a>
    </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create reminder')): ?>
        <a class="btn btn-secondary btn-sm ml-20 customModal" href="#" data-size="lg"
            data-url="<?php echo e(route('reminder.create')); ?>" data-title="<?php echo e(__('Create Reminder')); ?>"> <i
                class="ti-plus mr-5"></i><?php echo e(__('Create Reminder')); ?></a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>
                                <?php echo e(__('Reminder')); ?>

                            </h5>
                        </div>
                        <?php if(Gate::check('create reminder')): ?>
                            <div class="col-auto">
                                <a class="btn btn-secondary customModal" href="#" data-size="lg"
                                    data-url="<?php echo e(route('reminder.create')); ?>" data-title="<?php echo e(__('Create Reminder')); ?>">
                                    <i class="ti ti-circle-plus align-text-bottom"></i><?php echo e(__('Create Reminder')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Time')); ?></th>
                                    <th><?php echo e(__('Subject')); ?></th>
                                    <th><?php echo e(__('Created By')); ?></th>
                                    <th><?php echo e(__('Assigned')); ?></th>
                                    <?php if(Gate::check('edit reminder') || Gate::check('delete reminder') || Gate::check('show reminder')): ?>
                                        <th class="text-right"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reminder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr role="row">
                                        <td><?php echo e(dateFormat($reminder->date)); ?></td>
                                        <td><?php echo e(timeFormat($reminder->time)); ?></td>
                                        <td> <?php echo e($reminder->subject); ?> </td>
                                        <td> <?php echo e(!empty($reminder->createdBy) ? $reminder->createdBy->name : '-'); ?> </td>
                                        <td>
                                            <?php $__currentLoopData = $reminder->users(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($user): ?>
                                                    
                                                    <?php echo e($user->name); ?> <br>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <?php if(Gate::check('edit reminder') || Gate::check('delete reminder') || Gate::check('show reminder')): ?>
                                            <td class="text-right">
                                                <div class="cart-action">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['reminder.destroy', encrypt($reminder->id)]]); ?>

                                                    <?php if(Gate::check('show reminder')): ?>
                                                        <a class="avtar avtar-xs btn-link-warning text-warning customModal" data-size="lg"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="<?php echo e(__('Show')); ?>" href="#"
                                                            data-url="<?php echo e(route('reminder.show', encrypt($reminder->id))); ?>"
                                                            data-title="<?php echo e(__('Details')); ?>"> <i
                                                                data-feather="eye"></i></a>
                                                    <?php endif; ?>
                                                    <?php if(Gate::check('edit reminder')): ?>
                                                        <a class="avtar avtar-xs btn-link-secondary text-secondary customModal" data-size="lg"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                                            data-url="<?php echo e(route('reminder.edit', encrypt($reminder->id))); ?>"
                                                            data-title="<?php echo e(__('Edit Reminder')); ?>"> <i
                                                                data-feather="edit"></i></a>
                                                    <?php endif; ?>
                                                    <?php if(Gate::check('delete reminder')): ?>
                                                        <a class=" avtar avtar-xs btn-link-danger text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                            data-bs-original-title="<?php echo e(__('Detete')); ?>" href="#"> <i
                                                                data-feather="trash-2"></i></a>
                                                    <?php endif; ?>
                                                    <?php echo Form::close(); ?>

                                                </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\main_file\resources\views/reminder/index.blade.php ENDPATH**/ ?>