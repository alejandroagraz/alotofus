class CompanyCollection extends Backbone.Collection
  model: Model.Company

  url: ->
    env = ""
    
    matches = window.location.href.match('app_[^]*.php')
    if matches then env = '/' + matches[0]  
    
    "#{env}/api/companies"

window.Collection = window.Collection || {}
window.Collection.Company = new CompanyCollection()