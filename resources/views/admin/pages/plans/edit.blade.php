@extends('adminlte::page')

@section('title', "Editar o Plano: $plan->name")

@section('content_header')
    <h1>Editar {{ $plan->name }} </h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">
<form action="{{ route('plans.update', $plan->id) }}" class="form" method="POST">
    @csrf
    @method('PUT')

@include('admin.pages.plans._partials.form')
</form>
        </div>
        <div class="card-footer">


        </div>
    </div>
@stop
