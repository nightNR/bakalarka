if(!window.PubLeash) {
    window.PubLeash = {

        run: function() {

        },

        notifications: function() {
            PubLeash.notificationAjax();
            (function(){
                // do some stuff
                setTimeout(function() {
                    PubLeash.notificationAjax()
                }, 10000);
            })();
        },

        notificationAjax: function() {
            $.ajax({
                url: notificationUri,
                success: function(data) {
                    for(var item in data) {
                        console.log(item);
                        $('#'+ item).text(data[item]);
                    }
                }
            });
        }
    }
}