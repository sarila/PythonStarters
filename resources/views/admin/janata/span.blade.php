@if($model->status == 1)
     <span class="badge badge-success" style="color: white">Verified</span>
@else
    <span class="badge badge-danger" style="color: white">Pending</span>

@endif
