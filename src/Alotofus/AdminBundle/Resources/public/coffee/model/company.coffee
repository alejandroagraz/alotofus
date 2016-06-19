class Company extends Backbone.Model
  defaults: ->
    
  urlRoot: ->
    env = ""
    
    matches = window.location.href.match('app_[^]*.php')
    if matches then env = '/' + matches[0]  
    
    "#{env}/api/companies"

window.Model = window.Model || {}
window.Model.Company = Company