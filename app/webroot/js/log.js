/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


 function PP_preloadImages()
  {
    if( document.images )
    {
      var preLoadArg = PP_preloadImages.arguments;

      var arrayImages = new Array();

      for( var i = 0; i < preLoadArg.length; i++ )
      {
        arrayImages[i] = new Image();
        arrayImages[i].src = preLoadArg[i];
      }
    }
  }

  function locateObject(name, d)
  {
    var i,x;
    if( !d ) d = document;
  	 x = d[name];
    for(i=0; !x && d.layers && i< d.layers.length; i++)
      x=locateObject(name, d.layers[i].document);
    return x;
  }

  function ImageSwap( Name, URL)  {
    var img;
    img = locateObject(Name);
    img.src = URL;
  }