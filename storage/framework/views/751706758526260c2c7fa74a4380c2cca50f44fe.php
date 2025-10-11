

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Paper Cutting')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#"><?php echo e(__('Paper Cutting')); ?></a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card table-card">
            <div class="card-header">
                <div class="row align-items-center g-2 flex-wrap">
                    <div class="col-12 col-md">
                        <h5><?php echo e(__('Paper Cutting')); ?></h5>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex flex-wrap gap-2">
                            <div>
                                <a class="btn btn-secondary customModal" href="#!" data-size="lg"
                                   data-url="<?php echo e(route('paper-cutting.create')); ?>"
                                   data-title="<?php echo e(__('Create Paper Cutting')); ?>">
                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                    <?php echo e(__('Create Paper Cutting')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="dt-responsive table-responsive">
                    <table class="table table-hover advance-datatable">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Paper Name')); ?></th>
                                <th><?php echo e(__('Room No')); ?></th>
                                <th><?php echo e(__('Rack No')); ?></th>
                                <th><?php echo e(__('Shelf No')); ?></th>
                                <th><?php echo e(__('Box No')); ?></th>
                                <th><?php echo e(__('Created By')); ?></th>
                                <th><?php echo e(__('Created At')); ?></th>
                                <th class="text-right"><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $paperCuttings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($paper->paper_name); ?></td>
                                <td><?php echo e($paper->room_no ?? '-'); ?></td>
                                <td><?php echo e($paper->rack_no ?? '-'); ?></td>
                                <td><?php echo e($paper->shelf_no ?? '-'); ?></td>
                                <td><?php echo e($paper->box_no ?? '-'); ?></td>
                                <td><?php echo e(optional($paper->createdBy)->name); ?></td>
                                <td><?php echo e(dateFormat($paper->created_at)); ?></td>
                                <td class="text-right">
                                    <div class="cart-action">
                                        <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                           data-bs-toggle="tooltip" data-size="lg"
                                           data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#!"
                                           data-url="<?php echo e(route('paper-cutting.edit', encrypt($paper->id))); ?>"
                                           data-title="<?php echo e(__('Edit Paper Cutting')); ?>">
                                           <i data-feather="edit"></i>
                                        </a>

                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['paper-cutting.destroy', encrypt($paper->id)], 'class' => 'd-inline']); ?>

                                        <a class="avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                           data-bs-toggle="tooltip"
                                           data-bs-original-title="<?php echo e(__('Delete')); ?>" href="#">
                                           <i data-feather="trash-2"></i>
                                        </a>
                                        <?php echo Form::close(); ?>

                                    </div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\bdtech\ldms\resources\views/paper_cutting/index.blade.php ENDPATH**/ ?>