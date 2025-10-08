@extends('layouts.app')

@section('page-title')
    {{ __('Book Store') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#">{{ __('Book Store') }}</a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card table-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>{{ __('Book Store') }}</h5>
                <div class="col-12 col-md-auto">
                    <form action="" method="get">
                        <div class="d-flex flex-wrap gap-2">
                            {{-- Date filter (optional) --}}
                            <div>{{ Form::date('created_date', null, ['class' => 'form-control']) }}</div>

                            {{-- Search button --}}
                            <div>
                                <button type="submit" class="btn btn-secondary">
                                    <i class="ti ti-search align-text-bottom"></i>
                                </button>
                            </div>

                            {{-- Refresh button --}}
                            <div>
                                <a href="{{ route('book-store.index') }}" class="btn btn-secondary">
                                    <i class="ti ti-refresh align-text-bottom"></i>
                                </a>
                            </div>

                            {{-- Archive button (if user has permission) --}}
                            @if (Gate::check('archive book-store'))
                                <div>
                                    <a href="{{ route('book-store.archive.list') }}" class="btn btn-secondary">
                                        <i class="ti ti-archive"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Create button --}}
                            <div>
                                <a class="btn btn-secondary customModal" href="#!" data-size="lg"
                                   data-url="{{ route('book-store.create') }}"
                                   data-title="{{ __('Create Book') }}">
                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Book') }}
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
                                <th>{{ __('Book Name') }}</th>
                                <th>{{ __('Availability') }}</th>
                                <th>{{ __('File') }}</th>
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
                            @foreach ($books as $book)
                            <tr>
                                <td>
                                    <span title="{{ $book->description ?? '-' }}">
                                        {{ Str::limit($book->book_name, 30) }}
                                    </span>
                                </td>
                                <td>
                                    @if($book->availability_type === 'offline')
                                        <span class="badge badge-secondary">{{ __('Offline') }}</span>
                                    @elseif($book->availability_type === 'online')
                                        <span class="badge badge-info">{{ __('Online') }}</span>
                                    @else
                                        <span class="badge badge-primary">{{ __('Both') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($book->{'book-file'}))
                                        <a href="{{ route('book-store.view-file', $book->id) }}"
                                           class="btn btn-sm btn-danger"
                                           target="_blank"
                                           title="{{ __('View PDF') }}">
                                            <i class="ti ti-file-pdf"></i> PDF
                                        </a>
                                    @else
                                        <span class="badge badge-light">{{ __('No File') }}</span>
                                    @endif
                                </td>
                                <td>{{ $book->room_no ?? '-' }}</td>
                                <td>{{ $book->rack_no ?? '-' }}</td>
                                <td>{{ $book->shelf_no ?? '-' }}</td>
                                <td>{{ $book->box_no ?? '-' }}</td>
                                <td>{{ optional($book->createdByUser)->name ?? optional($book->createdByUser)->first_name }}</td>
                                <td>{{ $book->created_at->format('d M, Y') }}</td>
                                <td class="text-right">
                                    <div class="cart-action d-flex justify-content-end gap-2">
                                        <a class="btn btn-sm btn-warning customModal"
                                           href="#!"
                                           data-size="lg"
                                           data-url="{{ route('book-store.edit', $book->id) }}"
                                           data-title="{{ __('Edit Book') }}">
                                           <i data-feather="edit"></i>
                                        </a>

                                        {!! Form::open(['method' => 'DELETE', 'route' => ['book-store.destroy', $book->id], 'class' => 'd-inline']) !!}
                                            <button type="submit" class="btn btn-sm btn-danger confirm_dialog">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($books->isEmpty())
                        <p class="text-center mt-3">{{ __('No books found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
