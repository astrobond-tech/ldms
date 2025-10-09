<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('History')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#"><?php echo e(__('History')); ?></a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center g-2">
                    <div class="col">
                        <h5>
                            <?php echo e(__('History')); ?>

                        </h5>
                    </div>

                </div>
            </div>
            <div class="card-body pt-0">
                <div class="dt-responsive table-responsive">
                    <table class="table table-hover advance-datatable">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Document')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                                <th><?php echo e(__('Action Time')); ?></th>
                                <th><?php echo e(__('Action User')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr role="row">
                                    <td> <?php echo e(!empty($history->documents) ? $history->documents->name : '-'); ?> </td>
                                    <td> <?php echo e(ucfirst($history->action)); ?> </td>
                                    <td><?php echo e(dateFormat($history->created_at)); ?> <?php echo e(timeFormat($history->created_at)); ?>

                                    </td>
                                    <td> <?php echo e(!empty($history->actionUser) ? $history->actionUser->name : '-'); ?> </td>
                                    <td> <?php echo e($history->description); ?> </td>
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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Desktop/codecanyon-49249517-digital-document-saas-addon/main_file/resources/views/document/history.blade.php ENDPATH**/ ?>