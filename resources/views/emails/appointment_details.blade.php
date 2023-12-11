<!DOCTYPE html>
<html>
<body>
	<h3>Hello {{$data->patient->user->name}},</h3>
	<p>Your Appointment Request for {{$data->pet->name}}'s {{ucfirst($data->service->type)}} has been scheduled on {{ date('M d, Y @ h:i a', strtotime($data->start)) }}.</p>
	<p>Please <a href="{{route('backoffice.auth.login')}}" target="_blank">login</a> for more details.</p>
	<p>
		Thanks,</br>
		{{config('app.name')}}
	</p>
</body>
</html>