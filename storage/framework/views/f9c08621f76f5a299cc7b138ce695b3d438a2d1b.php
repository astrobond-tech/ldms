<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Document Archive')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="<?php echo e(route('document.index')); ?>"><?php echo e(__('Document')); ?></a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#"><?php echo e(__('Archive')); ?></a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2 flex-wrap">
                        <div class="col-12 col-md">
                            <h5><?php echo e(__('Document')); ?></h5>
                        </div>

                        <?php if(Gate::check('create document')): ?>
                            <div class="col-12 col-md-auto">
                                <form action="" method="get">
                                    <div class="d-flex flex-wrap gap-2">
                                        <div><?php echo e(Form::select('category', $category, null, ['class' => 'form-select'])); ?>

                                        </div>
                                        <div><?php echo e(Form::select('stages', $stages, null, ['class' => 'form-select'])); ?></div>
                                        <div><?php echo e(Form::date('created_date', null, ['class' => 'form-control'])); ?>

                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-secondary">
                                                <i class="ti ti-search align-text-bottom"></i> </button>
                                        </div>
                                        <div>
                                            <a href="<?php echo e(route('document.archive')); ?>" class="btn btn-secondary">
                                                <i class="ti ti-refresh align-text-bottom"></i> </a>
                                        </div>
                                        <?php if(Gate::check('archive document')): ?>
                                            <div>
                                                <a href="<?php echo e(route('document.index')); ?>" class="btn btn-secondary">
                                                    <i class="ti ti-archive"></i> </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(Gate::check('create document')): ?>
                                            <div>
                                                <a class="btn btn-secondary customModal" href="#!" data-size="lg"
                                                    data-url="<?php echo e(route('document.create')); ?>"
                                                    data-title="<?php echo e(__('Create Document')); ?>">
                                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                                    <?php echo e(__('Create Document')); ?>

                                                </a>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Assigned To')); ?></th>
                                    <th><?php echo e(__('Category')); ?></th>
                                    <th><?php echo e(__('Sub Category')); ?></th>
                                    <th><?php echo e(__('Tags')); ?></th>
                                    <th><?php echo e(__('Stage')); ?></th>
                                    <th><?php echo e(__('Created By')); ?></th>
                                    <th><?php echo e(__('Created At')); ?></th>
                                    <?php if(Gate::check('delete document') ||
                                            Gate::check('archive document')): ?>
                                        <th class="text-right"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr role="row">
                                        <td><?php echo e($document->name); ?></td>
                                        <td><?php echo e(optional($document->AssignTo)->name); ?></td>
                                        <td><?php echo e(!empty($document->category) ? $document->category->title : '-'); ?></td>
                                        <td><?php echo e(!empty($document->subCategory) ? $document->subCategory->title : '-'); ?></td>
                                        <td>
                                            <?php $__currentLoopData = $document->tags(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($tag->title); ?> <br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($document->StageData)): ?>
                                                <span class="d-inline badge text-bg-success"
                                                    style="background-color: <?php echo e(optional($document->StageData)->color); ?> !important"><?php echo e(optional($document->StageData)->title); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(!empty($document->createdBy) ? $document->createdBy->name : ''); ?></td>
                                        <td><?php echo e(dateFormat($document->created_at)); ?></td>
                                        <?php if(Gate::check('delete document') ||
                                            Gate::check('archive document')): ?>
                                            <td class="text-right">
                                                <div class="cart-action">
                                                    <?php echo Form::open(['method' => 'get', 'route' => ['unarchive', encrypt($document->id)], 'class' => 'd-inline']); ?>

                                                    <?php if(Gate::check('archive document')): ?>
                                                        <a class="avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                                            data-dialog-title = "<?php echo e(__('Are you sure you want to unarchive this record ?')); ?>"
                                                            data-dialog-text = "<?php echo e(__('Do you want to proceed?')); ?>"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="<?php echo e(__('unarchived')); ?>" href="#!"> <i
                                                                class="fas fa-archive" style="font-size: 20px"></i></a>
                                                    <?php endif; ?>
                                                    <?php echo Form::close(); ?>

                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['document.destroy', $document->id], 'class' => 'd-inline']); ?>

                                                    <?php if(Gate::check('delete document')): ?>
                                                        <a class="avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                                            data-bs-toggle="tooltip"
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Documents/ldms/resources/views/document/archive.blade.php ENDPATH**/ ?>