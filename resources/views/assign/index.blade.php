@extends('layouts.app')
@section('page-title')
    {{__('Assign Document')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#">{{ __('Assign Document') }}</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2 flex-wrap">
                        <div class="col-12 col-md">
                            <h5>{{ __('Assigned Documents') }}</h5>
                        </div>
                        <div class="col-12 col-md-auto">
                            <a class="btn btn-secondary customModal" href="#!" data-size="lg"
                                data-url="{{ route('assign.create') }}"
                                data-title="{{ __('Assign Document') }}">
                                <i class="ti ti-circle-plus align-text-bottom"></i>
                                {{ __('Add Assign') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Client') }}</th>
                                    <th>{{ __('Document') }}</th>
                                    <th>{{ __('Issued By') }}</th>
                                    <th>{{ __('Issue Date') }}</th>
                                    <th>{{ __('Due Date') }}</th>
                                    <th>{{ __('Issued') }}</th>
                                    <th>{{ __('Returned') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="text-right">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignedDocuments as $assigned)
                                    <tr role="row">
                                        <td>{{ optional($assigned->user)->name }}</td>
                                        <td>{{ optional($assigned->document)->name }}</td>
                                        <td>{{ optional($assigned->issuer)->name }}</td>
                                        <td>{{ dateFormat($assigned->issue_date) }}</td>
                                        <td>{{ dateFormat($assigned->due_date) }}</td>
                                        <td>{{ $assigned->quantity }}</td>
                                        <td>{{ $assigned->returned_quantity }}</td>
                                        <td><span class="badge bg-success">{{ $assigned->status }}</span></td>
                                        <td class="text-right">
                                            <a class="avtar avtar-xs btn-link-info text-secondary customModal"
                                                data-bs-toggle="tooltip" data-size="md"
                                                data-bs-original-title="{{ __('Return') }}" href="#!"
                                                data-url="{{ route('assign.return', $assigned->id) }}"
                                                data-title="{{ __('Return Document') }}">
                                                <i data-feather="corner-up-left"></i>
                                            </a>
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
