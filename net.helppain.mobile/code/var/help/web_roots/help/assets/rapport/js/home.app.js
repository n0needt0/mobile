require([
  // Libs
  "jquery",
  "use!backbone"
],
        
function( jQuery, Backbone) {

    var App = {
            Views: {},
            Models: {},
            Collections: {},
            Routers: {},
            init: function() {
                debug('initializing');
                debug(Conf);
                debug(App);
                App.Views.appview = new App.Views.AppView();
            }
        };

    
    
      // Our overall **AppView** is the top-level piece of UI.
      App.Views.AppView = Backbone.View.extend({

        // Instead of generating a new element, bind to the existing
          
        el: '#page' ,
        data:{},
        answer: {},
        // Delegated events for creating new items, and clearing completed ones.
        events: {
          "click .toggleOpen" : "openAll",
          "click .toggleClose" : "closeAll"
         }, 
        
        initialize: function () { 
            _.bindAll(this, "render");
            //render
            this.render();
        },

        render: function () {
            debug('binding to application element: ');
        },
        
        toggleOpen: function(e){
        	
        try{
          		var el = $(e.currentTarget);
          		debug(el);
          		el.trigger('click');
             return true;
            }
              catch (err)
            {
                debug(err);
                return false();
            }
        },
        toggleClose: function(e){
        	
            try{
              		var el = $(e.currentTarget);
              		debug(el);
              		el.trigger('click');
                 return true;
                }
                  catch (err)
                {
                    debug(err);
                    return false();
                }
            }
       
      });

    App.init();
});
