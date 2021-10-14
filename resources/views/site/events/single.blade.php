@extends('layouts.main')
@section('title', $event->title)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md">
                <img class="img-fluid" src="/images/events/{{ $event->image }}">
            </div><!--col-md-->
            <div class="col-md">
                <h1 class="display-2">{{ $event->title }}</h1>
                <div class="mx-3">
                    <p>
                        <svg style="color: #ffcc40" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                        </svg>
                        {{ $event->city }}
                    </p>
                    <p>
                        <svg style="color: #ffcc40" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                        </svg>
                        {{ count($event->users) }} participantes
                    </p>
                    <p>
                        <svg style="color: #ffcc40" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        {{ $eventOwner['name'] }}
                    </p>
                    @if($hasUserJoined == false)
                    <form action="{{ route('event.join',['id'=>$event->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary text-white"><strong>Confirmar Presença</strong></button>
                    </form>
                    @else
                        <h5 class="text-black-50">Você já esta participando do evento!</h5>
                        <form style="display: inline-block" action="{{ route('event.leave',['id'=>$event->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sair do Evento</button>
                        </form>
                    @endif
                </div><!--max-2-->
            </div><!--col-md-->
            <div class="col-md-12">
                <h1>Sobre o Evento</h1>
                <p>{{ $event->description }}</p>
                <h3>O evento conta com:</h3>
                <ul>
                    @foreach($event->items as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div><!--col-md-12-->
        </div><!--row-->

    </div><!--container-->
    <div class="p-5 mt-3 bg-light rounded-3">
        <div class="container-fluid py-5"></div>
    </div>
@endsection
