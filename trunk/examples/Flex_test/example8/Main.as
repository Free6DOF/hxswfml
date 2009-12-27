package
{
	import flash.display.*;
	import flash.events.*;
	import flash.net.*;
	import flash.system.*;
	
	public class Main extends Sprite
	{
		public function Main()
		{
			var loader:Loader = new Loader();
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderComplete);
			loader.load(new URLRequest('library.swf'));
		}
		private function onLoaderComplete(event:Event):void
		{
			addChild(new MyPNG());
		}
	}
}