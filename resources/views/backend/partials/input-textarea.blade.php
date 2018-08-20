<div class="row card-block">
    <label for="{{ $id }}" class="col-{{ $text_col ?? '4' }} col-form-label">{{ $label }}</label>
    <div class="col-{{ $col ?? '7' }}">
        {!! Form::textarea($id, $value, ['class' => 'form-control', 'id' => $id, 'rows' => isset($rows) ? $rows : 5]) !!}

        @if ($errors->has($id))
            <div class="form-control-feedback">
                <strong>{{ $errors->first($id) }}</strong>
            </div>
        @endif
    </div>
</div>