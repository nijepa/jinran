@extends('layouts.frontLayout.front_design')

@section('content')

    <!-- MAIN -->
    <main role="main">
        <article>
            <!-- Header -->
            <header class="section background-image text-center" style="background-image:url(/images/frontend_images/img-05.jpg)">
                <h1 class="animated-element slow text-white text-s-size-12 text-m-size-20 text-size-30 text-line-height-1 margin-bottom-10 margin-top-30 text-line-height-1">
                    <b>{{$project->company->name}}</b></h1>
                <p>
                    @if(!empty($project->company->photo_id))
                        <img src="{{ asset('/images/backend_images/companies/'. $project->company->photo_id) }}" class="center" >
                    @endif
                </p>
                <h1 class="animated-element slow text-white text-s-size-12 text-m-size-20 text-size-30 text-line-height-1 margin-bottom-10 margin-top-30 text-line-height-1">project detail </h1>
                <br />
                <p><b>Date :</b>
                <h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-1">{{ date('d-M-y', strtotime($projects->date_pd)) }}</h3></p>
                <p><b>Subtype :</b>
                <h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-1">{{$projects->subtype->name}}</h3></p>
                <p><b>Title :</b>
                <h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-1">{{$projects->title}}</h3></p>
                <p><b>Description :</b>
                <h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-2">{{$projects->description}}</h3></p>
                <br />
                <p class="animated-element text-dark-hover text-s-size-12 text-m-size-16 text-size-20">Please add task, upload documents, check status.</p>

                <!-- white full width arrow object -->
                <img class="arrow-object" src="/images/frontend_images/arrow-object-white.svg" alt="">
            </header>

            <section class="section background-dark">
                <div class="s-12 m-1 l-4 center">
                    <h3 class="text-size-20 margin-bottom-10 text-center"><b>Add Task & Upload Document :</b></h3>

                    <form class="customform text-white" method="post" action={{ url('author/add-solution/'. $projects->id) }}  enctype="multipart/form-data" name="add_solution" id="add_solution">{{ csrf_field() }}
                    <input type="hidden" name="meeting_id" value="{{$projects->id}}">
                    <div class="line">
                        <div class="s-12">
                            {!! Form::date('date_s', null, ['class'=>'required', 'name'=>'date_s', 'id'=>'date_s' ])!!}
                        </div>
                        <div class="s-12">
                            {!! Form::textarea('description', null, ['class'=>'required', 'placeholder'=>'Your description','rows'=>3, 'name'=>'description', 'id'=>'description' ])!!}
                        </div>
                        <h3 class="text-size-20 margin-bottom-10 text-center">
                            {!! Form::label('file', 'Upload documet :') !!}
                        </h3>
                        <input type="file" name="file" />
                        <div class="s-12"><button class="button border-radius text-white background-primary" type="submit">Submit Task</button></div>
                    </div>

                    </form>
                </div>
            </section>
            @include('includes.form_error')
            <section class="section background-white">
                <div class="line">
                    <h3 class="text-size-20 margin-bottom-10 text-center"><b>Tasks : </b></h3>
                    <h3 class="text-size-20 margin-bottom-10 text-center">( please change status for finished tasks )</h3>
                    <table id="tab2" class="table" data-paging="true" data-filtering="true" data-sorting="true" >
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>File</th>
                            <th>User</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($solutions)
                            @foreach($solutions as $solution)
                                <tr>
                                    <td>{{ date('d-M-y', strtotime($solution->created_at)) }}</td>
                                    <td>{{$solution->description}}</td>
                                    <td><a href="{{ asset('images/backend_images/solutions/' . $solution->file) }}">{{ $solution->file }}</a></td>
                                    <td>@if(!empty($solution->user->photo_id))
                                            <img src="{{ asset('/images/backend_images/users/'. $solution->user->photo_id) }}" style="width:30px;">
                                        @else
                                            <img src="{{ asset('/images/backend_images/users/user.png') }}" style="width:50px;">
                                        @endif{{$solution->user->name}}
                                    </td>
                                    <td>
                                        @if($project->finished == 0)
                                            @if($solution->finished == 1)
                                                <form method="post" action={{ url('author/update-solution/' . $solution->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                    <input type="hidden" name="finished" value="0">
                                                    <div class="form-group">
                                                        <input type="submit" value="FINISHED" class="button button-primary-stroke">
                                                    </div>
                                                </form>
                                            @else
                                                <form method="post" action={{ url('author/update-solution/' . $solution->id) }} name="comment_update" id="comment_update" novalidate="novalidate">{{ csrf_field() }}
                                                    <input type="hidden" name="finished" value="1">
                                                    <div class="form-group">
                                                        <input type="submit" value="ACTIVE" class="button button-dark-stroke">
                                                    </div>
                                                </form>
                                            @endif
                                        @else
                                            @if($solution->finished == 1)
                                                <p style="color:dodgerblue"><b>FINISHED</b></p>
                                            @else
                                                <p style="color:crimson"><b>ACTIVE</b></p>
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