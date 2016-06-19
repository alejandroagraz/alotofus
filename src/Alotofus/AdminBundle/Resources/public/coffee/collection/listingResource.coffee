class ListingResourceCollection extends Backbone.Collection
  model: Model.ListingResource

  initialize: (models, args) ->
    @resource = args.resource

  url: ->
    env = ""

    matches = window.location.href.match('app_[^]*.php')
    if matches then env = '/' + matches[0]

    "#{env}/api/#{@resource}"

window.Collection = window.Collection || {}
window.Collection.ListingResource = ListingResourceCollection