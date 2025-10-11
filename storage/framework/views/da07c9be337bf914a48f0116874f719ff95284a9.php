<?php
    $document_type_title = ucwords(str_replace('_', ' ', $document_type ?? 'document'));
    $document_type_route = str_replace('_', '-', $document_type ?? 'document');
?>


<?php $__env->startSection('page-title'); ?>
    <?php echo e(__($document_type_title . ' Details')); ?>

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
                                            <?php if(Gate::check('edit document')): ?>
                                                <a class="btn btn-secondary customModal" data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#"
                                                    data-url="<?php echo e(route($document_type_route.'.edit', encrypt($document->id))); ?>"
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
                                                        <td class="text-muted py-1"><b><?php echo e(__($document_type_title . ' Name')); ?></b></td>
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
                            <div class="card">
                                <div class="card-header">
                                    <h5><?php echo e(__('Essential Details')); ?></h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>

                                                <tr>
                                                    <td class="text-muted py-1"><b><?php echo e(__('Total Copies')); ?></b></td>
                                                    <td class="py-1"><?php echo e(optional($document->essential)->copies_total); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted py-1"><b><?php echo e(__('Available Copies')); ?></b></td>
                                                    <td class="py-1"><?php echo e(optional($document->essential)->copies_available); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted py-1"><b><?php echo e(__('Location')); ?></b></td>
                                                    <td class="py-1"><?php echo e(optional($document->essential)->room); ?>, <?php echo e(optional($document->essential)->cabinet); ?>, <?php echo e(optional($document->essential)->rack); ?>, <?php echo e(optional($document->essential)->shelf); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted py-1"><b><?php echo e(__('Responsible Person')); ?></b></td>
                                                    <td class="py-1"><?php echo e(optional(optional($document->essential)->responsiblePerson)->name); ?></td>
                                                </tr>
                                                <?php if(optional($document->essential)->document_type == 'book'): ?>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Author')); ?></b></td>
                                                        <td class="py-1"><?php echo e(optional($document->essential)->author); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Publisher')); ?></b></td>
                                                        <td class="py-1"><?php echo e(optional($document->essential)->publisher); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('ISBN')); ?></b></td>
                                                        <td class="py-1"><?php echo e(optional($document->essential)->isbn); ?></td>
                                                    </tr>
                                                <?php elseif(optional($document->essential)->document_type == 'paper_cutting'): ?>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Newspaper Name')); ?></b></td>
                                                        <td class="py-1"><?php echo e(optional($document->essential)->newspaper_name); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Clipping Date')); ?></b></td>
                                                        <td class="py-1"><?php echo e(dateFormat(optional($document->essential)->clipping_date)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Headline')); ?></b></td>
                                                        <td class="py-1"><?php echo e(optional($document->essential)->headline); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Section')); ?></b></td>
                                                        <td class="py-1"><?php echo e(optional($document->essential)->section); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Forwarded To')); ?></b></td>
                                                        <td class="py-1"><?php echo e(optional($document->essential)->forwarded_to); ?></td>
                                                    </tr>
                                                <?php elseif(optional($document->essential)->document_type == 'document'): ?>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Document Category')); ?></b></td>
                                                        <td class="py-1"><?php echo e(optional($document->essential)->doc_category); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('Reference Number')); ?></b></td>
                                                        <td class="py-1"><?php echo e(optional($document->essential)->ref_number); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b><?php echo e(__('File Number')); ?></b></td>
                                                        <td class="py-1"><?php echo e(optional($document->essential)->file_number); ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <tr>
                                                    <td class="text-muted py-1"><b><?php echo e(__('Language')); ?></b></td>
                                                    <td class="py-1"><?php echo e(optional($document->essential)->language); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted py-1"><b><?php echo e(__('Published Year')); ?></b></td>
                                                    <td class="py-1"><?php echo e(optional($document->essential)->published_year); ?></td>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Documents/ldms/resources/views/document/show.blade.php ENDPATH**/ ?>