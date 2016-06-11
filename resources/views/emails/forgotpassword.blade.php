<h2>Hello {{ $name }},</h2>

<p>Your password for the workZone was changed at {{ $time }}. Please visit below link in your browser to reset your password. Use the password provided below as the current password.</p>

<p>Temporary Password : {{ $password }}</p>

<p>&nbsp;</p>

<p>Link : <a href="{{ $link }}">Click Here to Reset.</a></p>

<p>&nbsp;</p>

<p>Thank you,</p>
<p>workZone.</p>