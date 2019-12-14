// var nhlTeams = ['Anaheim Ducks', 'Atlanta Thrashers', 'Boston Bruins', 'Buffalo Sabres', 'Calgary Flames', 'Carolina Hurricanes', 'Chicago Blackhawks', 'Colorado Avalanche', 'Columbus Blue Jackets', 'Dallas Stars', 'Detroit Red Wings', 'Edmonton OIlers', 'Florida Panthers', 'Los Angeles Kings', 'Minnesota Wild', 'Montreal Canadiens', 'Nashville Predators', 'New Jersey Devils', 'New Rork Islanders', 'New York Rangers', 'Ottawa Senators', 'Philadelphia Flyers', 'Phoenix Coyotes', 'Pittsburgh Penguins', 'Saint Louis Blues', 'San Jose Sharks', 'Tampa Bay Lightning', 'Toronto Maple Leafs', 'Vancouver Canucks', 'Washington Capitals'];
// var nbaTeams = ['Atlanta Hawks', 'Boston Celtics', 'Charlotte Bobcats', 'Chicago Bulls', 'Cleveland Cavaliers', 'Dallas Mavericks', 'Denver Nuggets', 'Detroit Pistons', 'Golden State Warriors', 'Houston Rockets', 'Indiana Pacers', 'LA Clippers', 'LA Lakers', 'Memphis Grizzlies', 'Miami Heat', 'Milwaukee Bucks', 'Minnesota Timberwolves', 'New Jersey Nets', 'New Orleans Hornets', 'New York Knicks', 'Oklahoma City Thunder', 'Orlando Magic', 'Philadelphia Sixers', 'Phoenix Suns', 'Portland Trail Blazers', 'Sacramento Kings', 'San Antonio Spurs', 'Toronto Raptors', 'Utah Jazz', 'Washington Wizards'];
// var nhl = $.map(nhlTeams, function (team) { return { value: team, data: { category: 'NHL' }}; });
// var nba = $.map(nbaTeams, function (team) { return { value: team, data: { category: 'NBA' } }; });
// var teams = nhl.concat(nba);
//
// // Initialize autocomplete with local lookup:
// $('#gameInput').devbridgeAutocomplete({
//     lookup: teams,
//     minChars: 1,
//     onSelect: function (suggestion) {
//         $('#selection').html('You selected: ' + suggestion.value + ', ' + suggestion.data.category);
//     },
//     showNoSuggestionNotice: true,
//     noSuggestionNotice: 'Sorry, no matching results',
//     groupBy: 'category'
// });

// ====================================== DEMO END

let gameArray = []
// var results = []

// Initialize ajax autocomplete: WILL NOT WORK BECAUSE FORMAT IS NOT THE SAME AS APIs
// SEE : https://www.devbridge.com/sourcery/components/jquery-autocomplete/#jquery-autocomplete-response-format
$('#gameInput').autocomplete({
  paramName: 'name',
  transformResult: function(response) {
    // console.log(response);
    let gameData = JSON.parse(response)
    console.log(gameData);
    let gameObjectArray = []

    gameData.forEach(dataItem => gameObjectArray.push({value:dataItem.name, data:dataItem.id})) // TODO : regler ça puis donner le data a l'autocomplete
    // console.log({suggestions:gameObjectArray});

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
  // lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
  //   var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
  //   return re.test(suggestion.value);
  // },
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
  // onHint: function (hint) {
  //   $('#autocomplete-ajax-x').val(hint);
  // },
  // onInvalidateSelection: function() {
  //   $('#selction-ajax').html('You selected: none');
  // }
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
