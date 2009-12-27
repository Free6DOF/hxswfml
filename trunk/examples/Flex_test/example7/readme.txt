Case: In Main.as an instance of class MyPNG is added and MyPNG is known at compile time but it will not be included in the swf.

1)flex gets a reference to it with : new MyPNG() (library will be loaded in the system ApplicationDomain)

3)hXswfML creates the library.swf and in it also the class for MyPNG : <SymbolClass id="1" class="MyPNG" base="flash.display.Bitmap"/>