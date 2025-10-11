
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Documents Store')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#"><?php echo e(__('Documents Store')); ?></a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card table-card">
             <div class="card-header d-flex justify-content-between align-items-center">
                <h5><?php echo e(__('Document Store')); ?></h5>
                <div class="col-12 col-md-auto">
                    <form action="" method="get">
                        <div class="d-flex flex-wrap gap-2">
                            
                            <div><?php echo e(Form::date('created_date', null, ['class' => 'form-control'])); ?></div>

                            
                            <div>
                                <button type="submit" class="btn btn-secondary">
                                    <i class="ti ti-search align-text-bottom"></i>
                                </button>
                            </div>

                            
                            <div>
                                <a href="<?php echo e(route('document-store.index')); ?>" class="btn btn-secondary">
                                    <i class="ti ti-refresh align-text-bottom"></i>
                                </a>
                            </div>

                            
                            <?php if(Gate::check('document-store')): ?>
                                <div>
                                    <a href="<?php echo e(route('document-store.create')); ?>" class="btn btn-secondary">
                                        <i class="ti ti-archive"></i>
                                    </a>
                                </div>
                            <?php endif; ?>

                            
                            <div>
                                <a class="btn btn-secondary customModal" href="#!" data-size="lg"
                                   data-url="<?php echo e(route('document-store.create')); ?>"
                                   data-title="<?php echo e(__('Create document')); ?>">
                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                    <?php echo e(__('Create Document')); ?>

                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Document Name')); ?></th>
                                <th><?php echo e(__('File')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th><?php echo e(__('Room No')); ?></th>
                                <th><?php echo e(__('Rack No')); ?></th>
                                <th><?php echo e(__('Shelf No')); ?></th>
                                <th><?php echo e(__('Box No')); ?></th>
                                <th><?php echo e(__('Created By')); ?></th>
                                <th><?php echo e(__('Created At')); ?></th>
                                <?php if(Gate::check('edit document-store') || Gate::check('delete document-store') || Gate::check('show document-store')): ?>
                                    <th class="text-right"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($document->document_name); ?></td>
                                <td>
                                    <?php if($document->{'document-file'}): ?>
                                        <a href="<?php echo e(asset('upload/document/'.$document->{'document-file'})); ?>" target="_blank">View</a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($document->description); ?></td>
                                <td><?php echo e($document->room_no); ?></td>
                                <td><?php echo e($document->rack_no); ?></td>
                                <td><?php echo e($document->shelf_no); ?></td>
                                <td><?php echo e($document->box_no); ?></td>
                                <td><?php echo e(optional($document->createdBy)->name); ?></td>
                                <td><?php echo e(date('d-m-Y', strtotime($document->created_at))); ?></td>
                                <?php if(Gate::check('edit document-store') || Gate::check('delete document-store') || Gate::check('show document-store')): ?>
                                    <td class="text-right">
                                        <div class="d-flex gap-1">
                                            <?php if(Gate::check('show document-store')): ?>
                                                <a href="<?php echo e(route('document-store.show', $document->id)); ?>" class="btn btn-sm btn-info">View</a>
                                            <?php endif; ?>
                                            <?php if(Gate::check('edit document-store')): ?>
                                                <a class="btn btn-sm btn-warning customModal" href="#!" 
                                                   data-size="lg"
                                                   data-url="<?php echo e(route('document-store.edit', $document->id)); ?>"
                                                   data-title="<?php echo e(__('Edit Document')); ?>">
                                                    Edit
                                                </a>
                                            <?php endif; ?>
                                            <?php if(Gate::check('delete document-store')): ?>
                                                <form action="<?php echo e(route('document-store.destroy', $document->id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-danger confirm_dialog">Delete</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php if($documents->isEmpty()): ?>
                        <p class="text-center mt-3"><?php echo e(__('No documents found.')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\bdtech\ldms\resources\views/document_store/index.blade.php ENDPATH**/ ?>