@extends('front.includes.front_design')

@section('content')
    <section class="janata-main-content">
        <div class="container">
            @if(!Auth::guard('web')->check())
            <div class="janata-upload-wrapper">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="left-side">
                            <h4>Welcome to JanatakoOnline</h4>
                            <p>Register to JanatakoOnline to be part of this family.</p>
                            <div class="register">
                                <ul>
                                    <li><a href="{{ route('userLogin') }}"><button class="button button1">Login</button></a></li>
                                    <li><a href="{{ route('userRegister') }}"><button class="button button1">Register</button></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-side">
                            <div class="connect">
                                <h5>Connect with:</h5>
                            </div>
                            <div class="social-connect">
                                <button class="loginBtn loginBtn--facebook">
                                    Login with Facebook
                                </button>
                                <button class="loginBtn loginBtn--google">
                                    Login with Google
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="upload">
                <div class="sendNews">
                    <h5>SEND NEWS AS <span class="text-danger">GUEST</span></h5>
                </div>
                <div class="guestForm">
                    <form>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" aria-describedby="name" placeholder="Enter Full Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="number">Email Phone Number</label>
                                    <input type="tel" class="form-control" id="number" aria-describedby="number" placeholder="Enter Phone Number">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="myfile">New Featured Image</label>
                                    <input type="file" id="myFile" name="filename" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="newstitle">Email News Title</label>
                                    <input type="text" class="form-control" id="newstitle" aria-describedby="newstitle" placeholder="Enter News Title">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="newstitle">Email News Title</label>
                                    <select name="state" id="state" class="form-control">
                                        <option value="1">--SELECT--</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="1a">--SELECT--</option>
                                        <option value="2b">2b</option>
                                        <option value="3c">3c</option>
                                        <option value="4d">4d</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label for="subcategory">Sub Category</label>
                                    <select name="subcategory" id="subcategory" class="form-control">
                                        <option value="1a1">--SELECT--</option>
                                        <option value="2b2">2b2</option>
                                        <option value="3c3">3c3</option>
                                        <option value="4d4">4d4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="summerNote">
                            <h6> News Content</h6>
                            <textarea name="body" id="body" rows="10"></textarea>
                        </div>
                        <div class="uploadOuter">
                            <h6>Related Images</h6>
                            <span class="dragBox">
                            Darg and Drop image here
                            <input type="file" onChange="dragNdrop(event)" ondragover="drag()" ondrop="drop()" id="uploadFile" />
                        </span>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="displayName">
                            <label for="exampleCheck1" class="form-check-label"> I DON'T WANT MY NAME TO DISPLAYED
                                PUBLICLY.</label>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="unicode">
                <h6>CONVERT UNICODE</h6>
                <iframe width="100%" height="400" frameborder="0" border="no" scrolling="no" marginwidth="0" marginheight="0" allowtransparency="true" src="https://www.ashesh.com.np/linknepali-unicode3.php?api=7302z9k161">
                </iframe><br><span style="color:black; font-size:8px; text-align:left">© <a href="https://www.ashesh.com.np/nepali-unicode.php" title="Nepali unicode" target="_top" style="text-decoration:none; color:gray;">Nepali Unicode</a></span>
            </div>
        </div>
    </section>
    @endsection
