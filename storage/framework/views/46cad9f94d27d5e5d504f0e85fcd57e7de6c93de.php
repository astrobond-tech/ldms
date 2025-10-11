

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Book Store')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#"><?php echo e(__('Book Store')); ?></a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card table-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><?php echo e(__('Book Store')); ?></h5>
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
                                <a href="<?php echo e(route('book-store.index')); ?>" class="btn btn-secondary">
                                    <i class="ti ti-refresh align-text-bottom"></i>
                                </a>
                            </div>

                            
                            <?php if(Gate::check('archive book-store')): ?>
                                <div>
                                    <a href="<?php echo e(route('book-store.archive.list')); ?>" class="btn btn-secondary">
                                        <i class="ti ti-archive"></i>
                                    </a>
                                </div>
                            <?php endif; ?>

                            
                            <div>
                                <a class="btn btn-secondary customModal" href="#!" data-size="lg"
                                   data-url="<?php echo e(route('book-store.create')); ?>"
                                   data-title="<?php echo e(__('Create Book')); ?>">
                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                    <?php echo e(__('Create Book')); ?>

                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="dt-responsive table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Book Name')); ?></th>
                                <th><?php echo e(__('Availability')); ?></th>
                                <th><?php echo e(__('File')); ?></th>
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
                            <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <span title="<?php echo e($book->description ?? '-'); ?>">
                                        <?php echo e(Str::limit($book->book_name, 30)); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php if($book->availability_type === 'offline'): ?>
                                        <span class="badge badge-secondary"><?php echo e(__('Offline')); ?></span>
                                    <?php elseif($book->availability_type === 'online'): ?>
                                        <span class="badge badge-info"><?php echo e(__('Online')); ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-primary"><?php echo e(__('Both')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!empty($book->{'book-file'})): ?>
                                        <a href="<?php echo e(route('book-store.view-file', $book->id)); ?>"
                                           class="btn btn-sm btn-danger"
                                           target="_blank"
                                           title="<?php echo e(__('View PDF')); ?>">
                                            <i class="ti ti-file-pdf"></i> PDF
                                        </a>
                                    <?php else: ?>
                                        <span class="badge badge-light"><?php echo e(__('No File')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($book->room_no ?? '-'); ?></td>
                                <td><?php echo e($book->rack_no ?? '-'); ?></td>
                                <td><?php echo e($book->shelf_no ?? '-'); ?></td>
                                <td><?php echo e($book->box_no ?? '-'); ?></td>
                                <td><?php echo e(optional($book->createdByUser)->name ?? optional($book->createdByUser)->first_name); ?></td>
                                <td><?php echo e($book->created_at->format('d M, Y')); ?></td>
                                <td class="text-right">
                                    <div class="cart-action d-flex justify-content-end gap-2">
                                        <a class="btn btn-sm btn-warning customModal"
                                           href="#!"
                                           data-size="lg"
                                           data-url="<?php echo e(route('book-store.edit', $book->id)); ?>"
                                           data-title="<?php echo e(__('Edit Book')); ?>">
                                           <i data-feather="edit"></i>
                                        </a>

                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['book-store.destroy', $book->id], 'class' => 'd-inline']); ?>

                                            <button type="submit" class="btn btn-sm btn-danger confirm_dialog">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        <?php echo Form::close(); ?>

                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php if($books->isEmpty()): ?>
                        <p class="text-center mt-3"><?php echo e(__('No books found.')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\bdtech\ldms\resources\views/book_store/index.blade.php ENDPATH**/ ?>