@extends('laravel-sender::layout')

@section('content')
    <h2 class="page-title">Create email job</h2>
    <div class="col-md-12">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal" method="post" action="{{route('sender.jobs.store')}}"
              enctype="multipart/form-data">
            {!!  csrf_field()  !!}
            @include('laravel-sender::job._form')
        </form>
    </div>
@endsection