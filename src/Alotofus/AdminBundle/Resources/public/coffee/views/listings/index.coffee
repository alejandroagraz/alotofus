class ListingIndexView extends Alotofus.TableView
  el : $(".listing-table")

  initialize: ->
    super
    table = @

    $filters = @$el.find(".table-filter")
    @$nameFilter = $filters.children("input[data-filter='name']")
    @resource = @$el.attr('data-resource')
    @collection = new Collection.ListingResource [], resource: @resource
    do @fetchTable

  events:
    "click .create-resource": "showCreateModal"

  fetchTable: ->
    table = @
    filter = {page: @currentPage, count: 10}
    if @$nameFilter.val() isnt ''
      filter.q = @$nameFilter.val()

    @collection.fetch(
      data: filter
      success: (resources) ->
        table.fillTable resources
        do table.activatePageIcons
    )

  fillTable: (resources) ->
    @$tableContent.html ''
    if resources.models.length == 0
      @$tableContent.append "<tr><td colspan=7>No se han encontrado datos para su busqueda</td></tr>"
    for res in resources.models
      res.resource = @resource
      row = new ListingTableRowView
        model : res
      @rows.push row
      @$tableContent.append row.render().el

  showCreateModal: ->
    modal = new EditResourceModalView(model:new Model.ListingResource({resource:@$el.attr('data-resource')}))
    do modal.openModal

window.ListingIndexView = ListingIndexView

$(document).ready ->
  window.listingIndexView = new ListingIndexView()