package;

import flash.display.Loader;
import flash.display.Sprite;
import flash.events.Event;
import flash.text.TextField;
import flash.system.LoaderContext;
import flash.system.ApplicationDomain;
import flash.utils.ByteArray;

import flash.Lib;

class MyMovie extends ByteArray{}

class Preloader extends Sprite
{
	var tf:TextField;
	var loader:Loader;
	var ctx : LoaderContext;

	public static function main()
	{
		Lib.current.addChild(new Preloader());
	}
	public function new()
	{
		super();
		tf=new TextField();
		tf.border=true;
		tf.x=200;
		tf.y=200;
		tf.width=100;
		tf.height=20;
		addChild(tf);
		addEventListener(Event.ADDED_TO_STAGE, onAddedToStage);

		loader=new Loader();
		ctx = new LoaderContext(false, new ApplicationDomain(), null);
	}
	private function onAddedToStage(event:Event):Void
	{
		removeEventListener(Event.ADDED_TO_STAGE, onAddedToStage);
		addEventListener(Event.ENTER_FRAME, onEnterFrame);
	}
	private function onEnterFrame(event:Event):Void
	{
		var percent = Math.floor((root.loaderInfo.bytesLoaded / root.loaderInfo.bytesTotal)*100);
		tf.text= percent +' %';
		if(percent==100)
		{
			removeChild(tf);
			removeEventListener(Event.ENTER_FRAME, onEnterFrame);
			loader.loadBytes(new MyMovie(), ctx);
			addChild(loader);
		}
	}
}