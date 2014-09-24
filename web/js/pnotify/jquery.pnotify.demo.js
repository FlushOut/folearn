function dyn_notice() {
    var percent = 0;
    var notice = $.pnotify({
        title: "Please Wait",
        type: 'info',
        icon: 'picon picon-throbber',
        hide: false,
        closer: false,
        sticker: false,
        opacity: .75,
        shadow: false,
        width: "150px"
    });

    setTimeout(function() {
        notice.pnotify({
            title: false
        });
        var interval = setInterval(function() {
            percent += 2;
            var options = {
                text: percent + "% complete."
            };
            if (percent == 80) options.title = "Almost There";
            if (percent >= 100) {
                window.clearInterval(interval);
                options.title = "Done!";
                options.type = "success";
                options.hide = true;
                options.closer = true;
                options.sticker = true;
                options.icon = 'picon picon-task-complete';
                options.opacity = 1;
                options.shadow = true;
                options.width = $.pnotify.defaults.width;
            //options.min_height = "300px";
            }
            notice.pnotify(options);
        }, 120);
    }, 2000);
}
/*********** Positioned Stack ***********
* This stack is initially positioned through code instead of CSS.
* This is done through two extra variables. firstpos1 and firstpos2
* are pixel values, relative to a viewport edge. dir1 and dir2,
* respectively, determine which edge. It is calculated as follows:
*
* - dir = "up" - firstpos is relative to the bottom of viewport.
* - dir = "down" - firstpos is relative to the top of viewport.
* - dir = "right" - firstpos is relative to the left of viewport.
* - dir = "left" - firstpos is relative to the right of viewport.
*/
var stack_bar_top = {
    "dir1": "down", 
    "dir2": "right", 
    "push": "top", 
    "spacing1": 0, 
    "spacing2": 0
};
function show_stack_bar_top(type) {
    var opts = {
        title: "Over Here",
        text: "Check me out. I'm in a different stack.",
        addclass: "stack-bar-top",
        cornerclass: "",
        width: "100%",
        stack: stack_bar_top,
        delay: 3000
    };
    switch (type) {
        case 'error':
            opts.title = "Oh No";
            opts.text = "Watch out for that water tower!";
            opts.type = "error";
            break;
        case 'info':
            opts.title = "Breaking News";
            opts.text = "Have you met Ted?";
            opts.type = "info";
            break;
        case 'success':
            opts.title = "Success";
            opts.text = "I've invented a device that bites shiny metal asses.";
            opts.type = "success";
            break;
    }
    $.pnotify(opts);
}

// event
$(function(){
    $('#top-notice').click(function(){
        show_stack_bar_top('notice');
    })
    $('#top-info').click(function(){
        show_stack_bar_top('info');
    })
    $('#top-success').click(function(){
        show_stack_bar_top('success');
    })
    $('#top-error').click(function(){
        show_stack_bar_top('error');
    })
});