<?php
    $document_type_title = ucwords(str_replace('_', ' ', $document_type ?? 'document'));
    $document_type_route = str_replace('_', '-', $document_type ?? 'document');
?>


<?php $__env->startSection('page-title'); ?>
    <?php echo e(__($document_type_title)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#"><?php echo e(__($document_type_title)); ?></a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2 flex-wrap">
                        <div class="col-12 col-md">
                            <h5><?php echo e(__($document_type_title)); ?></h5>
                        </div>

                        <?php if(Gate::check('create document')): ?>
                            <div class="col-12 col-md-auto">
                                <form action="" method="get">
                                    <div class="d-flex flex-wrap gap-2">
                                        <div><?php echo e(Form::select('category', $category, null, ['class' => 'form-select'])); ?>

                                        </div>
                                        
                                        <div><?php echo e(Form::date('created_date', null, ['class' => 'form-control'])); ?>

                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-secondary">
                                                <i class="ti ti-search align-text-bottom"></i> </button>
                                        </div>
                                        <div>
                                            <a href="<?php echo e(route($document_type_route.'.index')); ?>" class="btn btn-secondary">
                                                <i class="ti ti-refresh align-text-bottom"></i> </a>
                                        </div>
                                        <?php if(Gate::check('archive document')): ?>
                                            <div>
                                                <a href="<?php echo e(route($document_type_route.'.archive.list')); ?>" class="btn btn-secondary">
                                                    <i class="ti ti-archive"></i> </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(Gate::check('create document')): ?>
                                            <div>
                                                <a class="btn btn-secondary customModal" href="#!" data-size="lg"
                                                    data-url="<?php echo e(route($document_type_route.'.create')); ?>"
                                                    data-title="<?php echo e(__('Create')); ?> <?php echo e(__($document_type_title)); ?>">
                                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                                    <?php echo e(__('Create')); ?> <?php echo e(__($document_type_title)); ?>

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
                                    <th><?php echo e(__('Category')); ?></th>
                                    <th><?php echo e(__('Sub Category')); ?></th>
                                    <?php if($document_type == 'book' || $document_type == 'document'): ?>
                                        <th><?php echo e(__('Rack')); ?></th>
                                        <th><?php echo e(__('Room')); ?></th>
                                        <th><?php echo e(__('Shelf')); ?></th>
                                        <th><?php echo e(__('Cabinet')); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e(__('Created By')); ?></th>
                                    <th><?php echo e(__('Created At')); ?></th>
                                    <?php if(Gate::check('edit document') ||
                                            Gate::check('delete document') ||
                                            Gate::check('show document') ||
                                            Gate::check('share documents')): ?>
                                        <th class="text-right"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr role="row">
                                        <td><?php echo e($document->name); ?></td>
                                        <td><?php echo e(!empty($document->category) ? $document->category->title : '-'); ?></td>
                                        <td><?php echo e(!empty($document->subCategory) ? $document->subCategory->title : '-'); ?></td>
                                        <?php if($document_type == 'book' || $document_type == 'document'): ?>
                                            <td><?php echo e(optional($document->essential)->rack ?? '-'); ?></td>
                                            <td><?php echo e(optional($document->essential)->room ?? '-'); ?></td>
                                            <td><?php echo e(optional($document->essential)->shelf ?? '-'); ?></td>
                                            <td><?php echo e(optional($document->essential)->cabinet ?? '-'); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e(!empty($document->createdBy) ? $document->createdBy->name : ''); ?></td>
                                        <td><?php echo e(dateFormat($document->created_at)); ?></td>
                                        <?php if(Gate::check('edit document') ||
                                                Gate::check('delete document') ||
                                                Gate::check('show document') ||
                                                Gate::check('share documents')): ?>
                                            <td class="text-right">
                                                <div class="cart-action">
                                                    <?php echo Form::open(['method' => 'get', 'route' => [$document_type_route.'.archive', encrypt($document->id)], 'class' => 'd-inline']); ?>

                                                    <?php if(Gate::check('archive document')): ?>
                                                        <a class="avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                                            data-dialog-title = "<?php echo e(__('Are you sure you want to archive this record ?')); ?>"
                                                            data-dialog-text = "<?php echo e(__('This record will be archived and can be restored later. Do you want to proceed?')); ?>"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="<?php echo e(__('archive')); ?>" href="#!" > <i
                                                                class="fas fa-archive" style="font-size: 20px"></i></a>
                                                    <?php endif; ?>
                                                    <?php echo Form::close(); ?>

                                                    <?php if(Gate::check('share documents') && $document->LastVersion): ?>
                                                        <a class="avtar avtar-xs btn-link-info text-secondary customModal"
                                                            data-bs-toggle="tooltip" data-size="md"
                                                            data-bs-original-title="<?php echo e(__('Share')); ?>" href="#!"
                                                            data-url="<?php echo e(route($document_type_route.'.Sharelink', encrypt($document->id))); ?>"
                                                            data-title="<?php echo e(__($document_type_title . ' Share')); ?>"> <i
                                                                data-feather="link"></i></a>
                                                    <?php endif; ?>
                                                    <?php if(Gate::check('show document')): ?>
                                                        <a class="avtar avtar-xs btn-link-warning text-warning"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="<?php echo e(__('Show Details')); ?>"
                                                            href="<?php echo e(route($document_type_route.'.show', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>">
                                                            <i data-feather="eye"></i></a>
                                                    <?php endif; ?>
                                                    <?php if(Gate::check('edit document')): ?>
                                                        <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                            data-bs-toggle="tooltip" data-size="lg"
                                                            data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#!"
                                                            data-url="<?php echo e(route('document.edit', encrypt($document->id))); ?>"
                                                            data-title="<?php echo e(__('Edit Support')); ?>"> <i
                                                                data-feather="edit"></i></a>
                                                    <?php endif; ?>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['document.destroy', encrypt($document->id)], 'class' => 'd-inline']); ?>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Documents/ldms/resources/views/document/index.blade.php ENDPATH**/ ?>