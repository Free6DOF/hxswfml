Case: In Main.as an instance of class MyPNG is added and MyPNG is known at compile time but is an external class (not compiled into Main.as)

1)flex gets a reference to it with : new MyPNG()

2)The generated (as3) bytecode is automatically extracted from the flex generated swf and injected into the final swf created by hXswfML : <DefineABC file="Main.swf" />

3)hXswfML creates the class for MyPNG : <SymbolClass id="1" class="MyPNG" base="flash.display.Bitmap" />