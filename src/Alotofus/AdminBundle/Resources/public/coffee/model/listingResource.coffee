class ListingResource extends Backbone.Model
  initialize: (args) ->
    @resource = args.resource

  defaults:
    "translations":
      "en":
        "name": ""
      "es":
        "name": ""
      "eu":
        "name": ""

  urlRoot: ->
    env = ""

    matches = window.location.href.match('app_[^]*.php')
    if matches then env = '/' + matches[0]

    "#{env}/api/#{@resource}"

window.Model = window.Model || {}
window.Model.ListingResource = ListingResource