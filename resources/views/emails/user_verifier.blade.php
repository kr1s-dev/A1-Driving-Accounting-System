<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>
        <div>
            A user has been created under you email address. 
            Please follow the link below to verify your account.
            {{ URL::to('auth/verify/' . $confirmation_code) }}.<br/>
        </div>
    </body>
</html>