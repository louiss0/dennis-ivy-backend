@extends("../layouts.base_email")

@section("content")
<p>Hi {{ $name }}</p>
<p>Forgot your password. Please send your new password and confirm it</p>
<p>Go to {{ $url }} If not please ignore this email</p>

<table class="btn btn-primary" role="presentation" border="0" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td align="left">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td><a href="{{ $url }}" target="_blank">Click here to go to the site </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
@endsection