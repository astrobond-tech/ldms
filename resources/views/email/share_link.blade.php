<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{{ env('APP_NAME') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
</head>
<body style="font-family: 'Poppins', Arial, sans-serif">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" style="padding: 20px;">
                <table class="content" width="600" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse; border: 1px solid #cccccc;">
                    <!-- Header -->
                    <tr>
                        <td class="header" style="background-color: #345C72; padding: 40px; text-align: center; color: white; font-size: 24px;">
                            <img src="{{ !empty($data['logo']) ? fetch_file($data['logo'],'upload/logo') : '#' }}" style="height: 100px;" alt="Logo">
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td class="body" style="padding: 40px; text-align: left; font-size: 16px; line-height: 1.6;">
                            Hello,
                            <br><br>
                            A document has been shared with you. Please use the link below to access it.
                            <br><br>
                            <strong>Document Link:</strong> <a href="{{ $data['url'] }}">{{ $data['url'] }}</a>
                            @if(!empty($data['password']))
                                <br><strong>Password:</strong> {{ $data['password'] }}
                            @endif
                            @if(!empty($data['exp_date']))
                                <br><strong>Expires On:</strong> {{ $data['exp_date'] }}
                            @endif
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer" style="background-color: #333333; padding: 40px; text-align: center; color: white; font-size: 14px;">
                            Copyright &copy; {{ date('Y') }} | {{ env('APP_NAME') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
