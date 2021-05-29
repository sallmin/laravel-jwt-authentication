@extends('emails.auth.layouts.master')

@section('content')
    You asked for password reset. Please click button below for changing your password:

    <table border="0" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;"><tr>
            <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                <a href="{{ $url }}" class="button button-blue" target="_blank" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #ffffff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3097d1; border-top: 10px solid #3097d1; border-right: 18px solid #3097d1; border-bottom: 10px solid #3097d1; border-left: 18px solid #3097d1;">Reset password</a>
            </td>
        </tr>
    </table>
@stop


