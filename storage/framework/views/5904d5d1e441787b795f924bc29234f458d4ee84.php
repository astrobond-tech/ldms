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
                            <div class="card">
                                <div class="">
                                    <div class="row align-items-center g-2">
                                        <div class="col">
                                            <h5><?php echo e(__('Basic Details')); ?></h5>
                                        </div>
                                        <div class="col-auto">
                                            <?php if(Gate::check('edit document')): ?>
                                                <a class="btn btn-secondary" data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Preview')); ?>"
                                                    href="<?php echo e(!empty($latestVersion->document) ? fetch_file($latestVersion->document,'upload/document/') : '#'); ?>"
                                                    target="_blank"><i data-feather="maximize"> </i></a>
                                            <?php endif; ?>
                                            <?php if(Gate::check('download document')): ?>
                                                <a class="btn btn-secondary" data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Download')); ?>"
                                                    href="<?php echo e(!empty($latestVersion->document) ? fetch_file($latestVersion->document,'upload/document/') : '#'); ?>" download><i
                                                        data-feather="download"> </i></a>
                                            <?php endif; ?>
                                            <?php if(Gate::check('preview document')): ?>
                                                <a class="btn btn-secondary customModal" data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                                    data-url="<?php echo e(route('document.edit', encrypt($document->id))); ?>"
                                                    data-title="<?php echo e(__('Edit Support')); ?>"> <i
                                                        data-feather="edit"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Document Name')); ?></b></td>
                                                        <td class="py-1"><?php echo e($document->name); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Category')); ?></b></td>
                                                        <td class="py-1">
                                                            <?php echo e(!empty($document->category) ? $document->category->title : '-'); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Sub Category')); ?></b></td>
                                                        <td class="py-1">
                                                            <?php echo e(!empty($document->subCategory) ? $document->subCategory->title : '-'); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Created By')); ?></b></td>
                                                        <td class="py-1">
                                                            <?php echo e(!empty($document->createdBy) ? $document->createdBy->name : ''); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Created At')); ?></b></td>
                                                        <td class="py-1"><?php echo e(dateFormat($document->created_at)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Tags')); ?></b></td>
                                                        <td class="py-1">
                                                            <?php $__currentLoopData = $document->tags(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php echo e($tag->title); ?>,
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Description')); ?></b></td>
                                                        <td class="py-1"><?php echo e($document->description); ?></td>
                                                    </tr>
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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Desktop/codecanyon-49249517-digital-document-saas-addon/main_file/resources/views/document/show.blade.php ENDPATH**/ ?>