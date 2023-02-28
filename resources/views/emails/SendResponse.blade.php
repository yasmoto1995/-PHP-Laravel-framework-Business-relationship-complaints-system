<x-mail::message>
# Response to order

Welcome {{ $student->student_name}} in my system.




Your request has been answered and the response was:

<x-mail::panel>
    {{ $student->response }}

</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
