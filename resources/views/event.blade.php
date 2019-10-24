@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
            <div class="d-flex flex-wrap justify-content-start">
              <h1>LAN for everyWAN LAN for everyWAN</h1>
              <div class="mx-2">
                <button type="button" name="button" class="btn btn-primary"><i class="fa fa-plus mx-1" aria-hidden="true"></i>Join</button>
              </div>

            </div>
            <div class="card p-3">
              <div class="row">
                <div class="col">
                  @image(['name'=>'dreamhack.jpg','alt'=>'event image','id'=>'event-image'])@endimage
                </div>

                <div class="col">
                  <h2>General informations</h2>
                  <div class="row my-2">
                    @event_info(['id'=>'host','name'=>'Host','value'=>'HE-Arc'])@endevent_info
                    @event_info(['id'=>'location','name'=>'Location','value'=>'Neuchâtel'])@endevent_info
                  </div>
                  <div class="row my-2">
                    @event_info(['id'=>'price','name'=>'Price','value'=>'Free'])@endevent_info

                    @event_info(['id'=>'date','name'=>'Host','value'=>'30 oct. 2019'])@endevent_info
                  </div>
                  <div class="row my-2">
                    @event_info(['id'=>'time','name'=>'Time','value'=>'9:00-22:00'])@endevent_info
                    @event_info(['id'=>'seats','name'=>'Nb. seats','value'=>'100'])@endevent_info
                  </div>
                </div>
              </div>
              <div class="row m-0 my-2">
                <h2>Description</h2>
                <div>
                  Les vidéos vous permettent de faire passer votre message de façon convaincante. Quand vous cliquez sur Vidéo en ligne, vous pouvez coller le code incorporé de la vidéo que vous souhaitez ajouter. Vous pouvez également taper un mot-clé pour rechercher en ligne la vidéo qui convient le mieux à votre document.
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
