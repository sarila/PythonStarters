<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                @if(Session::get('admin_page') == 'dashboard')
                      @php $active = "active" @endphp
                    @else
                    @php $active = "" @endphp
                @endif
                <li class="{{ $active }}">
                    <a href="{{ route('adminDashboard') }}"><i class="la la-dashboard"></i> <span> Dashboard</span> </a>
                </li>


                @if(Session::get('admin_page') == 'category' || Session::get('admin_page') == 'add_category' ||  Session::get('admin_page') == 'edit_category')
                    @php $open = "active" @endphp
                @else
                    @php $open = "" @endphp
                @endif

                <li class="submenu">
                    <a href="javascript:" class="{{ $open }}"><i class="la la-list-alt"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">

                        @if(Session::get('admin_page') == 'category')
                            @php $active = "active_2" @endphp
                        @else
                            @php $active = "" @endphp
                        @endif

                        <li class="{{ $active }}"><a href="{{ route('category.index') }}">All Category</a></li>

                        @if(Session::get('admin_page') == 'add_category')
                            @php $active = "active_2" @endphp
                        @else
                            @php $active = "" @endphp
                        @endif

                        <li class="{{ $active }}"><a href="{{ route('category.add') }}">Add Category</a></li>
                    </ul>
                </li>


                @if(Session::get('admin_page') == 'post' || Session::get('admin_page') == 'add_post' ||  Session::get('admin_page') == 'edit_post' || Session::get('admin_page') == 'featured')
                    @php $open = "active" @endphp
                @else
                    @php $open = "" @endphp
                @endif
                <li class="submenu">
                    <a href="javascript:" class="{{ $open }}"><i class="la la-file"></i> <span> News Management </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">

                        @if(Session::get('admin_page') == 'post')
                            @php $active = "active_2" @endphp
                        @else
                            @php $active = "" @endphp
                        @endif
                        <li class="{{ $active }}"><a href="{{ route('post.index') }}">All News</a></li>


                            @if(Session::get('admin_page') == 'featured')
                                @php $active = "active_2" @endphp
                            @else
                                @php $active = "" @endphp
                            @endif
                            <li class="{{ $active }}"><a href="{{ route('post.featured') }}">Featured News</a></li>



                        @if(Session::get('admin_page') == 'add_post')
                            @php $active = "active_2" @endphp
                        @else
                            @php $active = "" @endphp
                        @endif
                        <li class="{{ $active }}"><a href="{{ route('post.add') }}">Add News</a></li>
                    </ul>
                </li>



                @if(Session::get('admin_page') == 'janata')
                    @php $open = "active" @endphp
                @else
                    @php $open = "" @endphp
                @endif
                <li class="submenu">
                    <a href="javascript:" class="{{ $open }}"><i class="la la-file"></i> <span> Janata Ko News </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">

                        @if(Session::get('admin_page') == 'janata')
                            @php $active = "active_2" @endphp
                        @else
                            @php $active = "" @endphp
                        @endif
                        <li class="{{ $active }}"><a href="{{ route('janata.index') }}">All News</a></li>
                    </ul>
                </li>

                <!-- Videos  -->

                @if(Session::get('admin_page') == 'videos' || Session::get('admin_page') == 'add_videos')
                    @php $open = "active" @endphp
                @else
                    @php $open = "" @endphp
                @endif
                <li class="submenu">
                    <a href="javascript:" class="{{ $open }}"><i class="la la-video-camera"></i><span> Video Management </span><span class="menu-arrow"></span></a>
                    <ul style="display: none;">

                        @if(Session::get('admin_page') == 'videos')
                            @php $active = "active_2" @endphp
                        @else
                            @php $active = "" @endphp
                        @endif
                        <li class="{{ $active }}"><a href="{{ route('videos.index') }}">All Videos</a></li>

                         @if(Session::get('admin_page') == 'add_videos')
                            @php $active = "active_2" @endphp
                        @else
                            @php $active = "" @endphp
                        @endif
                        <li class="{{ $active }}"><a href="{{ route('videos.create') }}">Add Videos</a></li>


                    </ul>
                </li>

                <!-- Poster  -->

                @if(Session::get('admin_page') == 'posters' || Session::get('admin_page') == 'add_posters')
                    @php $open = "active" @endphp
                @else
                    @php $open = "" @endphp
                @endif
                <li class="submenu">
                    <a href="javascript:" class="{{ $open }}"><i class="la la-picture-o"></i><span> Ads Management </span><span class="menu-arrow"></span></a>
                    <ul style="display: none;">

                        @if(Session::get('admin_page') == 'posters')
                            @php $active = "active_2" @endphp
                        @else
                            @php $active = "" @endphp
                        @endif
                        <li class="{{ $active }}"><a href="{{ route('posters.index') }}">All Ads</a></li>

                         @if(Session::get('admin_page') == 'add_posters')
                            @php $active = "active_2" @endphp
                        @else
                            @php $active = "" @endphp
                        @endif
                        <li class="{{ $active }}"><a href="{{ route('posters.create') }}">Add Ads</a></li>

                    </ul>
                </li>


                <!-- User setting -->
                @if(Session::get('admin_page') == 'users')
                    @php $open = "active" @endphp
                @else
                    @php $open = "" @endphp
                @endif
                <li class="submenu">
                    <a href="javascript:" class="{{ $open }}"><i class="la la-user"></i> <span> User Management </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">

                        @if(Session::get('admin_page') == 'users')
                            @php $active = "active_2" @endphp
                        @else
                            @php $active = "" @endphp
                        @endif
                        <li class="{{ $active }}"><a href="{{ route('users') }}">View All Users</a></li>
                    </ul>
                </li>


                @if(Session::get('admin_page') == 'theme')
                    @php $active = "active" @endphp
                @else
                    @php $active = "" @endphp
                @endif
                <li class="{{ $active }}">
                    <a href="{{ route('theme') }}"><i class="la la-cogs"></i> <span> Settings</span> </a>
                </li>


                
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
