The following classes can be linked to a tag/asset inside your swf:<br>
<br>
1)flash.display.Bitmap<br>
2)flash.display.MovieClip<br>
3)flash.display.Sprite<br>
4)flash.display.SimpleButton<br>
5)flash.media.Sound<br>
6)flash.text.Font<br>
7)flash.utils.ByteArray<br>
8)The document class of your script<br>

Check also the example in the downloads directory : <a href='http://hxswfml.googlecode.com/files/SymbolClass_base_test.zip'>http://hxswfml.googlecode.com/files/SymbolClass_base_test.zip</a>
<pre><code>&lt;swf&gt;<br>
	&lt;FileAttributes /&gt;<br>
	<br>
	&lt;!--flash.display.Bitmap--&gt;<br>
	&lt;DefineBitsJPEG2 id="1" file="picture.png" /&gt;<br>
	&lt;SymbolClass id="1" class="MyBitmap" base="flash.display.Bitmap"/&gt;<br>
	<br>
	&lt;DefineShape id="3" bitmapId="1" /&gt;<br>
	<br>
	&lt;!--flash.display.MovieClip--&gt;<br>
	&lt;DefineSprite id="4" frameCount="2"&gt;<br>
		&lt;PlaceObject id="3" depth="1" /&gt;<br>
		&lt;ShowFrame /&gt;<br>
		&lt;PlaceObject id="3" depth="1" move='true'/&gt;<br>
		&lt;ShowFrame /&gt;<br>
	&lt;/DefineSprite&gt;<br>
	&lt;SymbolClass id="4" class="MyMovieClip" base="flash.display.MovieClip/&gt;<br>
	<br>
	&lt;!--flash.display.Sprite--&gt;<br>
	&lt;DefineSprite id="5" frameCount="1"&gt;<br>
		&lt;PlaceObject id="3" depth="1" /&gt;<br>
		&lt;ShowFrame /&gt;<br>
	&lt;/DefineSprite&gt;<br>
	&lt;SymbolClass id="5" class="MySprite" base="flash.display.Sprite"/&gt;<br>
	<br>
	&lt;!--flash.display.SimpleButton--&gt;<br>
	&lt;DefineButton id="6"&gt;<br>
		&lt;ButtonState up='true' id='3' depth='1' /&gt;<br>
		&lt;ButtonState over='true' id='3' depth='1' /&gt;<br>
		&lt;ButtonState down='true' id='3' depth='1' /&gt;<br>
		&lt;ButtonState hit='true' id='3' depth='1' /&gt;<br>
	&lt;/DefineButton&gt;<br>
	&lt;SymbolClass id="6" class="MySimpleButton" base="flash.display.SimpleButton"/&gt;<br>
	<br>
	&lt;!--flash.media.Sound--&gt;<br>
	&lt;DefineSound id="7" file="sound.mp3" /&gt;<br>
	&lt;SymbolClass id="7" class="MySound" base="flash.media.Sound"/&gt;<br>
	<br>
	&lt;!--flash.text.Font--&gt;<br>
	&lt;DefineFont id="8" file="fontInSwf.swf" /&gt;<br>
	&lt;SymbolClass id="8" class="MyFont" base="flash.text.Font"/&gt;<br>
	<br>
	&lt;!--flash.utils.ByteArray--&gt;<br>
	&lt;DefineBinaryData id="9" file="picture.png" /&gt;<br>
	&lt;SymbolClass id="9" class="MyByteArray" base="flash.utils.ByteArray"/&gt;<br>
	<br>
	&lt;!--your document class (must always be id 0) --&gt;<br>
	&lt;DefineABC file="Script.swf" /&gt;<br>
	&lt;SymbolClass id="0" class="flash.Boot" /&gt;<br>
<br>
	&lt;ShowFrame/&gt;<br>
	<br>
&lt;/swf&gt;<br>
</code></pre>
If you supply a class name for the base attribute then a class with the according actionscript bytecode will be automatically generated and added to the swf.<br>
If you omit a class name for the base attribute then you must define that class inside your script and it must extends the correct super class.