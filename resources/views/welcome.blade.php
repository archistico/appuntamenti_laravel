@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista appuntamenti</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul>
                            @php
                                $dataPrec = '';
                                $dataString = '';
                            @endphp

                            @foreach($appuntamenti as $app)

                                    @php
                                        $dataString = Carbon\Carbon::parse($app->data)->format('d/m/Y');
                                        if($dataPrec!=$dataString) {
                                            $dataPrec = $dataString;
                                            $giorno = ucfirst($app->giorno);
                                            echo "<div class='alert alert-info' role='alert'><h2>$giorno - $dataString</h2></div>";
                                        }
                                    @endphp
                                <li>
                                    <div class="float-right">
                                        <a class="btn btn-outline-info btn-sm" href="{{ route('edit', ['id' => $app->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-outline-info btn-sm" href="{{ route('delete', ['id' => $app->id]) }}"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <h4><span class="text-secondary">{{ $app->ora }}</span> <strong>{{ $app->nome }}</strong></h4>
                                    <p><em>{{ $app->note }}</em></p>

                                    <hr>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection