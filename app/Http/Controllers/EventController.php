<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){

        $search = request('search');

        if($search){
            $events = Event::where([
                ['title','like','%'.$search.'%']
            ])->get();
        }else{
            $events = Event::all();
        }

        return view('site.events.index',['title' => 'events','events' => $events,'search'=>$search]);
    }

    public function create(){
        $title = 'new event';
        return view('site.events.create',['title' => $title]);
    }

    public function store(Request $request){
        $event = new Event();

        $event->title = $request->title;
        $event->description = $request->description;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->items = $request->items;
        $event->date = $request->date;

        $user = auth()->user();
        $event->user_id = $user->id;

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;

            $extension = $requestImage->extension();
            $nameImage = uniqid() . strtotime('now') . '.' . $extension;

            $requestImage->move(public_path('images/events'), $nameImage);

            $event->image = $nameImage;
            $event->save();

            $success = true;
            $message = 'Evento criado com sucesso!';

            return redirect()->route('events')->with([
                'title' => 'Criar Evento',
                'success' => $success,
                'message' => $message,
            ]);
        }else{
            $success = false;
            $message = 'Imagem Invalida!';

            return redirect()->route('events')->with([
                'title' => 'Criar Evento',
                'success' => $success,
                'message' => $message,
            ]);
        }
    }

    public function show($id){
        $event = Event::findOrFail($id);
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        $user = auth()->user();
        $hasUserJoined = false;

        if($user){
            $userEvents = $user->eventAsParticipant->toArray();
            foreach ($userEvents as $userEvent){
                if ($userEvent['id'] == $id){
                    $hasUserJoined = true;
                    break;
                }
            }

        }

        return view('site.events.single',[
            'event' => $event,
            'eventOwner'=>$eventOwner,
            'title'=>'events',
            'hasUserJoined'=>$hasUserJoined
        ]);
    }

    public function dashboard(){
        $user = auth()->user();
        $events = $user->events;

        $eventsAsParticipant = $user->eventAsParticipant;

        return view('/dashboard',[
            'events'=>$events,
            'title'=>'dashboard',
            'user'=>$user,
            'eventsAsParticipant'=>$eventsAsParticipant
        ]);
    }

    public function destroy($id){
        Event::findOrFail($id)->delete();

        return redirect()->route('dashboard')->with([
            'title' => 'dashboard',
            'success' => false,
            'message' => 'Evento deletado com sucesso!',
        ]);
    }

    public function edit($id){
        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user_id){
            return redirect()->route('dashboard')->with(['title'=>'dashboard']);
        }

        return view('site.events.edit',['event'=>$event,'title'=>'dashboard']);
    }

    public function update(Request $request){
        $data = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;

            $extension = $requestImage->extension();
            $nameImage = uniqid() . strtotime('now') . '.' . $extension;

            $requestImage->move(public_path('images/events'), $nameImage);

            $data['image'] = $nameImage;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect()->route('dashboard')->with([
            'title' => 'dashboard',
            'success' => true,
            'message' => 'Evento Atualizado com sucesso',
        ]);

    }

    public function join($id){
        $user = auth()->user();

        $user->eventAsParticipant()->attach($id);
        $event = Event::findOrFail($id);

        return redirect()->route('dashboard')->with([
            'title' => 'dashboard',
            'success' => true,
            'message' => 'Sua presença esta confirmada no evento!',
        ]);
    }

    public function leave($id){
        $user = auth()->user();

        $user->eventAsParticipant()->detach($id);
        $event = Event::findOrFail($id);

        return redirect()->route('dashboard')->with([
            'title' => 'dashboard',
            'success' => true,
            'message' => 'Você sair do evento '.$event->title,
        ]);
    }

}
