@extends('layouts.app')

@section('page-title')
    {{ __('Paper Cutting') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#">{{ __('Paper Cutting') }}</a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card table-card">
            <div class="card-header">
                <div class="row align-items-center g-2 flex-wrap">
                    <div class="col-12 col-md">
                        <h5>{{ __('Paper Cutting') }}</h5>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex flex-wrap gap-2">
                            <div>
                                <a class="btn btn-secondary customModal" href="#!" data-size="lg"
                                   data-url="{{ route('paper-cutting.create') }}"
                                   data-title="{{ __('Create Paper Cutting') }}">
                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Paper Cutting') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="dt-responsive table-responsive">
                    <table class="table table-hover advance-datatable">
                        <thead>
                            <tr>
                                <th>{{ __('Paper Name') }}</th>
                                <th>{{ __('Room No') }}</th>
                                <th>{{ __('Rack No') }}</th>
                                <th>{{ __('Shelf No') }}</th>
                                <th>{{ __('Box No') }}</th>
                                <th>{{ __('Created By') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th class="text-right">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paperCuttings as $paper)
                            <tr>
                                <td>{{ $paper->paper_name }}</td>
                                <td>{{ $paper->room_no ?? '-' }}</td>
                                <td>{{ $paper->rack_no ?? '-' }}</td>
                                <td>{{ $paper->shelf_no ?? '-' }}</td>
                                <td>{{ $paper->box_no ?? '-' }}</td>
                                <td>{{ optional($paper->createdBy)->name }}</td>
                                <td>{{ dateFormat($paper->created_at) }}</td>
                                <td class="text-right">
                                    <div class="cart-action">
                                        <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                           data-bs-toggle="tooltip" data-size="lg"
                                           data-bs-original-title="{{ __('Edit') }}" href="#!"
                                           data-url="{{ route('paper-cutting.edit', encrypt($paper->id)) }}"
                                           data-title="{{ __('Edit Paper Cutting') }}">
                                           <i data-feather="edit"></i>
                                        </a>

                                        {!! Form::open(['method' => 'DELETE', 'route' => ['paper-cutting.destroy', encrypt($paper->id)], 'class' => 'd-inline']) !!}
                                        <a class="avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                           data-bs-toggle="tooltip"
                                           data-bs-original-title="{{ __('Delete') }}" href="#">
                                           <i data-feather="trash-2"></i>
                                        </a>
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
