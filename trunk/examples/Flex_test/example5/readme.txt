Case: In Main.as an instance of class MyPNG is added and MyPNG is not known at compile time because it will be in an external library.swf that will be loaded

1)flex gets a reference to it with : ApplicationDomain.currentDomain.getDefinition("MyPNG") as Class; (library will be loaded in the same ApplicationDomain)

3)hXswfML creates the library.swf and in it also the class for MyPNG : <SymbolClass id="1" class="MyPNG" base="flash.display.Bitmap"/>