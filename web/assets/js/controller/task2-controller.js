/**
 * Created by fliak on 10.8.16.
 */

app.controllers.task2Controller = function (menuBuilder, http, config) {

    return http.get(config.menuURL).then(function (response) {

        menuBuilder(response, document.getElementById('main-menu'));
        
        document.querySelector('#main-menu>li:first-child').style.display = 'none';

        var menu = document.querySelector('#main-menu');
        var menuToggle = document.querySelector('#menu-toggle');

        menuToggle.addEventListener('click', function() {
            menu.classList.remove('hidden');
            menuToggle.classList.add('hidden');
        });

        menu.addEventListener('click', function() {
            menuToggle.classList.remove('hidden');
            menu.classList.add('hidden');
        })
        
        
    }, function (response) {
        console.error('Cannot obtain menu structure. Server return ', response);
    });
    
    
};

app.controllers.task2Controller.depends = ['menuBuilder', 'http', 'config'];