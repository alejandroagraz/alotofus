class InvitationsIndexView extends Alotofus.TableView
    el : $(".invitations-table")

    initialize: ->
        super
        table = @

        $filters = @$el.find(".table-filter")
        @$emailFilter = $filters.children("input[data-filter='email']")
        @$activatedFilter = $filters.children("select[data-filter='activated']")
        
        do @fetchTable

    events: 
        "click .send-invitations": "sendInvitations"

    fetchTable: ->
        table = @
        filter = {page: @currentPage, limit: 10}
        if @$emailFilter.val() isnt ''
            filter.email = @$emailFilter.val()
        if @$activatedFilter.val() isnt ''
            filter.activated = @$activatedFilter.val()
        Collection.User.fetch( 
            data: filter
            success: (users) -> 
               table.fillTable users
               do table.activatePageIcons  
        )

    fillTable: (users) ->
        @$tableContent.html ''
        if users.models.length == 0
            @$tableContent.append "<tr><td colspan=7>No se han encontrado datos para su busqueda</td></tr>"
        for user in users.models
            row = new InvitationTableRowView
                model : user
            @rows.push row
            @$tableContent.append row.render().el

    sendInvitations: ->
        for row in @rows
            if row.isSelected
                do row.sendInvitation


window.InvitationsIndexView = InvitationsIndexView

$(document).ready ->
  new InvitationsIndexView();