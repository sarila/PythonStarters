<div class="col-lg-3 col-md-6">
    <div class="profile">
        @php $current_user = auth()->user(); @endphp
        <h5>Dashboard</h5>
        <div class="user-profile-image text-center mt-4">
            @if(!empty($current_user->image))
                <img src="{{ asset('public/uploads/profile/'.$current_user->image) }}" class="img-fluid" alt="{{ $current_user->name }}">
            @else
                <img src="{{ asset('public/default/image.png') }}" class="img-fluid" alt="{{ $current_user->name }}">
            @endif
            <h6 class="mt-3">Hello, <strong>{{ $current_user->name }}</strong></h6>
        </div>


        <div class="user-info">
            <div class="row">
                <div class="col-2">
                    <div><i class="fas fa-tachometer-alt"></i></div>
                    <div><i class="fas fa-user-tie"></i></div>
                    <div><i class="far fa-edit"></i></div>
                    <div><i class="far fa-file"></i></div>
                    <!-- <div><i class="fas fa-video"></i></div> -->
                    <div><i class="fas fa-key"></i></div>
                    <div><i class="fas fa-power-off"></i></div>
                </div>
                <div class="col-10">
                    <div> <a href="{{ route('userDashboard') }}">My Dashboard</a></div>
                    <div> <a href="{{ route('userProfile') }}">My Profile</a></div>
                    <div> <a href="{{ route('userProfileEdit') }}">Edit Profile</a></div>
                    <div> <a href="{{ route('userNews') }}">News Management</a></div>
                    <div> <a href="{{ route('videos.index') }}">Videos</a></div>
                    <div> <a href="{{ route('userChangePassword') }}">Change Password</a></div>
                    <div> <a href="{{ route('userLogout') }}">Logout</a></div>
                </div>
            </div>
        </div>


    </div>
</div>
