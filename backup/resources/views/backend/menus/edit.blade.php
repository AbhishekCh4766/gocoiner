@extends('layouts.backend')

@section('title', 'Edit Menu')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Edit Menu</h4>

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

                    {!! Form::open(['class'=>'form', 'route' => ['admin.menus.update', $menu->id], 'method' => 'PUT']) !!}

                    @include('backend.partials.input-text', ['id' => 'name', 'label' => 'Title', 'value' => old('name', $menu->name), 'required' => true])

                    @include('backend.partials.input-select', ['id' => 'parent_id', 'label' => 'Parent Menu', 'selected' => old('parent_id', $menu->parent_id), 'required' => false, 'col' => 7, 'options' => $parents, 'placeholder' => 'Select Parent Menu...'])

                    @include('backend.partials.input-text', ['id' => 'link', 'label' => 'Custom URL', 'value' => old('link', $menu->link), 'required' => false])

                    @include('backend.partials.input-select', ['id' => 'page_id', 'label' => 'Linked Page', 'selected' => old('page_id', $menu->page_id), 'required' => false, 'col' => 7, 'options' => $pages, 'placeholder' => 'Select linked page...'])

                    @include('backend.partials.input-check', ['id' => 'active', 'label' => 'Publish?', 'value' => 'value', 'checked' => old('active', $menu->active), 'required' => false])

                    <hr>

                    <a href="{{ route('admin.menus.index') }}" class="btn btn-lg btn-secondary">&larr; Back</a>

                    {!! Form::submit('Update', ['class' => 'btn btn-lg btn-success pull-right']) !!}

                    {!! Form::close() !!}
                </div>

                <div class="card-block">
                    <hr>

                    <h4 class="card-title">Child Menus</h4>

                    <div class="table-responsive">
                        @include('backend.menus.partials.table-menus', ['menus' => $menu->children])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection