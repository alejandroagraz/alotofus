class InvitationTableRowView extends Alotofus.TableRowView
  fields: 
    "selector": 
      "input":"checkbox"
      "value": false
    "name": {}
    "surname": {}
    "email": {}
    "validated": 
      "boolean": true
      "value": false
    "created_at": {}
    "actions": 
      "value": false
      "buttons":
        "send-invitation":
          "icon":"invitation"

  events: 
    "click .send-invitation" : "sendInvitation"

  render: ->
    super

    if @model.get('activated') is true
      @$el.find('.send-invitation').hide()

    @

  sendInvitation: ->
    row = @
    #Show progress bar
    do @showLoadingIcon
    $.post(@invitationApiUrl())
      .done ->
        row.$el.fadeOut 500, -> 
          Alotofus.MessageView.showMessage message:Translator.get("alotofus.admin.invitations.send.success"), type:"success"
          do row.undelegateEvents
          do row.remove
      .fail ->
        Alotofus.MessageView.showMessage message:Translator.get("alotofus.admin.invitations.send.error"), type:"error"
        row.$el.children(".actions").show()


  invitationApiUrl: ->
      env = ""
      
      matches = window.location.href.match('app_[^]*.php')
      if matches then env = '/' + matches[0]  
      
      "#{env}/api/users/#{@model.get('id')}/invitations"
    
window.InvitationTableRowView = InvitationTableRowView