package ;

import flash.display.Sprite;
import flash.display.Loader;
import flash.events.MouseEvent;
import flash.events.Event;
import flash.net.FileReference;
import flash.net.URLLoader;
import flash.net.URLRequest;
import flash.net.URLLoaderDataFormat;
import flash.text.TextField;
import flash.text.TextFieldAutoSize;
import flash.utils.ByteArray;
import be.haxer.hxswfml.SwfWriter;

class Main extends Sprite
{
	private var xml:String;
	private var swf:ByteArray;
	private var saveBtn:Sprite;
	private var fr:FileReference;
	private var tf:TextField;

	public function new()
	{
		super();
		//textfield
		tf = new TextField();
		tf.width=tf.height=400;
		tf.x=tf.y=100;
		tf.border=true;
		addChild(tf);
		
		
		//saveBtn
		saveBtn=new Sprite();
		saveBtn.graphics.lineStyle(2,0);
		saveBtn.graphics.beginFill(0xff0000,1);
		saveBtn.graphics.drawRect(0,0,100,20);
		var tf:TextField=new TextField();
		tf.text = 'SAVE SWF';
		tf.autoSize= TextFieldAutoSize.LEFT;
		tf.x = (saveBtn.width-tf.width)/2;
		tf.y = (saveBtn.height-tf.height)/2;
		saveBtn.addChild(tf);
		saveBtn.mouseChildren = false;
		saveBtn.buttonMode = true;
		saveBtn.visible = false;
		saveBtn.addEventListener(MouseEvent.CLICK, onSaveBtnClick);
		addChild(saveBtn);

		//FileReference
		fr = new FileReference();

		//xml loader
		var xmlLoader = new URLLoader();
		xmlLoader.dataFormat = URLLoaderDataFormat.TEXT;
		xmlLoader.addEventListener(Event.COMPLETE, onXmlLoaderComplete);

		//load xml text
		xmlLoader.load(new URLRequest('input.xml'));
	}
	private function onXmlLoaderComplete(event:Event):Void
	{
		xml = event.target.data;
		tf.text=xml;
		//jpeg bytes loader (referenced in the xml)
		var jpegLoader = new URLLoader();
		jpegLoader.dataFormat = URLLoaderDataFormat.BINARY;
		jpegLoader.addEventListener(Event.COMPLETE, onJpegLoaderComplete);
		jpegLoader.load(new URLRequest('picture.png'));
	}
	private function onJpegLoaderComplete(event:Event):Void
	{
		var swfWriter = new SwfWriter();
		swfWriter.library.set('picture.png', event.target.data);
		swfWriter.write(xml,true);
		var bytes = swfWriter.getSWF();
		swf = bytes.getData();
		saveBtn.visible = true;
	}
	private function onSaveBtnClick(event:MouseEvent):Void
	{
		fr.save(swf,'index.swf');
	}
	public static function main()
	{
		flash.Lib.current.addChild(new Main());
	}
}
