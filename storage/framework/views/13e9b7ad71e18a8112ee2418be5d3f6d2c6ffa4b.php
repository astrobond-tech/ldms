<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item" aria-current="page"><?php echo e(__('Dashboard')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        var documentByCategoryData = <?php echo json_encode($result['documentByCategory']['data']); ?>;
        var documentByCategory = <?php echo json_encode($result['documentByCategory']['category']); ?>;
        var documentBySubCategoryData = <?php echo json_encode($result['documentBySubCategory']['data']); ?>;
        var documentBySubCategory = <?php echo json_encode($result['documentBySubCategory']['category']); ?>;
    </script>

    <script>
        var options_pie_chart_1 = {
            chart: {
                height: 350,
                type: 'pie'
            },
            labels: documentByCategory,
            series: documentByCategoryData,
            legend: {
                show: true,
                position: 'bottom'
            },
            dataLabels: {
                enabled: true,
                dropShadow: {
                    enabled: false
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var chart_pie_chart_1 = new ApexCharts(document.querySelector('#pie_documentByCategory'), options_pie_chart_1);
        chart_pie_chart_1.render();
    </script>

    <script>
        var options_pie_chart_1 = {
            chart: {
                height: 350,
                type: 'pie'
            },
            labels: documentBySubCategory,
            series: documentBySubCategoryData,
            legend: {
                show: true,
                position: 'bottom'
            },
            dataLabels: {
                enabled: true,
                dropShadow: {
                    enabled: false
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var chart_pie_chart_1 = new ApexCharts(document.querySelector('#pie_documentBySubCategory'), options_pie_chart_1);
        chart_pie_chart_1.render();
    </script>



    <script>
        var eventData = <?php echo json_encode($eventData); ?>;
        // var eventData = [{"title":"1 - Annual Gala Night","start":"2024-09-18","end":"2024-10-16"},{"title":"2 - Weekend Hike Adventure","start":"2024-10-01","end":"2024-09-29"},{"title":"3 - Networking Breakfast","start":"2024-11-02","end":"2024-10-31"},{"title":"4 - Monthly Book Club","start":"2024-11-06","end":"2024-11-03"},{"title":"5 - Family Fun Day","start":"2024-11-10","end":"2024-11-08"},{"title":"6 - First event","start":"2025-06-13","end":"2025-05-16"},{"title":"7 - Tree planting","start":"2025-06-25","end":"2025-06-25"},{"title":"8 - Tree planting","start":"2025-06-25","end":"2025-06-25"},{"title":"8 - TEST","start":"2025-07-12","end":"2025-07-12"}];
    </script>
    <script src="<?php echo e(asset('assets/js/plugins/index.global.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/pages/calendar.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar bg-light-secondary">
                                <i class="ti ti-users f-24"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1"><?php echo e(__('Total Users')); ?></p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo e($result['totalUser']); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar bg-light-warning">
                                <i class="ti ti-package f-24"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1"><?php echo e(__('Total Document')); ?></p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo e($result['totalDocument']); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar bg-light-warning">
                                <i class="ti ti-package f-24"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1"><?php echo e(__('Today Document')); ?></p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo e($result['todayDocument']); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar bg-light-primary">
                                <i class="ti ti-history f-24"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1"><?php echo e(__('Total Category')); ?></p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo e($result['totalCategory']); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar bg-light-danger">
                                <i class="ti ti-credit-card f-24"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1"><?php echo e(__('Total Reminder')); ?></p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo e($result['totalReminder']); ?>

                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar bg-light-danger">
                                <i class="ti ti-credit-card f-24"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1"><?php echo e(__('Today Reminder')); ?></p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo e($result['todayReminder']); ?>

                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar bg-light-danger">
                                <i class="ti ti-file f-24"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1"><?php echo e(__('Total Contact')); ?></p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?php echo e($result['totalContact']); ?>

                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="mb-1"><?php echo e(__('Document By Category')); ?></h5>
                        </div>
                    </div>
                    <div id="pie_documentByCategory"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="mb-1"><?php echo e(__('Document By Category')); ?></h5>
                        </div>
                    </div>
                    <div id="pie_documentBySubCategory"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-1"><?php echo e(__('Reminder')); ?></h5>
                </div>

                <div class="card-body">
                    <div id="calendar" class="calendar"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="calendar-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header justify-content-between align-items-center">
                    <h3 class="calendar-modal-title f-w-600 text-truncate">Modal title</h3>
                    <a href="#" class="avtar avtar-s btn-link-danger btn-pc-default" data-bs-dismiss="modal">
                        <i class="ti ti-x f-20"></i>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-secondary">
                                <i class="ti ti-heading f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><b><?php echo e(__('Title')); ?></b></h5>
                            <p class="pc-event-title text-muted"></p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-danger">
                                <i class="ti ti-calendar-event f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><b><?php echo e(__('Start Date')); ?></b></h5>
                            <p class="pc-event-date text-muted"></p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-info">
                                <i class="ti ti-clock f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><b><?php echo e(__('Start time')); ?></b></h5>
                            <p class="pc-event-time text-muted"></p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <div id="pc_event_show"></div>
                    <div class="flex-grow-1 text-end">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khalid/Desktop/codecanyon-49249517-digital-document-saas-addon/main_file/resources/views/dashboard/index.blade.php ENDPATH**/ ?>