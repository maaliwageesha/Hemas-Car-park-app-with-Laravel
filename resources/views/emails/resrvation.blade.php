@component('mail::message')
# Your Reservation Code

<strong>Your Email: </strong> {{ $data['email'] }} <br>
<strong>Your Mobile Number: </strong> {{ $data['phone_number'] }} <br>
<strong>Your Slot No: </strong> {{ $data['slot_id'] }} <br><br>

Hi {{ explode(' ', $data['name'])[0] }}! your reservation code is <h1 class="text-bold">{{ $data['reservation_code'] }}</h1>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
