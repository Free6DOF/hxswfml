Case: In Main.as an instance of class MyPNG is added and MyPNG is known at compile time

1)flex gets a reference to it with : new MyPNG()

2)The generated (as3) bytecode is automatically extracted from the flex generated swf and injected into the final swf created by hXswfML : <DefineABC file="Main.swf" />

3)hXswfML does NOT create the class for MyPNG and only links the png asset to the class name: <SymbolClass id="1" class="MyPNG" />