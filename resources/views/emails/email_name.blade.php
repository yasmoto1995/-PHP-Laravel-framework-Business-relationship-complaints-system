<x-mail::message>

Hi {{ $student->student_name}}.

<x-mail::panel>
Your request has been sent successfully
</x-mail::panel>



<x-mail::panel>
This is your number {{ $student->id }}

</x-mail::panel>
you can follow up on the status of your application

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
