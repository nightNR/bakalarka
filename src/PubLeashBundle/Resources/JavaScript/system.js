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
                }, 5000);
            })();
        },

        notificationAjax: function() {
            PubLeash.makeApiCall('notifications', 'notifications', [], function(data) {
                for(var item in data) {
                    //console.log(item);
                    $('#'+ item).text(data[item]);
                }
            })
        },

        addFlashMessage: function(type, message) {
            var flashMessageElement = $(document.createElement('div')).addClass('alert').addClass(type);
            flashMessageElement.text(message);
            $(flashMessageElement).css('display', 'none');
            setTimeout(function() {
                flashMessageElement.hide(100, function() {
                    $(this).remove();
                });
            }, 2000);
            $('#flash-messages').append(flashMessageElement);
            flashMessageElement.show(100);
        },

        makeApiCall: function(service, command, data, callback) {
            $.ajax({
                url: apiUrl,
                method: 'POST',
                data: {
                    service: service,
                    command: command,
                    data: data
                },
                success: function(data) {
                    callback(data);
                }
            });
        }
    }
}