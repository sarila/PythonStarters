<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body style="font-family: 'Poppins', sans-serif;">

<div class="email-wrapper-container" style="width: 50%; margin: 40px auto; padding: 20px 50px; background: #f5f5f5;">
    <!-- LOGO -->

    <div class="main-content-wrap" style="background: #fff; padding: 30px 40px; margin-bottom: 30px;">

        <div class="logo-wrap" style="height: 100px; width: 100%; margin-bottom: 15px;">
            <a href="#"><img src="" alt="LOGO" style="height: 100%; width:100%; object-fit:contain;"></a>
        </div>

        <h2 style="font-size: 1.6rem; font-weight: 400; color:#333;">Hi {{$name}},</h2>
        <p style="color: #777; line-height: 1.9;">Please click on the link below to complete the verification process for <span style="display: block; color: #000;">{{$email}}</span></p>

        <a href="{{url('/confirm/'.$code)}}" onMouseOver="this.style.color='#eb5339',this.style.background='#fff'" onMouseOut="this.style.background='#eb5339', this.style.color='#fff'" style="text-decoration: none; display: inline-block; padding: 10px 30px; background: #eb5339; color: #fff; border: 1px solid #eb5339; margin: 10px 0; transition: all .3s;">Verify Your Email Address</a>

        <p style="color: #777; line-height: 1.9; margin-bottom: 20px;">If you didn't attempt to verify your email address with August Mountain, Please delete this email.</p>
        <p style="color: #777; line-height: 1.9; margin-bottom: 0;">Cheers,</p>
        <a href="#">
            <h2 style="display:inline-block; font-size: 1.8rem; font-weight: 600; color: #220c9e; margin: 0; padding: 0;">Janata Ko Online</h2>
        </a>
    </div>


</div>

</body>
</html>
