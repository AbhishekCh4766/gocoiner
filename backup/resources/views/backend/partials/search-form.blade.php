{!! Form::open(['route' => 'admin.search', 'class' => 'pull-right col-sm-3', 'method' => 'GET']) !!}
<div class="input-group">
    <span class="input-group-addon"><i class="fa fa-search"></i></span>
    {!! Form::text('search_term', null, [ 'class' => 'form-control form-control-sm']) !!}
</div>
{!! Form::close() !!}