/**
 * Created by fliak on 10.8.16.
 */

app.controllers.task1Controller = function (menuBuilder, http, menuControl, config) {

    return http.get(config.menuURL).then(function (response) {

        menuBuilder(response, document.getElementById('main-menu'));

        document.querySelectorAll('li').forEach(function (element) {
            element.addEventListener('mouseover', function(e)    {
                menuControl.open(e.target);
            });

            element.addEventListener('mouseout', function (e) {
                menuControl.close(e.target);
            });
        });

        
    }, function (response) {
        console.error('Cannot obtain menu structure. Server return ', response);
    });
    
};

app.controllers.task1Controller.depends = ['menuBuilder', 'http', 'menuControl', 'config'];