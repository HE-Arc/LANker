$('#username').autocomplete({
  paramName: 'name',
  transformResult: function(response) {
    // console.log(response);
    let userData = JSON.parse(response)
    // console.log(gameData);
    let usernameObjectArray = []

    userData.forEach(dataItem => usernameObjectArray.push({value:dataItem.name, data:dataItem.id})) // TODO : regler ça puis donner le data a l'autocomplete
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
    return {suggestions:usernameObjectArray}
  },
  serviceUrl: '/LANker/public/autocomplete',
  // lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
  //   var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
  //   return re.test(suggestion.value);
  // },
  onSelect: function(suggestion) {
    let id = suggestion.data
    let name = suggestion.value
    $('#username').value=name;
  }
  // onHint: function (hint) {
  //   $('#autocomplete-ajax-x').val(hint);
  // },
  // onInvalidateSelection: function() {
  //   $('#selction-ajax').html('You selected: none');
  // }
});
