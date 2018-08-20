<div class="row card-block">
    <label for="{{ $id }}" class="col-{{ $text_col ?? '4' }} col-form-label">{{ $label }}</label>
    <div class="col-{{ $col ?? '7' }}">
        {!! Form::password($id, ['class' => 'form-control', 'id' => $id, 'required' => $required]) !!}

        @if ($errors->has($id))
            <div class="form-control-feedback">
                <strong>{{ $errors->first($id) }}</strong>
            </div>
        @endif
    </div>
</div>