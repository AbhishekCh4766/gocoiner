@extends('layouts.backend')

@section('title', 'Create Menu')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Create Menu</h4>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {!! Form::open(['class'=>'form', 'route' => 'private.menus.store', 'method' => 'POST']) !!}

                    @include('backend.partials.input-text', ['id' => 'name', 'label' => 'Title', 'value' => old('name'), 'required' => true])

                    @include('backend.partials.input-select', ['id' => 'parent_id', 'label' => 'Parent Menu', 'selected' => old('parent_id'), 'required' => false, 'col' => 7, 'options' => $parents, 'placeholder' => 'Select Parent Menu...'])

                    @include('backend.partials.input-text', ['id' => 'link', 'label' => 'Custom URL', 'value' => old('link'), 'required' => false])

                    @include('backend.partials.input-select', ['id' => 'page_id', 'label' => 'Linked Page', 'selected' => old('page_id'), 'required' => false, 'col' => 7, 'options' => $pages, 'placeholder' => 'Select linked page...'])

                    @include('backend.partials.input-check', ['id' => 'active', 'label' => 'Publish?', 'value' => 'value', 'checked' => old('active'), 'required' => false])

                    <hr>

                    <a href="{{ route('private.menus.index') }}" class="btn btn-lg btn-secondary">&larr; Back</a>

                    {!! Form::submit('Create', ['class' => 'btn btn-lg btn-success pull-right']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection