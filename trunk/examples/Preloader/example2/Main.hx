package;
import flash.display.Bitmap;
import flash.display.MovieClip;
import flash.display.Sprite;
import flash.events.Event;
import flash.text.TextField;

import flash.Lib;

class MyHeavyImage extends Bitmap //check index.xml
{
	public function new ()
	{
		super();
	}
}

//test index.swf online to see preloader working
class Main extends MovieClip
{
	var tf:TextField;
	public static function main()
	{
		Lib.current.addChild(new Main());
	}
	public function new()
	{
		super();
		tf = new TextField();
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
		tf.text= "Loading: " + percent +' %';
		if(percent==100)
		{
			removeEventListener(Event.ENTER_FRAME, onEnterFrame);
			cast(this.parent,MovieClip).stop();
			var movie = new Movie();
			addChild(movie);
		}
	}
}

class Movie extends Sprite
{
	public function new()
	{
		super();
		var img = new MyHeavyImage();
		addChild(img);
	}
}