class CompanyTableRowView extends Alotofus.TableRowView
  fields: 
    "selector": 
      "input":"checkbox"
      "value": false
    "name": {}
    "email": {}
    "company_id": {}
    "activated": 
      "value": false
      "boolean": true
    "created_at": {}
    "actions": 
      "value": false
      "buttons":
        "accept-company":
          "icon":"tick"
        "delete-company":
          "icon":"bin"
        "deactivate-company":
          "icon":"cross"

  events: 
    "click .accept-company" : "acceptCompany"
    "click .delete-company" : "deleteCompany"
    "click .deactivate-company" : "deactivateCompany"

  render: ->
    super

    do @showActions
      
    @

  acceptCompany: ->
    row = @
    #Show progress icon
    do @showLoadingIcon
    $.post(@acceptApiUrl())
      .done ->
        Alotofus.MessageView.showMessage message:Translator.get("alotofus.admin.company.accept.success"), type:"success"
        do companyIndexView.filterTable
      .fail ->
        Alotofus.MessageView.showMessage message:Translator.get("alotofus.admin.company.accept.error"), type:"error"
        row.$el.children(".actions").show()
        do row.showActions
        #Show something to tell an error happened

  deleteCompany: ->
    conf = confirm "Are you sure you want to delete #{@model.get('name')}?"
    if conf
      row = @
      do @showLoadingIcon
      @model.destroy
        success: ->
          Alotofus.MessageView.showMessage message:Translator.get("alotofus.admin.company.delete.success"), type:"success"
          do companyIndexView.filterTable
        error: ->
          Alotofus.MessageView.showMessage message:Translator.get("alotofus.admin.company.delete.error"), type:"error"
          alert 'Error deleting company'
          do row.showActions

  deactivateCompany: ->
    row = @
    do @showLoadingIcon
    $.post(@deactivateApiUrl())
      .done ->
        Alotofus.MessageView.showMessage message:Translator.get("alotofus.admin.company.deactivate.success"), type:"success"
        do companyIndexView.filterTable
      .fail ->
        Alotofus.MessageView.showMessage message:Translator.get("alotofus.admin.company.deactivate.error"), type:"error"
        row.$el.children(".actions").show()
        do row.showActions
        #Show something to tell an error happened

  showActions: ->
    if @model.get('activated') is true
      @$el.find('.accept-company').hide()
      @$el.find('.delete-company').hide()
    else
      @$el.find('.deactivate-company').hide()

    do @hideLoadingIcon

  acceptApiUrl: ->
      env = ""
      
      matches = window.location.href.match('app_[^]*.php')
      if matches then env = '/' + matches[0]  
      
      "#{env}/api/companies/#{@model.get('id')}/accepts"

  deactivateApiUrl: ->
      env = ""
      
      matches = window.location.href.match('app_[^]*.php')
      if matches then env = '/' + matches[0]  
      
      "#{env}/api/companies/#{@model.get('id')}/deactivates"
    
window.CompanyTableRowView = CompanyTableRowView