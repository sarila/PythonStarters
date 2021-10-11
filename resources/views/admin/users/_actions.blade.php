
<a href="{{ $url_edit }}" class="btn btn-sm btn-info" title="Edit: {{ $model->name }}">
    <i class="fa fa-pencil"></i>
</a>

<a href="{{ $url_destroy }}" class="btn-delete btn btn-sm btn-danger" rel="{{ $model->id }}" rel1="delete-user"  title=" Delete {{ $model->name }}" ><i class="la la-trash"></i></a>


