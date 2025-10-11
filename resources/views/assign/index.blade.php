@extends('layouts.app')
@section('page-title')
    {{__('Assign')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#">{{ __('Assign') }}</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2 flex-wrap">
                        <div class="col-12 col-md">
                            <h5>{{ __('Assigned documents, book and paper cutting') }}</h5>
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
                    <div class="row align-items-center g-2 flex-wrap mt-2">
                        <div class="col-12">
                            <form action="{{ route('assign.index') }}" method="GET">
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="form-group mb-0">
                                        <input type="text" name="client_name" class="form-control" value="{{ request('client_name') }}" placeholder="{{ __('Client Name') }}">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="text" name="document_name" class="form-control" value="{{ request('document_name') }}" placeholder="{{ __('File Name') }}">
                                    </div>
                                    <div class="form-group mb-0">
                                        <select class="form-control" name="due_date_range">
                                            <option value="">{{ __('Select Due Date Range') }}</option>
                                            <option value="today" @if(request('due_date_range') == 'today') selected @endif>{{ __('Due Today') }}</option>
                                            <option value="tomorrow" @if(request('due_date_range') == 'tomorrow') selected @endif>{{ __('Due Tomorrow') }}</option>
                                            <option value="next_7_days" @if(request('due_date_range') == 'next_7_days') selected @endif>{{ __('Due in Next 7 Days') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="date" name="issue_date" class="form-control" value="{{ request('issue_date') }}" placeholder="{{ __('Issue Date') }}">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="date" name="due_date" class="form-control" value="{{ request('due_date') }}" placeholder="{{ __('Due Date') }}">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="ti ti-search align-text-bottom"></i> {{ __('Filter') }}
                                        </button>
                                    </div>
                                    <div>
                                        <a href="{{ route('assign.index') }}" class="btn btn-danger">
                                            <i class="ti ti-refresh align-text-bottom"></i> {{ __('Reset') }}
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
                                    <th>{{ __('Client') }}</th>
                                    <th>{{ __('File Name') }}</th>
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
