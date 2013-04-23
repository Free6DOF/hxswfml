package;

import flash.display.Loader;
import flash.display.MovieClip;
import flash.events.Event;
import flash.text.TextField;
import flash.system.LoaderContext;
import flash.system.ApplicationDomain;
import flash.utils.ByteArray;

import flash.Lib;

class MovieBytes extends ByteArray{}

class Preloader extends MovieClip
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
		tf.width=200;
		tf.height=20;
		addChild(tf);
		addEventListener(Event.ENTER_FRAME, onEnterFrame);
	}
	private function onEnterFrame(event:Event):Void
	{
		var percent = Math.floor((root.loaderInfo.bytesLoaded / root.loaderInfo.bytesTotal)*100);
		tf.text= percent +' %';
		if(percent==100)
		{
			//removeChild(tf);
			removeEventListener(Event.ENTER_FRAME, onEnterFrame);
			loader=new Loader();
			ctx = new LoaderContext(false, new ApplicationDomain(), null);
			loader.loadBytes(new MovieBytes(), ctx);
			addChild(loader);
			tf.text='100% (test online to see preloader)';
			setChildIndex(tf,numChildren-1);
			tf.x=400;
			tf.y=50;
			cast(this.parent,MovieClip).stop();
		}
	}
}