class ListingTableRowView extends Alotofus.TableRowView
  fields:
    "name": {}
    "actions":
      "value": false
      "buttons":
        "edit":
          "icon":"pencil"

  events:
    "click .edit" : "editResource"

  editResource: ->
    do @showLoadingIcon
    row = @
    resource = new Model.ListingResource {id:@model.get('id'), resource: @model.resource}
    resource.fetch
      success: (translatedModel)->
        modal = new EditResourceModalView(model:translatedModel)
        do modal.openModal
        do row.hideLoadingIcon
        row.$el.find(".actions button").show()
      error: ->
        do row.hideLoadingIcon
        row.$el.find(".actions button").show()
        Alotofus.MessageView.showMessage message:Error, type:"error"

window.ListingTableRowView = ListingTableRowView