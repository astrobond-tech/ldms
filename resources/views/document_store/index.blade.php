@extends('layouts.app')
@section('page-title')
    {{ __('Documents Store') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        <a href="#">{{ __('Documents Store') }}</a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card table-card">
             <div class="card-header d-flex justify-content-between align-items-center">
                <h5>{{ __('Document Store') }}</h5>
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
                                <a href="{{ route('document-store.index') }}" class="btn btn-secondary">
                                    <i class="ti ti-refresh align-text-bottom"></i>
                                </a>
                            </div>

                            {{-- Archive button (if user has permission) --}}
                            @if (Gate::check('document-store'))
                                <div>
                                    <a href="{{ route('document-store.create') }}" class="btn btn-secondary">
                                        <i class="ti ti-archive"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Create button --}}
                            <div>
                                <a class="btn btn-secondary customModal" href="#!" data-size="lg"
                                   data-url="{{ route('document-store.create') }}"
                                   data-title="{{ __('Create document') }}">
                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Create Document') }}
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
                                <th>{{ __('Document Name') }}</th>
                                <th>{{ __('File') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Room No') }}</th>
                                <th>{{ __('Rack No') }}</th>
                                <th>{{ __('Shelf No') }}</th>
                                <th>{{ __('Box No') }}</th>
                                <th>{{ __('Created By') }}</th>
                                <th>{{ __('Created At') }}</th>
                                @if(Gate::check('edit document-store') || Gate::check('delete document-store') || Gate::check('show document-store'))
                                    <th class="text-right">{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $document)
                            <tr>
                                <td>{{ $document->document_name }}</td>
                                <td>
                                    @if($document->{'document-file'})
                                        <a href="{{ asset('upload/document/'.$document->{'document-file'}) }}" target="_blank">View</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $document->description }}</td>
                                <td>{{ $document->room_no }}</td>
                                <td>{{ $document->rack_no }}</td>
                                <td>{{ $document->shelf_no }}</td>
                                <td>{{ $document->box_no }}</td>
                                <td>{{ optional($document->createdBy)->name }}</td>
                                <td>{{ date('d-m-Y', strtotime($document->created_at)) }}</td>
                                @if(Gate::check('edit document-store') || Gate::check('delete document-store') || Gate::check('show document-store'))
                                    <td class="text-right">
                                        <div class="d-flex gap-1">
                                            @if(Gate::check('show document-store'))
                                                <a href="{{ route('document-store.show', $document->id) }}" class="btn btn-sm btn-info">View</a>
                                            @endif
                                            @if(Gate::check('edit document-store'))
                                                <a class="btn btn-sm btn-warning customModal" href="#!" 
                                                   data-size="lg"
                                                   data-url="{{ route('document-store.edit', $document->id) }}"
                                                   data-title="{{ __('Edit Document') }}">
                                                    Edit
                                                </a>
                                            @endif
                                            @if(Gate::check('delete document-store'))
                                                <form action="{{ route('document-store.destroy', $document->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger confirm_dialog">Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($documents->isEmpty())
                        <p class="text-center mt-3">{{ __('No documents found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
