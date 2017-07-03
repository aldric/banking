Array.prototype.removeIf = function(callback) {
    var i = this.length;
    while (i--) {
        if (callback(this[i], i)) {
            this.splice(i, 1);
        }
    }
};

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
        this.offer.sort();
        return {
            checkedNames: [],
            mobileApps: [],
            selectedServices: []
        }
    },
    beforeUpdate: function() {

    },
    updated: function() {
        jQuery('button[data-type=opinion]').popover({
            content: function() {
                return jQuery(this).prev().html();
            }
        });

        jQuery('button[data-type=opinion]').popover({
            content: function() {
                return jQuery(this).prev().html();
            }
        });
    },
    mounted: function() {
        var that = this;
        this.$nextTick(function() {
            window.addEventListener('resize', this.setCheckedNames);
            this.setCheckedNames();
        });
        jQuery('button[data-type=result]').popover({
            html: true,
            content: function() {
                var id = jQuery(this).attr('id');
                return that.getSearchDetails(id);

            }
        });
        jQuery('button[data-type=result]').popover({
            html: true,
            content: function() {
                return jQuery(this).prev().html();
                return that.getSearchDetails(id);
            }
        });
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.setCheckedNames);
    },
    methods: {
        setCheckedNames: function() {
            var that = this;
            that.checkedNames.splice(0);
            this.banks.forEach(function(bank, idx) {
                if (idx < (that.numberOfBanks > 0 ? that.numberOfBanks : 3))
                    that.checkedNames.push(bank.name);
            });
        },
        getSearchDetails: function(bankId) {
            var that = this;
            var bank = this.filteredBanks.find(function(bank) {
                return bank.name == bankId;
            });
            var apps = this.mobileAppScore(bank);
            var services = this.serviceScore(bank);
            var result = "<h5>Note de la rédaction</h5><div style=\"text-align:center;font-weight:bold;margin-bottom:10px\">" + that.getNote(bank.mean) + "</div>";
            if (services.services.length > 0) {
                result += "<h5>Services disponibles</h5>";
                result += "<ul>";
                services.services.forEach(function(s) {
                    result += "<li>" + s + "</li>";
                });
                result += "</ul>";
            }
            if (apps.mobileApps.length > 0) {
                result += "<h5>Disponible sur</h5>";
                result += "<ul>";
                apps.mobileApps.forEach(function(s) {
                    result += "<li><i class=\"" + that.getMobileIcon(s) + "\" aria-hidden=\"true\"></i></li>";
                });
                result += "</ul>";
            }
            return result;
        },
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
            return {
                score: mobileApps.length,
                mobileApps: mobileApps
            };
        },
        serviceScore: function(bank) {
            var services = [];
            for (var i in bank.offer) {
                if (bank.offer[i] === "1" && this.selectedServices.indexOf(i) > -1) {
                    services.push(i);
                }
            }
            return {
                score: services.length,
                services: services
            };
        },
        resetFilters: function() {
            this.selectedServices.splice(0);
            this.mobileApps.splice(0);
        }

    },
    computed: {
        columnWidth: function() {
            return "width: " + (100 / this.filteredBanks.length) + "%";
        },
        numberOfBanks: function() {
            var nb = this.banks.length;
            if (screen.width < 415) {
                nb = 3;
            } else if (screen.width < 601) {
                nb = 4;
            } else if (screen.width < 1025) {
                nb = 5;
            }
            var value = Math.min(this.banks.length, nb);
            return value;
        },
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
            var topBanks = this.headers.slice().sort(function(a, b) {
                return a.score < b.score;
            }).sort(function(a, b) {
                if (a.score == b.score)
                    return a.mean < b.mean;
                return 0;
            });
            var rewards = ['gold-medal', 'silver-medal', 'bronze-medal'];
            var idx = 0;
            topBanks.forEach(function(bank, i) {
                bank.reward = rewards[idx];
                bank.rank = idx + 1;
                if (topBanks[i + 1] == undefined) return;
                var nextBank = topBanks[i + 1];
                if (bank.score != nextBank.score || bank.mean != nextBank.mean)
                    idx++;
            });
            return topBanks;
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
                    apps: apps.mobileApps,
                    services: services.services,
                    reward: undefined,
                    rank: undefined
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
