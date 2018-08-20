<div class="row card-block">
    <label for="{{ $id }}" class="col-{{ $text_col ?? '4' }} col-form-label">{{ $label }}</label>
    <div class="col-{{ $col ?? '2' }}">
        {!! Form::number($id, $value, ['class' => 'form-control', 'id' => $id, 'required' => $required, 'min' => $min, 'max' => $max]) !!}

        @if ($errors->has($id))
            <div class="form-control-feedback">
                <strong>{{ $errors->first($id) }}</strong>
            </div>
        @endif
    </div>
</div>