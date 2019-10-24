@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="event-header">
              <h1>LAN for everyWAN</h1>
              <button type="button" name="button">Join</button>
            </div>
            <div class="event-container">
              <div class="card">
                @image(['name'=>'dreamhack.jpg','alt'=>'event image','id'=>'event-image'])@endimage
                <h2>General informations</h2>
                @event_info(['id'=>'host','content'=>'Host: HE-Arc'])@endevent_info
                @event_info(['id'=>'location','content'=>'Location: Neuchâtel'])@endevent_info
                @event_info(['id'=>'price','content'=>'Price: Free'])@endevent_info
                @event_info(['id'=>'date','content'=>'Date: 30 oct. 2019'])@endevent_info
                @event_info(['id'=>'time','content'=>'Time: 9:00-22:00'])@endevent_info
                @event_info(['id'=>'seats','content'=>'Nb. seats: 100'])@endevent_info
                <h2>Description</h2>
                <div class="event-description">
                  Les vidéos vous permettent de faire passer votre message de façon convaincante. Quand vous cliquez sur Vidéo en ligne, vous pouvez coller le code incorporé de la vidéo que vous souhaitez ajouter. Vous pouvez également taper un mot-clé pour rechercher en ligne la vidéo qui convient le mieux à votre document.
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
