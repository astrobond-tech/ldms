@extends('layouts.app')

@section('page-title')
    {{ __('Book Assign') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#">{{ __('Book Assign') }}</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2 flex-wrap">
                        <div class="col-12 col-md">
                            <h5>{{ __('Book Assign') }}</h5>
                        </div>

                        @if (Gate::check('create book-assign'))
                            <div class="col-12 col-md-auto">
                                <form action="" method="get">
                                    <div class="d-flex flex-wrap gap-2">
                                        <div>{{ Form::date('created_date', null, ['class' => 'form-control']) }}</div>
                                        <div>
                                            <button type="submit" class="btn btn-secondary">
                                                <i class="ti ti-search align-text-bottom"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <a href="{{ route('book-assign.index') }}" class="btn btn-secondary">
                                                <i class="ti ti-refresh align-text-bottom"></i>
                                            </a>
                                        </div>
                                        @if (Gate::check('archive book-assign'))
                                            <div>
                                                <a href="{{ route('book-assign.archive.list') }}" class="btn btn-secondary">
                                                    <i class="ti ti-archive"></i>
                                                </a>
                                            </div>
                                        @endif
                                        <div>
                                            <a class="btn btn-secondary customModal" href="#!" data-size="lg"
                                               data-url="{{ route('book-assign.create') }}"
                                               data-title="{{ __('Create Book Assign') }}">
                                                <i class="ti ti-circle-plus align-text-bottom"></i>
                                                {{ __('Create Book Assign') }}
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Assigned To') }}</th>
                                    <th>{{ __('Room No') }}</th>
                                    <th>{{ __('Rack No') }}</th>
                                    <th>{{ __('Shelf No') }}</th>
                                    <th>{{ __('Box No') }}</th>
                                    <th>{{ __('Created By') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    @if (Gate::check('edit book-assign') ||
                                         Gate::check('delete book-assign') ||
                                         Gate::check('show book-assign'))
                                        <th class="text-right">{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookAssigns as $book)
                                    <tr role="row">
                                        <td>{{ $book->name }}</td>
                                        <td>{{ optional($book->assignTo)->name }}</td>
                                        <td>{{ $book->room_no ?? '-' }}</td>
                                        <td>{{ $book->rack_no ?? '-' }}</td>
                                        <td>{{ $book->shelf_no ?? '-' }}</td>
                                        <td>{{ $book->box_no ?? '-' }}</td>
                                        <td>{{ optional($book->createdBy)->name }}</td>
                                        <td>{{ dateFormat($book->created_at) }}</td>
                                        @if (Gate::check('edit book-assign') ||
                                             Gate::check('delete book-assign') ||
                                             Gate::check('show book-assign'))
                                            <td class="text-right">
                                                <div class="cart-action">
                                                    @if (Gate::check('show book-assign'))
                                                        <a class="avtar avtar-xs btn-link-warning text-warning"
                                                           data-bs-toggle="tooltip"
                                                           data-bs-original-title="{{ __('Show Details') }}"
                                                           href="{{ route('book-assign.show', \Illuminate\Support\Facades\Crypt::encrypt($book->id)) }}">
                                                           <i data-feather="eye"></i>
                                                        </a>
                                                    @endif

                                                    @if (Gate::check('edit book-assign'))
                                                        <a class="avtar avtar-xs btn-link-secondary text-secondary customModal"
                                                           data-bs-toggle="tooltip" data-size="lg"
                                                           data-bs-original-title="{{ __('Edit') }}" href="#!"
                                                           data-url="{{ route('book-assign.edit', encrypt($book->id)) }}"
                                                           data-title="{{ __('Edit Book Assign') }}">
                                                           <i data-feather="edit"></i>
                                                        </a>
                                                    @endif

                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['book-assign.destroy', encrypt($book->id)], 'class' => 'd-inline']) !!}
                                                    @if (Gate::check('delete book-assign'))
                                                        <a class="avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                                           data-bs-toggle="tooltip"
                                                           data-bs-original-title="{{ __('Delete') }}" href="#">
                                                           <i data-feather="trash-2"></i>
                                                        </a>
                                                    @endif
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        @endif
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
