require([
  // Libs
  "jquery",
  "use!backbone"
],
        
function( jQuery, Backbone) {
console.log("here");

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
          "click #pin" : "enterPin",
          "submit #form" : "checkPin"
         }, 
        
        initialize: function () { 
            _.bindAll(this, "render");
            //render
            this.render();
        },

        render: function () {
            debug('binding to application element: ');
        },
        
        checkPin: function(e){
        	
        try{
          		var pin = $('#pin').val();

                if( ('Enter your PIN' == pin) || ('' == pin.trim()) )
                {
                	alert("Please enter valid PIN.");
            	    return false;
                }
                
                return true;
            }
              catch (err)
            {
                debug(err);
                return false();
            }
        },
        
        enterPin: function(e){
          	try{
          		
          		var pin = $(e.currentTarget).val();

                if('Enter your PIN' == pin)
                {
                	$(e.currentTarget).val("");
                }
            }
              catch (err)
            {
                debug(err);
            }
        },
        
      });

    App.init();
});