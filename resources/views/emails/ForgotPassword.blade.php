@component('mail::message')
# Xin chào 

<h4> {{ $details['content'] }} </h4>

<h4> <a href="{{ url('') }}">{{ config('app.name') }}</a> : Cảm ơn bạn đã quan tâm đến dịch vụ của chúng tôi </h4> 
@endcomponent
