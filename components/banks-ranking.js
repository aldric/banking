var bankRankingComponent = Vue.component('banks-grid', {
    template: '#ranking-template',
    components: {
        'star-rating': starRatingComponent
    },
    props: {
        banks: Array,
        offer: Array
    },
    data: function() {
        var checkedNames = [];
        this.banks.forEach(function(bank) {
            checkedNames.push(bank.name);
        });
        return {
            checkedNames: checkedNames
        }
    },
    methods: {
      getNote : function(note){
        return Math.trunc(note/10) + '/10';
      }
    },
    computed: {
        filteredBanks: function() {
            var that = this;
            return this.banks.filter(function(bank) {
                return that.checkedNames.indexOf(bank.name) > -1;
            })
        },
        headers: function() {
            var b = this.filteredBanks;
            var headers = [];
            headers.push({
                name: '<i class="fa fa-university fa-2x" aria-hidden="true"></i>'
            });
            b.forEach(function(bank) {
                headers.push({
                    name: bank.name,
                    image: bank.icon,
                    icon: bank.favicon
                });
            });
            return headers;
        },
        evaluations: function() {
            var b = this.filteredBanks;
            var evaluations = { };

            b.forEach(function(bank) {
              bank.eval_data.forEach(function(data) {

                if(!evaluations[data.label])
                  evaluations[data.label] = [];

                  evaluations[data.label].push({
                      description: data.description,
                      note: data.note
                  });
              });
            });
            return evaluations;
        },
        values: function() {
            var b = this.filteredBanks;
            var values = [];
            b.forEach(function(bank) {
                values.push({
                    mean: bank.mean,
                    review: bank.review_link,
                    welcomeOffer: bank.welcome_offer,
                    minimumWadge: bank.minimum_wadge,
                    creditCard: bank.credit_card,
                    pros: bank.pros,
                    cons: bank.cons,
                    evalData: bank.eval_data,
                    opinionTitle: bank.opinion_title,
                    opinionText: bank.opinion_text,
                    offer: bank.offer,
                    holdingLabel: bank.holding_label,
                    holdingName: bank.holding_name,
                    holdingImage: bank.holding_image,
                    customerCountLabel: bank.customer_count_label,
                    customerCount: bank.customer_count,
                    mobileApps: bank.mobile_apps,
                    name: bank.name,
                    image: bank.icon,
                    icon: bank.favicon

                });
            });
            return values;
        }
    }
});
