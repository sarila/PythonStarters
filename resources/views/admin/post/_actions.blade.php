<a href="{{ $url_show }}" class="btn-show btn btn-sm btn-success" title="Title: {{ $model->news_title }}"><i class="la la-eye" ></i></a>


<a href="{{ $url_gallery }}" class="btn btn-sm btn-primary" title="Images: {{ $model->news_title }}">
    <i class="fa fa-image"></i>
</a>



<a href="{{ $url_edit }}" class="btn btn-sm btn-info" title="Edit: {{ $model->news_title }}">
    <i class="fa fa-pencil"></i>
</a>

<a href="{{ $url_destroy }}" class="btn-delete btn btn-sm btn-danger" rel="{{ $model->id }}" rel1="delete-news"  title=" Delete {{ $model->news_title }}" ><i class="la la-trash"></i></a>


