<a href="{{ $url_show }}" class="btn-show btn btn-sm btn-success" title="Detail: {{ $model->category_name_np }}"><i class="la la-eye" ></i></a>

<a href="{{ $url_edit }}" class="btn btn-sm btn-info" title="Edit: {{ $model->name }}">
    <i class="fa fa-pencil"></i>
</a>

<a href="{{ $url_destroy }}" class="btn-delete btn btn-sm btn-danger" rel="{{ $model->id }}" rel1="delete-category"  title=" Delete {{ $model->name }}" ><i class="la la-trash"></i></a>


