@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <div class="container my-5">
        <h1 class="display-1">Meus Eventos</h1>
        @if(count($events) < 1)
            <h4 class="text-black-50 text-center my-4">Você não possui eventos,<a style="text-decoration: none" href="{{ route('event.new') }}"> criar novo Evento!</a></h4>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">#</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td><a style="text-decoration: none" href="{{ route('event.single',['id'=>$event->id]) }}">{{ $event->title }}</a></td>
                        <td>{{ count($event->users) }}</td>
                        <td><a href="{{ route('event.edit',['id'=>$event->id]) }}" class="btn btn-warning">Editar</a></td>
                        <td>
                            <form action="{{ route('event.delete',['id'=>$event->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <h1 class="mt-5">Eventos que estou participando:</h1>
        @if(count($eventsAsParticipant) < 1)
            <h4 class="text-black-50 text-center my-4">Você não esta participando de nenhum evento,<a style="text-decoration: none" href="{{ route('events') }}"> buscar evento!</a></h4>
        @else
            <div class="row row-cols-4 justify-content-around">
                @foreach($eventsAsParticipant as $event)
                <div class="card col p-0 my-3" style="width: 18rem;">
                    <img src="/images/events/{{ $event->image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="text-black-50 m-0">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <p class="card-text text-black-50">{{ count($event->users) }} participantes</p>
                        <a href="{{ route('event.single',['id'=>$event->id]) }}" class="btn btn-primary">Saiba Mais</a>
                        <form style="display: inline-block" action="{{ route('event.leave',['id'=>$event->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sair</button>
                        </form>
                    </div><!--card-body-->
                </div><!--card-->
                @endforeach
            </div><!--row-colls-4-->
        @endif
    </div><!--container-->
@endsection
