@extends('layouts.main')
@section('title','Criar Evento')
@section('content')
    <section class="new-event py-5">
        <div class="container" style="max-width: 800px">
            <h1 class="text-center mb-3">Criar novo evento:</h1>
            <form action="{{ route('event.new.form') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupFile01">Imagem do Evento</label>
                    <input name="image" type="file" class="form-control" id="inputGroupFile01" value="{{old('image')}}">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Evento:</span>
                    <input type="text" value="{{old('title')}}" class="form-control" name="title" placeholder="Nome do evento..." aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Data do Evento:</span>
                    <input type="date" value="{{old('date')}}" class="form-control" name="date" placeholder="Nome do evento..." aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Cidade:</span>
                    <input type="text" name="city" value="{{old('city')}}" class="form-control" placeholder="Cidade do evento..." aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">O evento é privado?</label>
                    <select class="form-select" name="private" value="{{old('private')}}" id="inputGroupSelect01">
                        <option selected>Selecione</option>
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>

                <div class="input-group">
                    <span class="input-group-text">Descrição</span>
                    <textarea class="form-control" name="description" aria-label="With textarea" placeholder="Descrição do evento..."></textarea>
                </div>

                <h3 class="mt-2">Itens de infraestrutura:</h3>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Cadeiras" name="items[]" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Cadeiras
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Palco" name="items[]" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">
                        Palco
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Bebidas Grátis" name="items[]" id="defaultCheck3">
                    <label class="form-check-label" for="defaultCheck3">
                        Bebidas Grátis
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Open food" name="items[]" id="defaultCheck4">
                    <label class="form-check-label" for="defaultCheck4">
                        Open food
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Brindes" name="items[]" id="defaultCheck5">
                    <label class="form-check-label" for="defaultCheck5">
                        Brindes
                    </label>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Criar Evento</button>
                </div>
            </form>
        </div><!--container-->
    </section><!--new-=event-->

    <div class="p-5 mt-3 bg-light rounded-3">
        <div class="container-fluid py-5"></div>
    </div>
@endsection
