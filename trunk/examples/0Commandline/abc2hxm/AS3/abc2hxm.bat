mxmlc Main.as -debug -o Main.swf 
::-target-player 10
hxswfml abc2hxm Main.swf Main1.zip -main Main -source
hxswfml abc2hxm Main.swf Main2.zip -main Main -source -folders
hxswfml abc2xml Main.swf xml/Main.xml -source
pause