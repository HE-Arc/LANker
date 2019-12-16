let gameArray = []
let coverArray = []
var gameCoverArray = []

// Initialize ajax autocomplete: WILL NOT WORK BECAUSE FORMAT IS NOT THE SAME AS APIs
// SEE : https://www.devbridge.com/sourcery/components/jquery-autocomplete/#jquery-autocomplete-response-format

$('#gameInput').keydown(function(event){
  if(event.keyCode == 13) {
    event.preventDefault();
    return false;
  }
});

$('#gameInput').autocomplete({
  paramName: 'name',
  transformResult: function(response) {
    let gameData = JSON.parse(response)
    let gameObjectArray = []
    gameCoverArray=[];

    gameData.forEach(dataItem => {
      gameObjectArray.push({value:dataItem.name, data:dataItem.id})
      if (dataItem.cover != undefined) {
        let url = dataItem.cover.url
        url=url.replace(/t_thumb/, 't_cover_big')
        gameCoverArray.push({id:dataItem.id,url:url})
      }
    })
    /*
    * Required format by devbridge autocomplete :
    * { suggestions:
    *   [
    *   {value:"Value1", data: 1},
    *   {value:"Value2", data: 2},
    *   {value:"Value3", data: 3},
    *   ...
    *   ]
    * }
    */
    return {suggestions:gameObjectArray}
  },
  serviceUrl: 'LANker/public/autocomplete',
  onSelect: function(suggestion) {
    let id = suggestion.data
    let name = suggestion.value
    if(!gameArray.includes(name)) {
      gameArray.push(name)
      let cover = gameCoverArray.find(x=>x.id==id)
      if (cover != undefined) {
        coverArray.push(cover.url)
      }else{
        coverArray.push("https://images.igdb.com/igdb/image/upload/t_cover_big/ya81ui.jpg")
      }

      let tag = $('<p>', {
        id: id,
        "class": 'lanker-tag btn btn-primary mr-2',
        text: name,
        click: function() {
          let gameIndex = gameArray.indexOf(tag.attr('name'))
          let coverIndex = gameCoverArray.findIndex(x=>x.id==id)
          tag.remove()
          gameArray.splice(gameIndex, 1)
          coverArray.splice(coverIndex,1)
          createHiddenInputWithGames(gameArray)
          createHiddenInputWithCover(coverArray)
        }
      })

      createHiddenInputWithGames(gameArray)
      createHiddenInputWithCover(coverArray)
      $('#game_tags').append(tag)
    }
    $('#gameInput').val('')
  }
});

function createHiddenInputWithGames(gameArray) {
  if($('#hiddenGames').length) {
    $('#hiddenGames').remove()
  }

  let hiddenGames = $('<input>', {
    type: 'hidden',
    name: 'games',
    id: 'hiddenGames',
    value: gameArray
  })

  $('#eventForm').append(hiddenGames)
}

function createHiddenInputWithCover(gameCover) {
  if($('#hiddenCovers').length) {
    $('#hiddenCovers').remove()
  }
  let hiddenGames = $('<input>', {
    type: 'hidden',
    name: 'covers',
    id: 'hiddenCovers',
    value: gameCover
  })

  $('#eventForm').append(hiddenGames)
}
