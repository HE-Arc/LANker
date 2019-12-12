$('#username').autocomplete({
  paramName: 'name',
  transformResult: function(response) {
    // console.log(response);
    let userData = JSON.parse(response)
    let usernameObjectArray = []

    userData.forEach(dataItem => usernameObjectArray.push({value:dataItem.name, data:dataItem.id})) // TODO : regler ça puis donner le data a l'autocomplete
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
  serviceUrl: '/LANker/public/autocomplete_username',
  onSelect: function(suggestion) {
    let id = suggestion.data
    let name = suggestion.value
    console.log(name);
    $('#username').value=name;
  }
});
