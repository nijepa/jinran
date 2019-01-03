<h1>Meeting</h1>
@foreach($data as $meeting)
    <p>Date: {{$meeting->date_m}}</p>
    <p>Company: {{$meeting->company ? $meeting->company->name : 'Meeting has no company'}}</p>
    <p>Title: {{$meeting->title}}</p>
    <p>Description: {{$meeting->description}}</p>
    <p>Created: {{$meeting->created_at->diffForHumans()}}</p>
    <p>Updated: {{$meeting->updated_at->diffForHumans()}}</p>
@endforeach