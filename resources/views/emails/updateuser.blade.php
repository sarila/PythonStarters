<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body style="font-family: 'Poppins', sans-serif;">

<div class="email-wrapper-container" style="width: 50%; margin: 40px auto; padding: 20px 50px; background: #f5f5f5;">
    <!-- LOGO -->

    <div class="main-content-wrap" style="background: #fff; padding: 30px 40px; margin-bottom: 30px;">

        <div class="logo-wrap" style="height: 100px; width: 100%; margin-bottom: 15px;">
            <a href="#"><img src="{{ asset('public/uploads/'.$theme->logo) }}" alt="LOGO" style="height: 100%; width:100%; object-fit:contain;"></a>
        </div>

        <h2 style="font-size: 1.6rem; font-weight: 400; color:#333;">Hello {{$name}},</h2>
        <p>
            Your login details has been changed. Your detail for the login are as follows
        </p>
        <p>
            Email : {{$email}}  <br>
            Password: {{$password}}
        </p>
        <p>
        </p>
        <p>Please change your password after you sign in for the first time.</p>
        <p style="color: #777; line-height: 1.9; margin-bottom: 0;">Cheers,</p>
        <a href="#">
            <h2 style="display:inline-block; font-size: 1.8rem; font-weight: 600; color: #220c9e; margin: 0; padding: 0;">JANATA KO ONLINE</h2>
        </a>
    </div>

</div>

</body>
</html>
