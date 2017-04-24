var bankRankingComponent = Vue.component('banks-grid', {
    template: '#ranking-template',
    components: {
        'star-rating': starRatingComponent
    },
    props: {
        banks: Array,
        offer: Array
    },
    directives: {
      score:
        function(el, binding, vNode) {
          var badgeChild = el.children[0];
          if(badgeChild.className === 'badge-num')
            el.removeChild(el.children[0]);
          badgeNum = document.createElement('div');
          badgeNum.setAttribute('class','badge-num');
          badgeNum.innerText = binding.value;
          console.log("bv : " + binding.value);
          var insertedElement = el.insertBefore(badgeNum,el.firstChild);
        
      }
    },
    data: function() {
        var checkedNames = [];
        this.banks.forEach(function(bank) {
            checkedNames.push(bank.name);
        });
        this.offer.sort();
        return {
            checkedNames: checkedNames,
            mobileApps: [],
            selectedServices:[]
        }
    },
    mounted: function(){
      jQuery('button[data-toggle]').popover();
    },
    methods: {
      getNote : function(note){
        return Math.trunc(note/10) + '/10';
      },
      getMobileIcon : function(m, isStacked) {
        if(m == 'iOS')
          return isStacked ? 'fa fa-apple fa-stack-1x apple-grey' : 'fa fa-apple fa-2x apple-grey';
        if(m == 'Android')
          return isStacked ? 'fa fa-android fa-stack-1x android-green' : 'fa fa-android fa-2x android-green';
        if(m == 'Windows')
          return isStacked ? 'fa fa-windows fa-stack-1x windows-purple' : 'fa fa-windows fa-2x windows-purple';
        return '';
      },
      findOne : function (haystack, arr) {
        return arr.some(function (v) {
          return haystack.indexOf(v) >= 0;
        });
      },
      mobileAppScore : function(bank) {
        var score = 0;
        for(var i in bank.mobile_apps) {
          if(bank.mobile_apps[i] === true && this.mobileApps.indexOf(i) > -1)
            score++;
        }
        return score;
      },
      serviceScore : function(bank) {
        var score = 0;
        for(var i in bank.offer) {
          if(bank.offer[i] === "1" && this.selectedServices.indexOf(i) > -1)
          score++;
        }
        return score;
      },
      resetFilters: function() {
        this.selectedServices.splice(0);
        this.mobileApps.splice(0);
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
            var that = this;
            b.forEach(function(bank) {
              console.log(bank.name + " :: " + that.mobileAppScore(bank) + that.serviceScore(bank));
                headers.push({
                    name: bank.name,
                    image: bank.icon,
                    icon: bank.favicon,
                    score: that.mobileAppScore(bank) + that.serviceScore(bank)
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
              icon: bank.favicon,
              affiliate : bank.affiliate_link
            });
          });
            return values;
        },
        colspan:function() {
          return this.filteredBanks.length + 1;
        }
    }
});
