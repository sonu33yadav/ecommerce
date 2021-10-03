<html>
<body>
<table style="width: 100%">
    <tbody>
    <tr>
        <td width="100%" cellpadding="0" cellspacing="0"
            style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;border-bottom:1px solid #edeff2;border-top:1px solid #edeff2;margin:0;padding:40px 0;width:100%">
            <table align="center" width="768" cellpadding="0" cellspacing="0"
                   style="font-family:Avenir,Helvetica,sans-serif;background-color:#ffffff;margin:0 auto;padding:30px 50px;border: 1px solid lightgray;border-radius:7px;width:570px;box-shadow: 10px 10px 5px #585858 !important;">
                <tbody>
                <tr>
                    <td>
                        <h1 style="font-size: 20px; text-align: center;color: black">{{env('APP_NAME')}}</h1>
                        <div style="text-align: center; width: 100%">
                            <img src="{{asset('images/template/password-reset.png')}}" style="width: 200px; margin-top: 10px; margin-bottom: 10px">
                        </div>
                        <h1 style="font-size: 30px; text-align: center;color: black; margin-bottom: 15px">@lang('forgot_your_password')</h1>
                        <p style="font-size:14px; text-align: center;color: black; margin-bottom: 0">@lang('that_okay')</p>
                        <p style="font-size:14px; text-align: center;color: black; margin-bottom: 0">@lang('click_to_reset')</p>
                        <div style="width: 100%;text-align: center;padding: 50px 0">
                            <a href="{{$url}}" style="padding: 10px 40px;width: 200px;background-color: black;color: white;text-decoration: unset;font-size: 16px;border-radius: 15px;border: transparent;text-transform: uppercase">
                                @lang('RESET_PASSWORD')
                            </a>
                        </div>
                        <hr>
                        <p style="font-size: 14px; color: #a5a5a5; margin-top: 10px; text-align: center;">© {{env('APP_NAME')}} Sdn Bhd. All rights reserved</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
