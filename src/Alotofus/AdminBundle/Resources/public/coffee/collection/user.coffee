class UserCollection extends Backbone.Collection
  model: Model.User

  url: ->
    env = ""
    
    matches = window.location.href.match('app_[^]*.php')
    if matches then env = '/' + matches[0]  
    
    "#{env}/api/users"

window.Collection = window.Collection || {}
window.Collection.User = new UserCollection()