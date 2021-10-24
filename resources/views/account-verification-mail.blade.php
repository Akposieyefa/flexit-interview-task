@component('mail::message')
{{ $data['title'] }}


Hello! {{ $data['name']}}<br/>

{{ $data['body'] }}

@component('mail::button', ['url' => 'http://localhost:3000/#/verify-email?token='.$data['token'] ])
    Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
