

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Book Assign')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#"><?php echo e(__('Book Assign')); ?></a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2 flex-wrap">
                        <div class="col-12 col-md">
                            <h5><?php echo e(__('Book Assign')); ?></h5>
                        </div>
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
											<a href="<?php echo e(route('book-assign.index')); ?>" class="btn btn-secondary">
												<i class="ti ti-refresh align-text-bottom"></i>
											</a>
										</div>
										<div>
											<a href="<?php echo e(route('book-assign.archive.list')); ?>" class="btn btn-secondary">
												<i class="ti ti-archive"></i>
											</a>
										</div>
										<div>
											<a class="btn btn-secondary customModal" href="#!"
											   data-size="lg"
											   data-url="<?php echo e(route('book-assign.create')); ?>"
											   data-title="<?php echo e(__('Create Book Assign')); ?>">
												<i class="ti ti-circle-plus align-text-bottom"></i>
												<?php echo e(__('Create Book Assign')); ?>

											</a>
										</div>
									</div>
								</form>
							</div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Assigned To')); ?></th>
                                    <th><?php echo e(__('Room No')); ?></th>
                                    <th><?php echo e(__('Rack No')); ?></th>
                                    <th><?php echo e(__('Shelf No')); ?></th>
                                    <th><?php echo e(__('Box No')); ?></th>
                                    <th><?php echo e(__('Created By')); ?></th>
                                    <th><?php echo e(__('Created At')); ?></th>
                                    <?php if(Gate::check('edit book-assign') ||
                                         Gate::check('delete book-assign') ||
                                         Gate::check('show book-assign')): ?>
                                        <th class="text-right"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bookAssigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr role="row">
                                        <td><?php echo e($book->name); ?></td>
                                        <td><?php echo e(optional($book->assignTo)->name); ?></td>
                                        <td><?php echo e($book->room_no ?? '-'); ?></td>
                                        <td><?php echo e($book->rack_no ?? '-'); ?></td>
                                        <td><?php echo e($book->shelf_no ?? '-'); ?></td>
                                        <td><?php echo e($book->box_no ?? '-'); ?></td>
                                        <td><?php echo e(optional($book->createdBy)->name); ?></td>
                                        <td><?php echo e(dateFormat($book->created_at)); ?></td>
                                        <?php if(Gate::check('edit book-assign') ||
                                             Gate::check('delete book-assign') ||
                                             Gate::check('show book-assign')): ?>
                                            <td class="text-right">
                                                <div class="cart-action">
                                                    <?php if(Gate::check('show book-assign')): ?>
                                                        <a class="avtar avtar-xs btn-link-warning text-warning"
                                                           data-bs-toggle="tooltip"
                                                           data-bs-original-title="<?php echo e(__('Show Details')); ?>"
                                                           href="<?php echo e(route('book-assign.show', \Illuminate\Support\Facades\Crypt::encrypt($book->id))); ?>">
                                                           <i data-feather="eye"></i>
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if(Gate::check('edit book-assign')): ?>
                                                        <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                           data-bs-toggle="tooltip" data-size="lg"
                                                           data-bs-original-title="<?php echo e(__('Edit')); ?>" href="#!"
                                                           data-url="<?php echo e(route('book-assign.edit', encrypt($book->id))); ?>"
                                                           data-title="<?php echo e(__('Edit Book Assign')); ?>">
                                                           <i data-feather="edit"></i>
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['book-assign.destroy', encrypt($book->id)], 'class' => 'd-inline']); ?>

                                                    <?php if(Gate::check('delete book-assign')): ?>
                                                        <a class="avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                                           data-bs-toggle="tooltip"
                                                           data-bs-original-title="<?php echo e(__('Delete')); ?>" href="#">
                                                           <i data-feather="trash-2"></i>
                                                        </a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\bdtech\ldms\resources\views/book_assign/index.blade.php ENDPATH**/ ?>