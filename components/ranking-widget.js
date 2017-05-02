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
        return 'ok';
      },
      getText : function(text, isOn) {
        return 'plop;'
      }
    }
  });
