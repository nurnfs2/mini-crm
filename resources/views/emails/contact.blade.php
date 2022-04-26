@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => 'http://mini-crm.com'])
Visit Contact
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
