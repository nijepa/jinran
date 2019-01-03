<h1>Meeting detail</h1>

@foreach($data as $meetingD)

    <p>Company: {{$meetingD->company ? $meetingD->company->name : 'Meeting has no company'}}</p>
    <p>Title: {{$meetingD->title}}</p>
    <p>Description: {{$meetingD->description}}</p>
    <p>Created: {{$meetingD->created_at}}</p>
    <p>Updated: {{$meetingD->updated_at}}</p>

@endforeach