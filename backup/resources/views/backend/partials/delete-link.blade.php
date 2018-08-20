<a href="{{ $url }}"
   class="btn btn-sm btn-danger"
   onclick="event.preventDefault();
           if (confirm('Are You Sure to delete this?')) {
               document.getElementById('{{ $form_id }}').submit();
           }">
    <i class="fa fa-trash"></i>
</a>

<form id="{{ $form_id }}" action="{{ $url }}" method="POST" style="display: none;">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
</form>