@component('mail::message')
    # Welcome to UNISANT 🎓

    Hello {{ $student->first_name }} {{ $student->last_name }},

    We’re excited to welcome you as a new student at **UNISANT**!

    Here is your enrollment number:

    @component('mail::panel')
        **{{ $student->enrollment_number }}**
    @endcomponent

    You have been assigned to the following branch:

    **{{ $student->branch->name }}**

    If you have any questions, feel free to contact us.

    Thanks,<br>
    **UNISANT Admissions Team**
@endcomponent
