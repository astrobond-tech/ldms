@php
    $document_type_title = ucwords(str_replace('_', ' ', $document_type ?? 'document'));
    $document_type_route = str_replace('_', '-', $document_type ?? 'document');
@endphp

@extends('layouts.app')
@section('page-title')
    {{ __($document_type_title) }}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{ __($document_type_title) }}</a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create my document'))
        <a class="btn btn-secondary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route($document_type_route.'.create') }}"
           data-title="{{__('Create')}} {{ __($document_type_title) }}"> <i class="ti-plus mr-5"></i>{{__('Create')}} {{ __($document_type_title) }}</a>
    @endif
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center g-2">
                    <div class="col">
                        <h5>
                            {{ __($document_type_title) }}
                        </h5>
                    </div>
                    {{-- @if (Gate::check('create document'))
                        <div class="col-auto">
                            <a class="btn btn-secondary customModal" href="#" data-size="lg"
                                data-url="{{ route($document_type_route.'.create') }}" data-title="{{ __('Create') }} {{ __($document_type_title) }}">
                                <i class="ti ti-circle-plus align-text-bottom"></i>{{ __('Create') }} {{ __($document_type_title) }}</a>
                        </div>
                    @endif --}}
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="dt-responsive table-responsive">
                    <table class="table table-hover advance-datatable">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Sub Category') }}</th>
                                @if ($document_type == 'book' || $document_type == 'document')
                                    <th>{{ __('Rack') }}</th>
                                    <th>{{ __('Room') }}</th>
                                    <th>{{ __('Shelf') }}</th>
                                    <th>{{ __('Cabinet') }}</th>
                                @endif
                                <th>{{ __('Created By') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Expired At') }}</th>
                                @if (Gate::check('edit my document') || Gate::check('delete my document') || Gate::check('show my document'))
                                    <th class="text-right">{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                <tr role="row">
                                    <td>{{ $document->name }}</td>
                                    <td>
                                        {{ !empty($document->category) ? $document->category->title : '-' }}
                                    </td>
                                    <td>
                                        {{ !empty($document->subCategory) ? $document->subCategory->title : '-' }}
                                    </td>
                                    @if ($document_type == 'book' || $document_type == 'document')
                                        <td>{{ optional($document->essential)->rack ?? '-' }}</td>
                                        <td>{{ optional($document->essential)->room ?? '-' }}</td>
                                        <td>{{ optional($document->essential)->shelf ?? '-' }}</td>
                                        <td>{{ optional($document->essential)->cabinet ?? '-' }}</td>
                                    @endif
                                    <td>{{ !empty($document->createdBy) ? $document->createdBy->name : '' }}</td>
                                    <td>{{ dateFormat($document->created_at) }}</td>
                                    <td>{{ dateFormat($document->created_at) }}</td>
                                    @if (Gate::check('edit my document') || Gate::check('delete my document') || Gate::check('show my document'))
                                        <td class="text-right">
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => [$document_type_route.'.destroy', encrypt($document->id)]]) !!}
                                                @if (Gate::check('show my document'))
                                                    <a class="avtar avtar-xs btn-link-warning text-warning" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Show Details') }}"
                                                        href="{{ route($document_type_route.'.show', \Illuminate\Support\Facades\Crypt::encrypt($document->id)) }}">
                                                        <i data-feather="eye"></i></a>
                                                @endif
                                                {{-- @if (Gate::check('edit my document'))
                                                    <a class="avtar avtar-xs btn-link-secondary text-secondary customModal" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Edit') }}" href="#"
                                                        data-url="{{ route($document_type_route.'.edit', encrypt($document->id)) }}"
                                                        data-title="{{ __('Edit') }} {{ __($document_type_title) }}"> <i
                                                            data-feather="edit"></i></a>
                                                @endif
                                                @if (Gate::check('delete my document'))
                                                    <a class=" avtar avtar-xs btn-link-danger text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Detete') }}" href="#"> <i
                                                            data-feather="trash-2"></i></a>
                                                @endif --}}
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
