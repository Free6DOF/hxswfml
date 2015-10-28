check out the examples:
http://code.google.com/p/hxswfml/downloads/detail?name=examples.zip

1)SWF general:<br>
<a href='http://www.adobe.com/devnet/swf/pdf/swf_file_format_spec_v10.pdf'>http://www.adobe.com/devnet/swf/pdf/swf_file_format_spec_v10.pdf</a> (see pages 26 to 33)<br>

-A swf always starts with a <code>&lt;swf&gt;</code> tag <br>

-If the swf contains a <code>&lt;DefineABC /&gt;</code> tag (ActionscriptByteCode,AS3) a <code>&lt;FileAttributes/&gt;</code> tag is mandatory and must be the very first element.<br>

-If the swf contains a <code>&lt;MetaData /&gt;</code> tag you must set the 'hasMetaData' attribute to true in the <code>&lt;FileAttributes/&gt;</code> tag.<br>

-If you set the attribute 'hasMetaData' to true in the <code>&lt;FileAttributes/&gt;</code> tag then the swf must contain a <code>&lt;MetaData /&gt;</code> tag.<br>

-A swf contains at least one <code>&lt;ShowFrame/&gt;</code> tag.<br>
A basic swf (a movie with 3 empty frames) looks like:<br>
<pre><code>&lt;swf&gt;<br>
	&lt;ShowFrame /&gt;<br>
	&lt;ShowFrame /&gt;<br>
	&lt;ShowFrame /&gt;<br>
&lt;/swf&gt;<br>
</code></pre>
The FlashPlayer will start parsing/playing the tags from the top till it reaches the <code>&lt;EndFrame/&gt;</code> tag.<br>
When it encounters a <code>&lt;ShowFrame/&gt;</code> it renders the previous tags to the screen.<br>
Note that although the <code>&lt;EndFrame/&gt;</code> tag is available for use, under normal circumstances you will never need it as it is added to the end of your file automatically by hXswfML.<br>


2)hXswfML syntax:<br>
-Element names are not case sensitive. <code>&lt;fileattributes/&gt;</code> is equally valid to <code>&lt;FileAttributes&gt;</code><br>
-The attribute names are case sensitive.<br>
-Most tags have some default values set:<br>
Using <code>&lt;swf/&gt;</code> will be compiled as <code>&lt;swf width="800" height="600" fps="30" version="10" compressed="true" frameCount="1" /&gt;</code><br>
If you only want to change the framerate you would use: <code>&lt;swf fps="12"/&gt;</code><br>
-Some tags have mandatory attributes which must be set. The program will throw an error and tell you what attribute is missing in which tag.<br>

The names of some elements in the hXswfML may seem confusing at some points (DefineSprite defines a MovieClip for example), but they are kept the same as much as possible as in the official swf file specifications, making a lookup for information more easy.<br>
More information about the swf file format and the possible tags can be found here:<br>
<blockquote><a href='http://www.adobe.com/devnet/swf/pdf/swf_file_format_spec_v10.pdf'>http://www.adobe.com/devnet/swf/pdf/swf_file_format_spec_v10.pdf</a><br>
<a href='http://www.m2osw.com/en/swf_alexref.html'>http://www.m2osw.com/en/swf_alexref.html</a><br>
<a href='http://www.the-labs.com/MacromediaFlash/SWF-Spec/SWFfilereference.html#h2SWFFileTags'>http://www.the-labs.com/MacromediaFlash/SWF-Spec/SWFfilereference.html#h2SWFFileTags</a><br>
<a href='http://www.half-serious.com/swf/format/index.html'>http://www.half-serious.com/swf/format/index.html</a><br>
<a href='http://www.delphiflash.com/xml-tags-specification.htm#ShowFrame'>http://www.delphiflash.com/xml-tags-specification.htm#ShowFrame</a><br></blockquote>

-Definition tags vs control/displaytags<br>
To define a character use a definition tag.<br>
Example: <br>
<pre><code>&lt;DefineShape id="1"&gt; <br>
    &lt;DrawRect width="100" height="100"/&gt; <br>
&lt;/DefineShape&gt;<br>
</code></pre>
creates a black 100x100 rectangle.<br>
The id of this tag must be unique in the swf.<br>

To show this rectangle you must place it on the display list with a control/display tag.<br>
Example:<br>
<pre><code>&lt;PlaceObject id="1" depth="1" /&gt;<br>
</code></pre>
-id refers to the definition tag that has set id to 1.<br>
-the depth must be unique in the swf<br>

To render to screen you conclude with a <code>&lt;ShowFrame/&gt;</code> tag. <br>
Everything that has been put on or removed from the display up until the next <code>&lt;ShowFrame/&gt;</code> will be rendered to screen.<br>

A movie with 1 frame, rendering a black rectangle on screen looks like:<br>
<pre><code>&lt;swf&gt;<br>
	&lt;DefineShape id="1"&gt; <br>
		&lt;DrawRect width="100" height="100"/&gt; <br>
	&lt;/DefineShape&gt;<br>
	&lt;PlaceObject id="1" depth="1" /&gt;<br>
	&lt;ShowFrame/&gt;<br>
&lt;/swf&gt;<br>
</code></pre>

Multiframe movies:<br>
To show a black rectangle in frame 1 and a red rectangle in frame 2 you use:<br>
<pre><code>&lt;swf frameCount="2"&gt;<br>
<br>
	&lt;DefineShape id="1"&gt; <br>
		&lt;DrawRect width="100" height="100"/&gt; <br>
	&lt;/DefineShape&gt;<br>
		<br>
	&lt;DefineShape id="2"&gt; <br>
		&lt;DrawCircle width="200" height="200"/&gt; <br>
	&lt;/DefineShape&gt;<br>
	<br>
	&lt;PlaceObject id="1" depth="1" /&gt;<br>
	&lt;ShowFrame/&gt;<br>
	<br>
	&lt;RemoveObject depth="1" /&gt;<br>
	&lt;PlaceObject id="2" depth="1" /&gt;<br>
	&lt;ShowFrame/&gt;<br>
&lt;/swf&gt;<br>
</code></pre>

You can omit the <code>&lt;RemoveObject/&gt;</code> tag by using the move attribute in the PlaceObject tag:<br>
<pre><code>	&lt;RemoveObject depth="1" /&gt;<br>
	&lt;PlaceObject id="2" depth="1" /&gt;<br>
equivalent/shortcut:<br>
	&lt;PlaceObject id="2" depth="1" move="true" /&gt;<br>
</code></pre>

A more complete explanation of the move attribute can be found in the swf file specs on page 35.<br>
Short summary:<br>
<blockquote>The move and id attributes indicate whether a new character is being added to the display list, or a character already on the display list is being modified:<br>
<blockquote>-move = false and id is present: A new character (id) is placed on the display list at the specified depth. <br>
-move = true and id is absent: The character at the specified depth is modified. Because any given depth can have only one character, no id is required.<br>
-move = true and id is present: The character at the specified Depth is removed, and a new character (id) is placed at that depth. <br></blockquote></blockquote>

MovieClips:<br>
A movieclip can be considered as a 'mini swf'. A limited set of the swf tags can be used inside a movieclip:<br>
Available tags are: <code>&lt;PlaceObject/&gt;, &lt;RemoveObject/&gt;, &lt;StartSound/&gt;, &lt;FrameLabel/&gt;, &lt;ShowFrame /&gt;, &lt;EndFrame /&gt;</code><br>
Example of a 2 frame movieclip showing a black rectangle in frame 1 and a red rectangle in frame 2:<br>
<pre><code>&lt;swf&gt;<br>
	&lt;DefineShape id="1"&gt; <br>
		&lt;DrawRoundRect width="100" height="100" r="25"/&gt; <br>
	&lt;/DefineShape&gt;<br>
		<br>
	&lt;DefineShape id="2"&gt; <br>
		&lt;DrawEllipse width="200" height="150"/&gt; <br>
	&lt;/DefineShape&gt;<br>
<br>
	&lt;DefineSprite id="3" frameCount="2"&gt;<br>
		&lt;PlaceObject id="1" depth="1" /&gt;<br>
		&lt;ShowFrame/&gt;<br>
		&lt;PlaceObject id="2" depth="1" move="true" /&gt;<br>
		&lt;ShowFrame/&gt;<br>
	&lt;/DefineSprite&gt;<br>
	<br>
	&lt;PlaceObject id="3" depth="1" /&gt;<br>
	<br>
	&lt;ShowFrame/&gt;<br>
&lt;/swf&gt;<br>
</code></pre>