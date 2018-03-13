@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul>
                            @foreach($appuntamenti as $app)
                                <h2>{{ $app->nome }}</h2>
                                <h4>{{ Carbon\Carbon::parse($app->data)->format('d/m/Y') }}</h4>
                                <p>{{ $app->note }}</p>
                                <hr>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection