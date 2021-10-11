<a href="{{ $url_show }}" class="btn-show btn btn-sm btn-success" title="Title: {{ $model->title }}"><i class="la la-eye" ></i></a>

<a href="{{ $url_edit }}" class="btn btn-sm btn-info" title="Edit: {{ $model->title }}">
    <i class="fa fa-pencil"></i>
</a>

<form action="{{ $url_destroy }}" method="post">
    @method('DELETE')
    @csrf
    <button class="btn btn-danger btn-sm delete-confirm" data-name="{{ $model->name }}" type="submit"><i class="la la-trash"></i></button>
</form>
<!-- <a href="{{ $url_destroy }}" class="btn-delete btn btn-sm btn-danger" rel="{{ $model->id }}" rel1="videos"  title=" Delete {{ $model->news_title }}" ></a> -->


