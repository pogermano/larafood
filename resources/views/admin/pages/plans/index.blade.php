@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}">Planos</a></li>
</ol>
<br>
    <h1>Planos <a class="btn btn-dark" href="{{ route('plans.create') }}"><i class="fas fa-plus-square"> Novo</i></a></h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control"  value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Preços</th>
                        <th width='50'>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                            <td style="width=10px;"> <a href="{{ route('plans.edit', $plan->url) }}"
                                    class="btn btn-info">EDIT</a></td>
                            <td style="width=10px;"> <a href="{{ route('plans.show', $plan->url) }}"
                                    class="btn btn-warning">VER</a></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $plans->appends($filters)->links('pagination::bootstrap-5') }}

            @else
                {{ $plans->links('pagination::bootstrap-5') }}

            @endif


        </div>
    </div>
@stop
