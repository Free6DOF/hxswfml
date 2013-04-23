1)	Most of the examples use files from the assets folder. 
	Relative paths will break if you (re)move this folder or these files.

2) 	Some (haxe)examples use -cp with a relative path pointing to the source files in the hxswfml src folder. 
	To make sure this works correctly, put the examples folder next to your hxswfml src and bin folder.

3) 	Some (non graphical) examples appear to do nothing at all. 
	Check your local flashlog.txt file for the traces they output. 
	An example of a flashlog.txt is included with each of these examples.
	
4)	Some examples use a windows batch (.bat) file which needs to be run from the command line.
	If you're using Linux or Mac, simply copy the contents to a shell file (.sh) and remove unknown commands as 'pause'.
