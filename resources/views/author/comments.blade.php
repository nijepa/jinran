@extends('layouts.frontLayout.front_design')

@section('content')

    <!-- MAIN -->
    <main role="main">
        <article>
            <!-- Header -->
            <header class="section background-image text-center" style="background-image:url(/images/frontend_images/img-05.jpg)">
                <h1 class="animated-element slow text-white text-s-size-12 text-m-size-20 text-size-30 text-line-height-1 margin-bottom-10 margin-top-30 text-line-height-1">
                    <b>{{$meeting->company->name}}</b></h1>
                        <p>
                            @if(!empty($meeting->company->photo_id))
                                <img src="{{ asset('/images/backend_images/companies/'. $meeting->company->photo_id) }}" class="center" >
                            @endif
                        </p>
                    <h1 class="animated-element slow text-white text-s-size-12 text-m-size-20 text-size-30 text-line-height-1 margin-bottom-10 margin-top-30 text-line-height-1">meeting with </h1>
                <h1 class="animated-element slow text-white text-s-size-12 text-m-size-20 text-size-30 text-line-height-1 margin-bottom-10 margin-top-30 text-line-height-1">
                <b>{{$meetings->company->name}}</b></h1>
                        <p>
                            @if(!empty($meetings->company->photo_id))
                                <img src="{{ asset('/images/backend_images/companies/'. $meetings->company->photo_id) }}" class="center" >
                            @endif
                        </p>
                <br />
                <p><b>Title :</b>
                <h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-1">{{$meetings->title}}</h3></p>
                <p><b>Description :</b>
                <h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-2">{{$meetings->description}}</h3></p>
                <br />
                <p class="animated-element text-dark-hover text-s-size-12 text-m-size-16 text-size-20">Please add comment and/or upload documents.</p>

                <!-- white full width arrow object -->
                <img class="arrow-object" src="/images/frontend_images/arrow-object-white.svg" alt="">
            </header>

            <section class="section background-dark">
                <div class="s-12 m-1 l-4 center">
                    <h3 class="text-size-20 margin-bottom-10 text-center"><b>Leave a Comment & Upload Document :</b></h3>
                    {!! Form::open(['method'=>'POST', 'action'=> 'PostCommentsController@store' , 'class'=>'customform text-white', 'enctype'=>'multipart/form-data', 'name'=>'add_comment', 'id'=>'add_comment' ])  !!}
                        <input type="hidden" name="meeting_id" value="{{$meetings->id}}">
                        <div class="line">
                            <div class="s-12">
                                {!! Form::textarea('comment', null, ['class'=>'required', 'placeholder'=>'Your comment','rows'=>3, 'name'=>'comment', 'id'=>'comment' ])!!}
                            </div>
                            <h3 class="text-size-20 margin-bottom-10 text-center">
                            {!! Form::label('file', 'Upload documet :') !!}
                            </h3>
                            <input type="file" name="file" />
                            <div class="s-12"><button class="button border-radius text-white background-primary" type="submit">Submit Comment</button></div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </section>
@include('includes.form_error')
            <section class="section background-white">
                <div class="line">
                    <h3 class="text-size-20 margin-bottom-10 text-center"><b>Comments :</b></h3>
                    <h3 class="text-size-20 margin-bottom-10 text-center">( please change status for viewed replies )</h3>
                    <table id="tab2" class="table" data-paging="true" data-filtering="true" data-sorting="true" >
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Comment</th>
                            <th>File</th>
                            <th>User</th>
                            <th>Reply</th>
                            <th>File</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($comments)
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{ date('d-M-y', strtotime($comment->created_at)) }}</td>
                                    <td>{{$comment->comment}}</td>
                                    <td><a href="{{ asset('images/' . $comment->file) }}">{{ $comment->file }}</a></td>
                                    <td>
                                        @if(!empty($comment->user->photo_id))
                                            <img src="{{ asset('/images/backend_images/users/'. $comment->user->photo_id) }}" style="width:30px;">
                                        @else
                                            <img src="{{ asset('/images/backend_images/users/user.png') }}" style="width:50px;">
                                        @endif{{$comment->user->name}}
                                    </td>
                                    <td>{{$comment->reply}}</td>
                                    <td><a href="{{ asset('/images/backend_images/comments/' . $comment->file_r) }}">{{ $comment->file_r }}</a></td>
                                    <td>
                                        @if($meeting->finished == 0)
                                            @if($comment->reply )
                                                @if($comment->checked == 1)
                                                    {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                                    <input type="hidden" name="checked" value="0">
                                                    <div class="form-group">
                                                        {!! Form::submit('Checked', ['class'=>'button button-primary-stroke']) !!}
                                                    </div>
                                                    {!! Form::close() !!}
                                                @else
                                                    {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                                    <input type="hidden" name="checked" value="1">
                                                    <div class="form-group">
                                                        {!! Form::submit('Not Checked', ['class'=>'button button-dark-stroke']) !!}
                                                    </div>
                                                    {!! Form::close() !!}
                                                @endif
                                            @endif
                                        @else
                                            @if($comment->reply )
                                                @if($comment->checked == 1)
                                                    <p style="color:dodgerblue"><b>CHECKED</b></p>
                                                @else
                                                    <p style="color:crimson"><b>NOT CHECKED</b></p>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </section>
        </article>

@endsection
        <script src="{{ asset('js/frontend_js/dropzone.js') }}"></script>