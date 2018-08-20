<div class="row card-block">
    <label for="{{ $id }}" class="col-7 col-form-label">
        {!! Form::checkbox($id, $value, $checked, ['class' => 'check']) !!}
        &nbsp;{{ $label }}
    </label>
</div>