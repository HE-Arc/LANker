let gameArray = []

// Initialize ajax autocomplete: WILL NOT WORK BECAUSE FORMAT IS NOT THE SAME AS APIs
// SEE : https://www.devbridge.com/sourcery/components/jquery-autocomplete/#jquery-autocomplete-response-format
$('#gameInput').autocomplete({
  paramName: 'name',
  transformResult: function(response) {
    let gameData = JSON.parse(response)
    let gameObjectArray = []
    let gameCoverArray = []
    console.log(gameData);

    gameData.forEach(dataItem => {
      gameObjectArray.push({value:dataItem.name, data:dataItem.id})
      // if (dataItem.cover != undefined) {
      //   let url = dataItem.cover.url
      //   url.replace(/t_thumb/, 't_cover_big')
      //   gameCoverArray.push(url)
      // }
    })

    console.log({suggestions:gameObjectArray});
    // console.log(gameCoverArray);

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
  serviceUrl: '/LANker/public/autocomplete',
  onSelect: function(suggestion) {
    let id = suggestion.data
    let name = suggestion.value
    if(!gameArray.includes(name)) {
      gameArray.push(name)

      let tag = $('<p>', {
        id: id,
        "class": 'lanker-tag btn btn-primary mr-2',
        text: name,
        click: function() {
          let gameIndex = gameArray.indexOf(tag.attr('name'));
          tag.remove()
          gameArray.splice(gameIndex, 1)
          createHiddenInputWithGames(gameArray)
        }
      })

      createHiddenInputWithGames(gameArray)
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
