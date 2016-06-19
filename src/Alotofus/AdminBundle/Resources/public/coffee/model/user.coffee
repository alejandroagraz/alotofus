class User extends Backbone.Model
  defaults: ->
    
  urlRoot: ->
    env = ""
    
    matches = window.location.href.match('app_[^]*.php')
    if matches then env = '/' + matches[0]  
    
    "#{env}/api/users"

window.Model = window.Model || {}
window.Model.User = User