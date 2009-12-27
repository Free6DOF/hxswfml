package
{
	import flash.display.*;
	import flash.events.*;
	import flash.net.*;
	import flash.system.*;
	
	public class Main extends Sprite
	{
		private var appDom:ApplicationDomain;
		public function Main()
		{
			var loader:Loader = new Loader();
			loader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoaderComplete);
			appDom = new ApplicationDomain(null);
			var ctx:LoaderContext = new LoaderContext(false, appDom);
			loader.load(new URLRequest('library.swf'), ctx);
		}
		private function onLoaderComplete(event:Event):void
		{
			var cl:Class = appDom.getDefinition("MyPNG") as Class;
			addChild(new cl());
		}
	}
}