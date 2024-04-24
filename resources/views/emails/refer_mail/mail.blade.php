@component('mail::message')
[![N|Solid](http://math.orangebytetech.com/website/images/logo.png)](http://math.orangebytetech.com/)
# Welcome to Matharon..!!
## Where study meets pace.
### Dear, {{$content['name']}}

> You get a bonus one month free access to Gold membership features after successful login of your friend.

@component('mail::panel')
### Refer a friend with promo code :{{$content['referal']}}

@endcomponent
@component('mail::button', ['url' => url('StudentRegister')])
    REGISTER
@endcomponent

>Happy-News
>Even your referred friend gets one month free access as a gold member.


Team Thanks,<br>
   {{ config('app.name') }}
   @endcomponent


