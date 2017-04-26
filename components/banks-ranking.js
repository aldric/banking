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
        this.banks.forEach(function(bank, idx) {
          if(idx < 3)
            checkedNames.push(bank.name);
        });
        this.offer.sort();
        return {
            checkedNames: checkedNames,
            mobileApps: [],
            selectedServices: []
        }
    },
    mounted: function() {
        jQuery('button[data-toggle]').popover();
    },
    methods: {
        getNote: function(note) {
            var n = (note / 10);
            return (Math.round(n) == n ? n : n.toFixed(1)) + '/10';
        },
        getMobileIcon: function(m, isStacked) {
            if (m == 'iOS')
                return isStacked ? 'fa fa-apple fa-stack-1x apple-grey' : 'fa fa-apple fa-2x apple-grey';
            if (m == 'Android')
                return isStacked ? 'fa fa-android fa-stack-1x android-green' : 'fa fa-android fa-2x android-green';
            if (m == 'Windows')
                return isStacked ? 'fa fa-windows fa-stack-1x windows-purple' : 'fa fa-windows fa-2x windows-purple';
            return '';
        },
        findOne: function(haystack, arr) {
            return arr.some(function(v) {
                return haystack.indexOf(v) >= 0;
            });
        },
        mobileAppScore: function(bank) {
            var mobileApps = [];
            for (var i in bank.mobile_apps) {
                if (bank.mobile_apps[i] === true && this.mobileApps.indexOf(i) > -1) {
                  mobileApps.push(i);
                }
            }
            return { score : mobileApps.length, mobileApps : mobileApps };
        },
        serviceScore: function(bank) {
            var services = [];
            for (var i in bank.offer) {
                if (bank.offer[i] === "1" && this.selectedServices.indexOf(i) > -1) {
                  services.push(i);
                }
            }
            return { score : services.length, services : services };
        },
        resetFilters: function() {
            this.selectedServices.splice(0);
            this.mobileApps.splice(0);
        },
        numberOfBanks : function() {
          var nb = this.banks.length;
          if(screen.width < 768)
            return 3;
          if(screen.width < 992)
            return 5;
          return nb;
        }
    },
    computed: {
        searchStarted: function() {
          return (this.selectedServices && this.selectedServices.length > 0) || (this.mobileApps && this.mobileApps.length > 0);
        },
        filteredBanks: function() {
            var that = this;
            return this.banks.filter(function(bank) {
                return that.checkedNames.indexOf(bank.name) > -1;
            }).sort(function(a, b) {
              return a.mean < b.mean;
            });
        },
        topBanks: function() {
          return this.headers.slice().sort(function(a, b) {
            return a.score < b.score;
          }).sort(function(a, b) {
              if(a.score == b.score)
                return a.mean < b.mean;
              return 0;
          });
        },
        headers: function() {
            var b = this.filteredBanks;
            var headers = [];
            var that = this;
            b.forEach(function(bank) {
               var apps = that.mobileAppScore(bank);
               var services = that.serviceScore(bank);
                headers.push({
                    name: bank.name,
                    mean: bank.mean,
                    image: bank.icon,
                    icon: bank.favicon,
                    score: apps.score + services.score,
                    apps : apps.mobileApps,
                    services : services.services
                });
            });
            return headers;
        },
        evaluations: function() {
            var b = this.filteredBanks;
            var evaluations = {};

            b.forEach(function(bank) {
                bank.eval_data.forEach(function(data) {
                    if (!evaluations[data.label])
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
                    icon: bank.favicon,
                    affiliate: bank.affiliate_link
                });
            });
            return values;
        },
        colspan: function() {
            return this.filteredBanks.length;
        }
    }
});
