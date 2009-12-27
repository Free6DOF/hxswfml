Case: In Main.as an instance of class MyPNG is added and MyPNG is not known at compile time.

1)Flex gets a reference to the class with : ApplicationDomain.currentDomain.getDefinition("MyPNG") as Class;

2)The generated (as3) bytecode is automatically extracted from the flex generated swf and injected into the final swf created by hXswfML : <DefineABC file="Main.swf" />

3)hXswfML creates the class for MyPNG : <SymbolClass id="1" class="MyPNG" base="flash.display.Bitmap" />