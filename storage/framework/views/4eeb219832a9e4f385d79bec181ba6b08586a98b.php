<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Assign Document')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#"><?php echo e(__('Assign Document')); ?></a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2 flex-wrap">
                        <div class="col-12 col-md">
                            <h5><?php echo e(__('Assigned Documents')); ?></h5>
                        </div>
                        <div class="col-12 col-md-auto">
                            <a class="btn btn-secondary customModal" href="#!" data-size="lg"
                                data-url="<?php echo e(route('assign.create')); ?>"
                                data-title="<?php echo e(__('Assign Document')); ?>">
                                <i class="ti ti-circle-plus align-text-bottom"></i>
                                <?php echo e(__('Add Assign')); ?>

                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Client')); ?></th>
                                    <th><?php echo e(__('Document')); ?></th>
                                    <th><?php echo e(__('Issued By')); ?></th>
                                    <th><?php echo e(__('Issue Date')); ?></th>
                                    <th><?php echo e(__('Due Date')); ?></th>
                                    <th><?php echo e(__('Issued')); ?></th>
                                    <th><?php echo e(__('Returned')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th class="text-right"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $assignedDocuments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assigned): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr role="row">
                                        <td><?php echo e(optional($assigned->user)->name); ?></td>
                                        <td><?php echo e(optional($assigned->document)->name); ?></td>
                                        <td><?php echo e(optional($assigned->issuer)->name); ?></td>
                                        <td><?php echo e(dateFormat($assigned->issue_date)); ?></td>
                                        <td><?php echo e(dateFormat($assigned->due_date)); ?></td>
                                        <td><?php echo e($assigned->quantity); ?></td>
                                        <td><?php echo e($assigned->returned_quantity); ?></td>
                                        <td><span class="badge bg-success"><?php echo e($assigned->status); ?></span></td>
                                        <td class="text-right">
                                            <a class="avtar avtar-xs btn-link-info text-secondary customModal"
                                                data-bs-toggle="tooltip" data-size="md"
                                                data-bs-original-title="<?php echo e(__('Return')); ?>" href="#!"
                                                data-url="<?php echo e(route('assign.return', $assigned->id)); ?>"
                                                data-title="<?php echo e(__('Return Document')); ?>">
                                                <i data-feather="corner-up-left"></i>
                                            </a>
                                        </td>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Documents/ldms/resources/views/assign/index.blade.php ENDPATH**/ ?>