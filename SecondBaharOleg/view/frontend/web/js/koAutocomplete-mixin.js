define(['uiComponent', 'mage/url', 'jquery'], function (Component, urlBuilder ,$){
    var mixin = {
        setMinLength: function(){
            this.minLengthChars = 5;
        },
    };

    return function (target) {
        return target.extend(mixin);
    };
})