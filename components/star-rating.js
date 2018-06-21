var starRatingComponent = Vue.component('star-rating', {
    template: '#star-rating',
    props: ['percentage'],
    data: function() {
        return {
            value: this.percentage
        }
    },
    mounted: function() {
        var that = this;
        jQuery(that.$el).find('div.star-limiter').animate( {width : that.value + '%'}, 2000);
    }
});
