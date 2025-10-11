<?php
    $document_type_title = ucwords(str_replace('_', ' ', $document_type ?? 'document'));
    $document_type_route = str_replace('_', '-', $document_type ?? 'document');
?>


<?php $__env->startSection('page-title'); ?>
    <?php echo e(__($document_type_title)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#"><?php echo e(__($document_type_title)); ?></a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('card-action-btn'); ?>
    <?php if(Gate::check('create my document')): ?>
        <a class="btn btn-secondary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="<?php echo e(route($document_type_route.'.create')); ?>"
           data-title="<?php echo e(__('Create')); ?> <?php echo e(__($document_type_title)); ?>"> <i class="ti-plus mr-5"></i><?php echo e(__('Create')); ?> <?php echo e(__($document_type_title)); ?></a>
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
                            <?php echo e(__($document_type_title)); ?>

                        </h5>
                    </div>
                    
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
                                <th><?php echo e(__('Expired At')); ?></th>
                                <?php if(Gate::check('edit my document') || Gate::check('delete my document') || Gate::check('show my document')): ?>
                                    <th class="text-right"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr role="row">
                                    <td><?php echo e($document->name); ?></td>
                                    <td>
                                        <?php echo e(!empty($document->category) ? $document->category->title : '-'); ?>

                                    </td>
                                    <td>
                                        <?php echo e(!empty($document->subCategory) ? $document->subCategory->title : '-'); ?>

                                    </td>
                                    <?php if($document_type == 'book' || $document_type == 'document'): ?>
                                        <td><?php echo e(optional($document->essential)->rack ?? '-'); ?></td>
                                        <td><?php echo e(optional($document->essential)->room ?? '-'); ?></td>
                                        <td><?php echo e(optional($document->essential)->shelf ?? '-'); ?></td>
                                        <td><?php echo e(optional($document->essential)->cabinet ?? '-'); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(!empty($document->createdBy) ? $document->createdBy->name : ''); ?></td>
                                    <td><?php echo e(dateFormat($document->created_at)); ?></td>
                                    <td><?php echo e(dateFormat($document->created_at)); ?></td>
                                    <?php if(Gate::check('edit my document') || Gate::check('delete my document') || Gate::check('show my document')): ?>
                                        <td class="text-right">
                                            <div class="cart-action">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => [$document_type_route.'.destroy', encrypt($document->id)]]); ?>

                                                <?php if(Gate::check('show my document')): ?>
                                                    <a class="avtar avtar-xs btn-link-warning text-warning" data-bs-toggle="tooltip"
                                                        data-bs-original-title="<?php echo e(__('Show Details')); ?>"
                                                        href="<?php echo e(route($document_type_route.'.show', \Illuminate\Support\Facades\Crypt::encrypt($document->id))); ?>">
                                                        <i data-feather="eye"></i></a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Documents/ldms/resources/views/document/own.blade.php ENDPATH**/ ?>