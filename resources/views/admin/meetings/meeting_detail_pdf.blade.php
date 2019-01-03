<h1>Meeting</h1>
<p>Company: {{$data->company ? $data->company->name : 'Meeting has no company'}}</p>
<p>Title: {{$data->title}}</p>
<p>Description: {{$data->description}}</p>
<p>Created: {{$data->created}}</p>
<p>Updated: {{$data->updated}}</p>