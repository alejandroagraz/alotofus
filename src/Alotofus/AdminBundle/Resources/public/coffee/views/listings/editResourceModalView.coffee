class EditResourceModalView extends Alotofus.ModalView
    content: _.template "<h2>"+Translator.get('alotofus.generic.create')+" </h2>
          <form id='translations-form' class='center-form'>
              <label>English</label>
              <input type='text' placeholder='' name='translations_en' value='<%- name %>' required='required'>
              <label>Castellano</label>
              <input type='text' placeholder='' name='translations_es' value='<%- translations.es != undefined ? translations.es.name : '' %>'>
              <label>Euskera</label>
              <input type='text' placeholder='' name='translations_eu' value='<%- translations.eu != undefined ? translations.eu.name : '' %>'>
              <input type='submit' value='"+Translator.get('alotofus.generic.send')+"'>
              <i class='loading' data-icon='loading' style='display: none;'></i>
          </form>
          "

    events:
      "click #translations-form > input[type='submit']": "submitChanges"

    initialize: ->
      super

      @setContent @content(@model.toJSON())

      @$translationsForm = @$el.find "#translations-form"

    submitChanges: (e)->
      e.preventDefault()
      do @$translationsForm.find('.loading').show
      do @$translationsForm.find("input[type='submit']").hide
      modal = @
      @model.save(
          'translations':
            'en':  @$translationsForm.children("input[name='translations_en']").val()
            'es':  @$translationsForm.children("input[name='translations_es']").val()
            'eu':  @$translationsForm.children("input[name='translations_eu']").val()
      'success': ->
          Alotofus.MessageView.showMessage message:Translator.get('alotofus.generic.savedSuccessfully'), type:"success"
          do modal.closeModal
          listingIndexView?.fetchTable()
      'error': ->
          Alotofus.MessageView.showMessage message:Translator.get('alotofus.generic.errorSaving'), type:"error"
          do modal.$translationsForm.find('.loading').hide
          do modal.$translationsForm.find("input[type='submit']").show
      )
window.EditResourceModalView = EditResourceModalView