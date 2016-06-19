class CompanyIndexView extends Alotofus.TableView
    el : $(".companies-table")

    initialize: ->
        super
        table = @
        
        $filters = @$el.find(".table-filter")
        @$emailFilter = $filters.children("input[data-filter='email']")
        @$nameFilter = $filters.children("input[data-filter='name']")
        @$activatedFilter = $filters.children("select[data-filter='activated']")

        do @fetchTable
    
    events: 
        "click .accept-companies": "acceptCompanies"

    acceptCompanies: ->
        for row in @rows
            if do row.isSelected
                do row.acceptCompany
        
    fetchTable: ->
        table = @
        filter = {page: @currentPage, limit: 10}
        if @$emailFilter.val() isnt ''
            filter.email = @$emailFilter.val()
        if @$nameFilter.val() isnt ''
            filter.name = @$nameFilter.val()
        if @$activatedFilter.val() isnt ''
            filter.activated = @$activatedFilter.val()
        if @orderColumn? and @orderType?
            filter.orderBy = @orderColumn
            filter.order = @orderType.toUpperCase()
        Collection.Company.fetch( 
            data: filter
            success: (companies) -> 
               table.fillTable companies
               do table.activatePageIcons 
        )

    fillTable: (companies) ->
        @$tableContent.html ''
        if companies.models.length == 0
            @$tableContent.append "<tr><td colspan=7>No se han encontrado datos para su busqueda</td></tr>"
        for company in companies.models
            row = new CompanyTableRowView
                model : company
            @rows.push row
            @$tableContent.append row.render().el        


window.CompanyIndexView = CompanyIndexView

$(document).ready ->
  window.companyIndexView = new CompanyIndexView();