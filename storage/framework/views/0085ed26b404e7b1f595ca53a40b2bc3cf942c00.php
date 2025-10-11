<?php
    $document_type_title = ucwords(str_replace('_', ' ', $document_type ?? 'document'));
    $document_type_route = str_replace('_', '-', $document_type ?? 'document');
?>


<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Document Details')); ?>

<?php $__env->stopSection(); ?>

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
                            <?php if(Gate::check('create version')): ?>
                                        <div class="row align-items-center g-2">
                                            <div class="col">
                                                <h5><?php echo e(__('Version History')); ?></h5>
                                            </div>

                                        </div>
                                        <?php echo e(Form::open(['route' => [$document_type_route.'.new.version', \Illuminate\Support\Facades\Crypt::encrypt($document->id)], 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

                                        <?php echo e(Form::hidden('document_id', $document->id, ['class' => 'form-control'])); ?>

                                        <div class="row">
                                            <div class="form-group  col-md-12">
                                                <?php echo e(Form::label('document', __('Document'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::file('document', ['class' => 'form-control'])); ?>

                                            </div>
                                            <div class="form-group  col-md-12 text-end">
                                                <?php echo e(Form::submit(__('Upload'), ['class' => 'btn btn-secondary btn-rounded'])); ?>

                                            </div>
                                        </div>
                                        <?php echo e(Form::close()); ?>

                            <?php endif; ?>
                            <div class="card">
                                <div class="card-body pt-0">
                                    <div class="dt-responsive table-responsive">
                                        <table class="table table-hover advance-datatable">
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('Uploaded At')); ?></th>
                                                    <th><?php echo e(__('Uploaded By')); ?></th>
                                                    <th><?php echo e(__('Status')); ?></th>
                                                    <?php if(Gate::check('preview document') || Gate::check('download document')): ?>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $versions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $version): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr role="row">
                                                        <td><?php echo e(dateFormat($version->created_at)); ?>

                                                            <?php echo e(timeFormat($version->created_at)); ?></td>
                                                        <td><?php echo e(!empty($version->createdBy) ? $version->createdBy->name : '-'); ?>

                                                        </td>
                                                        <td>
                                                            <?php if($version->current_version == 1): ?>
                                                                <span
                                                                    class="d-inline badge text-bg-success"><?php echo e(__('Current Version')); ?></span>
                                                            <?php else: ?>
                                                                <span
                                                                    class="d-inline badge text-bg-warning"><?php echo e(__('Old Version')); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <?php if(Gate::check('preview document') || Gate::check('download document')): ?>
                                                            <td>
                                                                <?php if(Gate::check('preview document')): ?>
                                                                    <a class="avtar avtar-xs btn-link-info text-info"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="<?php echo e(__('View')); ?>"
                                                                        href="<?php echo e(!empty($version->document) ? fetch_file($version->document,'upload/document/') : '#'); ?>"
                                                                        target="_blank"> <i
                                                                            data-feather="maximize"></i></a>
                                                                <?php endif; ?>
                                                                <?php if(Gate::check('download document')): ?>
                                                                    <a class="avtar avtar-xs btn-link-primary text-primary"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="<?php echo e(__('Download')); ?>"
                                                                        href="<?php echo e(!empty($version->document) ? fetch_file($version->document,'upload/document/') : '#'); ?>"
                                                                        download=""> <i
                                                                            data-feather="download"></i></a>
                                                                <?php endif; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Documents/ldms/resources/views/document/version_history.blade.php ENDPATH**/ ?>