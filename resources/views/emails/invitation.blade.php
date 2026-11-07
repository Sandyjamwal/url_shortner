<p>Hello {{ $invitation->name }},</p>

<p>You Are Invited Please click belowl link:</p>

<p>
    <a href="{{ url('/invitation/' . $invitation->token) }}">Accept Invitation</a>
</p>
