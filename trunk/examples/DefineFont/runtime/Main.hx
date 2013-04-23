package;
import flash.display.Sprite;
import flash.display.MovieClip;
import flash.display.Loader;
import flash.events.Event;
import flash.events.MouseEvent;
import flash.net.URLLoader;
import flash.net.URLLoaderDataFormat;
import flash.net.URLRequest;
import flash.net.FileFilter;
import flash.net.FileReference;
import flash.system.ApplicationDomain;
import flash.text.Font;
import flash.text.TextField;
import flash.text.TextFieldType;
import flash.text.TextFieldAutoSize;
import flash.text.TextFormat;
import flash.Lib;

import be.haxer.hxswfml.FontWriter;

import haxe.io.Bytes;
import haxe.io.BytesData;

//class MyFont extends Font{}

class Main extends Sprite
{
	var fontWriter:FontWriter;
	var swf:Bytes;
	var data:BytesData;
	var fileFilter:FileFilter ;
	var fileReference:FileReference;
	var tf: TextField;
	var className:TextField;
	var charCodes:TextField;
	var textFormat:TextFormat;
	
	public static function main()
	{
		flash.Lib.current.addChild(new Main());
	}
	
	public function new()
	{
		super();
		
		addButton(110, 20, 'load ttf');
		addButton(220, 20, 'save as hx');
		addButton(330, 20, 'save as path');
		addButton(440, 20, 'save as swf');
		
		className = new TextField();
		className.x= 550;
		className.y = 22.5;
		className.border=true;
		className.width = 100;
		className.height=20;
		className.type=TextFieldType.INPUT;
		className.restrict='a-zA-Z0-9';
		className.multiline=false;
		className.text = 'MyFont';
		addChild(className);
		
		charCodes = new TextField();
		charCodes.x= 550;
		charCodes.y = 47.5;
		charCodes.border=true;
		charCodes.width = 100;
		charCodes.height=20;
		charCodes.type=TextFieldType.INPUT;
		charCodes.restrict='all-0-9';
		charCodes.multiline=false;
		charCodes.text = "32-126";
		addChild(charCodes);
		
		fileFilter = new FileFilter("True Type Font (*.ttf)","*.ttf");
		fileReference = new FileReference();
		fileReference.addEventListener(Event.SELECT, onFileSelect);
		fileReference.addEventListener(Event.COMPLETE, onTTFLoadComplete);
		
		textFormat = new TextFormat();
		textFormat.size = 20;
		textFormat.leading = 10;
		
		tf = new TextField();
		tf.embedFonts = true;
		tf.text = 'hello world 1234567890 abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ,;:+=<$^-)аз!и§("й&               Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
		tf.border=true;
		tf.x=tf.y=100;
		tf.width=600;
		tf.height=400;
		tf.wordWrap=true;
		tf.multiline=true;
		tf.type=TextFieldType.INPUT;
		addChild(tf);
		
		/*var urlLoader:URLLoader = new URLLoader();
		urlLoader.addEventListener(Event.COMPLETE, onTTFLoadComplete);
		urlLoader.dataFormat = URLLoaderDataFormat.BINARY;
		urlLoader.load(new URLRequest('Chopin.ttf'));
		*/
	}
	public function onTTFLoadComplete(event:Event)
	{	
		data = event.target.data;
		fontWriter = new FontWriter();
		fontWriter.write(Bytes.ofData(event.target.data), charCodes.text, 'swf');
		swf = fontWriter.getSWF(1,className.text, 10, false, 1024, 1024, 30, 1);
		
		var loader:Loader = new Loader();
		loader.contentLoaderInfo.addEventListener(Event.COMPLETE, onSWFLoadComplete);
		loader.loadBytes(swf.getData());
	}
	function onSWFLoadComplete(event:Event):Void
	{
		Font.registerFont(event.currentTarget.applicationDomain.getDefinition('MyFont'));
		textFormat.font = fontWriter.fontName;
		tf.setTextFormat(textFormat);
	}
	function onButtonClick(event:MouseEvent):Void
	{
		switch (event.currentTarget.text)
		{
			case 'load ttf':
				fileReference.browse([fileFilter]);
				
			case 'save as hx':
				fontWriter.write(Bytes.ofData(data), charCodes.text, "zip");
				var zip = fontWriter.getZip();
				new FileReference().save(zip.getData(), fontWriter.fontName + ".zip");
				
			case 'save as path':
				fontWriter.write(Bytes.ofData(data), charCodes.text, "path");
				var txt = fontWriter.getPath();
				new FileReference().save(txt, fontWriter.fontName + ".path");
				
			case 'save as swf':
				new FileReference().save(swf.getData(), fontWriter.fontName + ".swf");
		}
	}
	function addButton(x:Int, y:Int, text:String):Void
	{
		var button = new MovieClip();
		button.mouseChildren=false;
		button.graphics.lineStyle(1,1);
		button.graphics.beginFill(0xEEEEEE,1);
		button.graphics.drawRect(0,0,100,50);
		button.addEventListener(MouseEvent.CLICK, onButtonClick);
		button.x=x;
		button.y=y;
		button.buttonMode=true;
		button.text= text;
		
		var textfield = new TextField();
		textfield.autoSize=TextFieldAutoSize.LEFT;
		textfield.text = text;
		textfield.x = (button.width-textfield.width)/2;
		textfield.y = (button.height-textfield.height)/2;
		
		button.addChild(textfield);
		addChild(button);
	}
	function onFileSelect(event:Event):Void
	{
		fileReference.load();
	}

}