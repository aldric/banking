var RankingWidgetComponent = Vue.component('banks-ranking-widget', {
    template: '#bank-ranking-widget-template',
    components: {
        'star-rating': starRatingComponent
    },
    props: {
        bank: Object
    },
    methods : {
      getBg : function(isOn) {
        return isOn == '1' ?  "text-success" : "text-danger";
      },
      getText : function(text, isOn) {
        return  isOn == '1' ?  '<i class="fa fa-check" aria-hidden="true"></i>' + text : '<i class="fa fa-times" aria-hidden="true"></i><s>' + text + "</s>";
      }
    }
  });
