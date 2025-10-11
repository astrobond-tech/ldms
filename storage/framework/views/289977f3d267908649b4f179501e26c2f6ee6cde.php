<?php
    $document_type_title = ucwords(str_replace('_', ' ', $document_type ?? 'document'));
    $document_type_route = str_replace('_', '-', $document_type ?? 'document');
?>


<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Document Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        "use strict";
        $(document).on('click', '#time_duration', function () {
            if ($("#time_duration").is(':checked'))
                $(".time_duration").removeClass('d-none');
            else
                $(".time_duration").addClass('d-none');
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo e(route($document_type_route.'.index')); ?>"><?php echo e(__($document_type_title)); ?></a>
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
                                <?php if(Gate::check('create share document')): ?>
                                        <div class="row align-items-center g-2">
                                            <div class="col">
                                                <h5><?php echo e(__('Share Document')); ?></h5>
                                            </div>
                                            <div class="col-auto">
                                                <a class="btn btn-secondary btn-sm ml-20 customModal" href="#"
                                                    data-size="lg"
                                                    data-url="<?php echo e(route($document_type_route.'.add.share', encrypt($document->id))); ?>"
                                                    data-title="<?php echo e(__('Share Document')); ?>"> <i
                                                        class="ti ti-plus mr-5"></i><?php echo e(__('Share Document')); ?></a>
                                            </div>
                                        </div>
                                <?php endif; ?>
                            <div class="card">
                                <div class="  pt-0">
                                    <div class="dt-responsive table-responsive">
                                        <table class="table table-hover advance-datatable">
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('User Name')); ?></th>
                                                    <th><?php echo e(__('Email')); ?></th>
                                                    <th><?php echo e(__('Assign At')); ?></th>
                                                    <th><?php echo e(__('Start Date')); ?></th>
                                                    <th><?php echo e(__('End Date')); ?></th>
                                                    <?php if(Gate::check('delete share document')): ?>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $shareDocuments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shareDocument): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr role="row">
                                                        <td><?php echo e(!empty($shareDocument->user) ? $shareDocument->user->name : '-'); ?></td>
                                                        <td><?php echo e(!empty($shareDocument->user) ? $shareDocument->user->email : '-'); ?></td>
                                                        <td><?php echo e(dateFormat($shareDocument->created_at)); ?></td>
                                                        <td><?php echo e(!empty($shareDocument->start_date) ? dateFormat($shareDocument->start_date) : '-'); ?></td>
                                                        <td><?php echo e(!empty($shareDocument->end_date) ? dateFormat($shareDocument->end_date) : '-'); ?></td>
                                                        <?php if(Gate::check('delete share document')): ?>
                                                            <td>
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => [$document_type_route.'.share.destroy', encrypt($shareDocument->id)]]); ?>

                                                                <a class=" avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-original-title="<?php echo e(__('Detete')); ?>"
                                                                    href="#"> <i data-feather="trash-2"></i></a>
                                                                <?php echo Form::close(); ?>

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Documents/ldms/resources/views/document/share.blade.php ENDPATH**/ ?>