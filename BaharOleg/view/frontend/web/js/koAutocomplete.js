define(['uiComponent', 'mage/url', 'jquery'], function (Component, urlBuilder ,$) {
    return Component.extend({
        defaults: {
            searchText: '',
            searchResult: [],
            minLengthChars: 0
        },
        initObservable: function () {
            this._super();
            this.observe(['searchText', 'searchResult']);
            return this;
        },
        initialize: function () {
            this._super();
            this.setMinLength();
            this.searchText.subscribe(this.handleAutocomplete.bind(this));
        },
        setMinLength: function(){
            this.minLengthChars = 3;
        },
        handleAutocomplete: function(searchValue){
            if(searchValue.length >= this.minLengthChars){
                $.ajax({
                    url: urlBuilder.build('baharoleg/requests/getsku'),
                    type: "get",
                    dataType: "json",
                    data: {sku: searchValue},
                    success: function (result){
                        console.log(result);
                        this.searchResult(result);
                    }.bind(this)
                })
            }
            else{
                this.searchResult([]);
            }
        }
    });
});
