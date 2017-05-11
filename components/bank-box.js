jQuery(function() {
    <?php include(__ROOT__ .'/components/star-rating.js') ?>

    var boxes = new Vue({
        el: '#bank-box',
        data: {
            bankBoxes: bankBoxes
        },
        components: {
            'star-rating': starRatingComponent
        },
        mounted: function() {
            jQuery('div.card-container.manual-flip').click(function() {
                var $card = jQuery(this);
                if ($card.hasClass('hover')) {
                    $card.removeClass('hover');
                } else {
                    $card.addClass('hover');
                }
            });
        },
        computed: {
            rowClass: function() {
                return this.bankBoxes.banks.length > 0 ? 'row' : '';
            },
            banks: function() {
                return this.bankBoxes.banks;
            }
        },
        methods: {
            getBankClass: function(bankName) {
                return 'b-box-' + bankName.trim().toLowerCase().replace(' ', '-');
            },
            realOffer: function(offer) {
                var realOffer = [];
                for (var i in offer) {
                    if (offer[i] == '1')
                        realOffer.push(i);
                }
                return realOffer;
            },
            mobileApps: function(bank) {
                var mobileApps = [];
                for (var i in bank.mobile_apps) {
                    if (bank.mobile_apps[i] === true) {
                        var app = '';
                        if (i == 'iOS')
                            app = 'fa fa-apple apple-grey';
                        else if (i == 'Android')
                            app = 'fa fa-android android-green';
                        else if (i == 'Windows')
                            app = 'fa fa-windows windows-purple';
                        mobileApps.push(app);
                    }
                }
                return mobileApps;
            },
            notes: function(bank) {
                var notes = [];
                var notesToDisplay = this.bankBoxes.notes;
                var icons = this.bankBoxes.icons;
                notesToDisplay.forEach(function(el, i) {
                    var idx = parseInt(el);
                    if (bank.eval_data[idx] !== undefined) {
                        var found = bank.eval_data[idx];
                        notes.push({
                            label: found.label,
                            description: found.description,
                            note: found.note,
                            icon: i < icons.length ? 'fa ' + icons[i] + ' ' : ''
                        });
                    }
                });
                return notes;
            },
            getNote: function(note) {
                var n = (note / 10);
                return (Math.round(n) == n ? n : n.toFixed(1)) + '/10';
            }
        }
    });
});
