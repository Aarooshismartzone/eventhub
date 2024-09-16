<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Leisure Group Tech</title>

       

       
    </head>
    <body class="antialiased">
        <div class="row">
            
                <div class="hidden fixed top-50 right-50 px-6 py-4 sm:block">                     
                    <li><a href="{{ url('admin/login') }}" class="text-sm text-gray-700 underline">Admin Login</a></li>
                    <li><a href="{{ url('company/login') }}" class="text-sm text-gray-700 underline">Company Login</a></li>
                    <li><a href="{{ url('company/enroll') }}" class="text-sm text-gray-700 underline">Company Registration</a></li>
                    <li><a href="{{ url('user/login') }}" class="text-sm text-gray-700 underline">User Login</a></li>
                    <li><a href="{{ url('user/registration') }}" class="text-sm text-gray-700 underline">User Registration</a></li>
                </div>
        </div>
    </body>
</html>
