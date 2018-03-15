var RankingWidgetComponent = Vue.component('banks-ranking-widget', {
  template: '#bank-ranking-widget-template',
  components: {
    'star-rating': starRatingComponent
  },
  props: {
    bank: Object
  },
  methods: {
    location:function () {
      return window.location;
    },
    getBg: function (isOn) {
      return isOn == '1' ? "text-success" : "text-danger";
    },
    getText: function (text, isOn) {
      return isOn == '1' ? '<i class="fa fa-check" aria-hidden="true"></i>' + text : '<i class="fa fa-times" aria-hidden="true"></i><s>' + text + "</s>";
    },
    getMobileIcon: function (m, isStacked) {
      if (m == 'iOS' && this.bank.mobile_apps['iOS'])
        return isStacked ? 'fa fa-apple fa-stack-1x apple-grey' : 'fa fa-apple fa-2x apple-grey';
      if (m == 'Android' && this.bank.mobile_apps['Android'])
        return isStacked ? 'fa fa-android fa-stack-1x android-green' : 'fa fa-android fa-2x android-green';
      if (m == 'Windows' && this.bank.mobile_apps['Windows'])
        return isStacked ? 'fa fa-windows fa-stack-1x windows-purple' : 'fa fa-windows fa-2x windows-purple';
      return '';
    }
  }
});