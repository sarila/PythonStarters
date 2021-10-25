


            <div class="row">
                <table class="table table-hover">
                    <tr>
                        <th>Title</th>
                        <td>
                            {{ $poster->title }}
                        </td>
                    </tr>

                    <tr>
                        <th>Placement</th>
                        <td>
                            {{ $poster->Placement}}
                        </td>
                    </tr>

                    @if($poster->category_id != null)
                    <tr>
                        <th>Admin</th>
                        <td>
                            {{ $poster->category_id }}
                        </td>
                    </tr>
                    @endif

                    @if($poster->image != null)
                    <tr>
                        <th>Image</th>
                        <td>
                            <a href="{{asset( 'public/uploads/posters/'.$poster->image)}}">
                                <img src="{{asset( 'public/uploads/posters/'.$poster->image)}}" class="img-fluid">
                            </a>
                            
                        </td>
                    </tr>
                    @endif
                </table>
            </div>



