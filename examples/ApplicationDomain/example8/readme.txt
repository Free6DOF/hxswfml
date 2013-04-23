Case: In Main.as an instance of class MyPNG is added and MyPNG is known at compile time and also compiled by flex into the swf.

1)flex gets a reference to it with : new MyPNG() (but only calls it when it knows the library is loaded and the asset linked to that class name is available)

3)hXswfML creates the library.swf and in it the asset with a linkage to the classname "MyPNG" but does not generate the class itself(flex already did) <SymbolClass id="1" class="MyPNG" />