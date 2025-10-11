@php
    $document_type_title = ucwords(str_replace('_', ' ', $document_type ?? 'document'));
    $document_type_route = str_replace('_', '-', $document_type ?? 'document');
@endphp

@extends('layouts.app')
@section('page-title')
    {{__($document_type_title . ' Details')}}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route($document_type_route.'.index')}}">{{__($document_type_title)}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Details')}}</a>
        </li>
    </ul>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('document.main')
                    <div class="col-lg-9">
                        <div class="email-body">
                            <div class="card">
                                <div class="">
                                    <div class="row align-items-center g-2">
                                        <div class="col">
                                            <h5>{{ __('Basic Details') }}</h5>
                                        </div>
                                        <div class="col-auto">
                                            @if (Gate::check('edit document'))
                                                <a class="btn btn-secondary" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Preview') }}"
                                                    href="{{ !empty($latestVersion->document) ? fetch_file($latestVersion->document,'upload/document/') : '#' }}"
                                                    target="_blank"><i data-feather="maximize"> </i></a>
                                            @endif
                                            @if (Gate::check('download document'))
                                                <a class="btn btn-secondary" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Download') }}"
                                                    href="{{ !empty($latestVersion->document) ? fetch_file($latestVersion->document,'upload/document/') : '#' }}" download><i
                                                        data-feather="download"> </i></a>
                                            @endif
                                            @if (Gate::check('edit document'))
                                                <a class="btn btn-secondary customModal" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Edit') }}" href="#"
                                                    data-url="{{ route($document_type_route.'.edit', encrypt($document->id)) }}"
                                                    data-title="{{ __('Edit Support') }}"> <i
                                                        data-feather="edit"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __($document_type_title . ' Name') }}</b></td>
                                                        <td class="py-1">{{ $document->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Category') }}</b></td>
                                                        <td class="py-1">
                                                            {{ !empty($document->category) ? $document->category->title : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Sub Category') }}</b></td>
                                                        <td class="py-1">
                                                            {{ !empty($document->subCategory) ? $document->subCategory->title : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Created By') }}</b></td>
                                                        <td class="py-1">
                                                            {{ !empty($document->createdBy) ? $document->createdBy->name : '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Created At') }}</b></td>
                                                        <td class="py-1">{{ dateFormat($document->created_at) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Tags') }}</b></td>
                                                        <td class="py-1">
                                                            @foreach ($document->tags() as $tag)
                                                                {{ $tag->title }},
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Description') }}</b></td>
                                                        <td class="py-1">{{ $document->description }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{ __('Essential Details') }}</h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tbody>

                                                <tr>
                                                    <td class="text-muted py-1"><b>{{ __('Total Copies') }}</b></td>
                                                    <td class="py-1">{{ optional($document->essential)->copies_total }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted py-1"><b>{{ __('Available Copies') }}</b></td>
                                                    <td class="py-1">{{ optional($document->essential)->copies_available }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted py-1"><b>{{ __('Location') }}</b></td>
                                                    <td class="py-1">{{ optional($document->essential)->room }}, {{ optional($document->essential)->cabinet }}, {{ optional($document->essential)->rack }}, {{ optional($document->essential)->shelf }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted py-1"><b>{{ __('Responsible Person') }}</b></td>
                                                    <td class="py-1">{{ optional(optional($document->essential)->responsiblePerson)->name }}</td>
                                                </tr>
                                                @if(optional($document->essential)->document_type == 'book')
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Author') }}</b></td>
                                                        <td class="py-1">{{ optional($document->essential)->author }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Publisher') }}</b></td>
                                                        <td class="py-1">{{ optional($document->essential)->publisher }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('ISBN') }}</b></td>
                                                        <td class="py-1">{{ optional($document->essential)->isbn }}</td>
                                                    </tr>
                                                @elseif(optional($document->essential)->document_type == 'paper_cutting')
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Newspaper Name') }}</b></td>
                                                        <td class="py-1">{{ optional($document->essential)->newspaper_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Clipping Date') }}</b></td>
                                                        <td class="py-1">{{ dateFormat(optional($document->essential)->clipping_date) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Headline') }}</b></td>
                                                        <td class="py-1">{{ optional($document->essential)->headline }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Section') }}</b></td>
                                                        <td class="py-1">{{ optional($document->essential)->section }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Forwarded To') }}</b></td>
                                                        <td class="py-1">{{ optional($document->essential)->forwarded_to }}</td>
                                                    </tr>
                                                @elseif(optional($document->essential)->document_type == 'document')
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Document Category') }}</b></td>
                                                        <td class="py-1">{{ optional($document->essential)->doc_category }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('Reference Number') }}</b></td>
                                                        <td class="py-1">{{ optional($document->essential)->ref_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted py-1"><b>{{ __('File Number') }}</b></td>
                                                        <td class="py-1">{{ optional($document->essential)->file_number }}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td class="text-muted py-1"><b>{{ __('Language') }}</b></td>
                                                    <td class="py-1">{{ optional($document->essential)->language }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted py-1"><b>{{ __('Published Year') }}</b></td>
                                                    <td class="py-1">{{ optional($document->essential)->published_year }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection