// $('#game').autocomplete({
//   source: []
// })

let gameArray = []
var results = []
$('#game').keydown(function(e){
  if($(this).val().length >= 3 && e.which != 13) {
    $.get({
      url: '/LANker/public/autocomplete',
      data: {name:$('#game').val()},
      success: function (data, textStatus, jqXHR) {
        console.log(data);
        let json_data = JSON.parse(data)
        var game_names = json_data.map(item => item['name'])
        results = game_names
        console.log(game_names);
        $('#game').autocomplete({
          source: game_names
        })
      }
    });
  }
  if (e.which == 13) {
    if (results.includes($(this).val()) && !gameArray.includes($(this).val())) {
      let id = $(this).val()
      gameArray.push(id)
      let tag = $('<p>', {
        id: id,
        "class": 'lanker-tag',
        text: id,
        click: function() {
          let gameIndex = gameArray.indexOf(tag.attr('id'));
          tag.remove()
          gameArray.splice(gameIndex, 1)
          console.log("removed");

        }
      })
      $('#game_tags').append(tag)
    }
  }
})
