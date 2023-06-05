@extends('adminlte::page')

@section('title', "Detalhes do $plan->name ")

@section('content_header')
    <h1> Detalhes do <b>{{ $plan->name }}</b> </h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $plan->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $plan->url }}
                </li>
                <li>
                    <strong>Preço: </strong>R$ {{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Descrção: </strong> {{ $plan->description }}
                </li>
            </ul>

        </div>
        <div class="card-footer">
            <form action="{{ route('plans.destroy', $plan->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETAR O PLANO {{ $plan->name }}</button>
            </form>

        </div>
    </div>
@stop
