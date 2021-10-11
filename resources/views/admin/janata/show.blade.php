<table class="table table-hover">
    <tr>
        <th>Image</th>
        <td>
            @if($model->thumbnail_image)
                <img src="{{ asset('public/uploads/news/janata/'.$model->thumbnail_image) }}" width="200px">
            @else
                <img src="{{ asset('public/default/noimage.png') }}" width="200px">
            @endif
        </td>
    </tr>

    <tr>
        <th>Category</th>
        <td>
            {{ $model->category->category_name_np }}
        </td>
    </tr>


    <tr>
        <th>News Type</th>
        <td>
            @if($model->news_type_id == 0)
                N/A
            @else
                {{ $model->news_type->title }}
            @endif
        </td>
    </tr>


    <tr>
        <th>Author</th>
        <td>
            {{ $model->user->name }}
        </td>
    </tr>

    <tr>
        <th>Status</th>
        <td>
            @if($model->status == 1)
                <span class="badge badge-success" style="color: white">Verified</span>
            @else
                <span class="badge badge-danger" style="color: white">Pending</span>
            @endif
        </td>
    </tr>


    <tr>
        <th>Total Views Of Post </th>
        <td>{{ $model->view_count }}</td>
    </tr>
</table>
