<div class="row card-block">
    <label for="{{ $id }}" class="col-{{ $text_col ?? '4' }} col-form-label">{{ $label }}</label>
    <div class="col-{{ $col ?? '7' }}">
        {!! Form::select($id, $options, $selected, ['class' => 'custom-select col-' . $col ?? '7', 'placeholder' => $placeholder ?? 'Select an option...']) !!}

        @if ($errors->has($id))
            <div class="form-control-feedback">
                <strong>{{ $errors->first($id) }}</strong>
            </div>
        @endif
    </div>
</div>