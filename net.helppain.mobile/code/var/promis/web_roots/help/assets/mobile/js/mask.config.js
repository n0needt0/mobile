//Set the require.js configuration for your application.

require.config({
  
  paths: jsLibs,
  use: {
    backbone: {
      deps: ["underscore", "jquery", "json2"],
      attach: "Backbone"
    },

    underscore: {
      attach: "_"
    }
  },
  
//Initialize the application with the main application file
  deps: [
         Conf.home + "/assets/mobile/js/mask.app.js",
         Conf.home + "/assets/mobile/js/mask.templates.js"
         ]
});