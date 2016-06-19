class AnalyticsIndexView
  constructor: ->
    console.log 'todo'
    basicData =
      #labels : ["January","February","March","April","May","June","July"]
      datasets :[
          fillColor : "rgba(67, 173, 75,0.5)"
          strokeColor : "#43AD4B"
          pointColor : "#43AD4B"
          pointStrokeColor : "#fff"
          #data : [65,59,90,81,56,55,40]
        ]
    canvasItems =
      "#registered-users-chart": AlotofusAnalytics.registeredUsers
      "#active-users-chart": AlotofusAnalytics.activeUsers
      "#enroled-users-chart": AlotofusAnalytics.enroledUsers
      "#open-offers-chart": AlotofusAnalytics.openOffers
      "#registered-companies-chart": AlotofusAnalytics.registeredCompanies
      "#companies-with-offers-chart": AlotofusAnalytics.companiesWithOffers

    for el, data of canvasItems
      ctx = $(el).get(0).getContext("2d")
      registeredUsersChart = new Chart(ctx).Line($.extend(true,{},basicData,AlotofusAnalytics.dates,data))



window.AnalyticsIndexView = AnalyticsIndexView

$(document).ready ->
  new AnalyticsIndexView();
