@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {!! Form::open(['route' => 'image-resize', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                            <input type="file" id="image" name="image" accept="image/*">
                            <button type="submit" class="btn btn-success btn-sm btn-block">Resize</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
