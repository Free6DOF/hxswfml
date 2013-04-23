package
{
	import flash.display.*;
	import flash.system.*
	public class Main extends Sprite
	{
		public function Main()
		{
			var cl:Class = ApplicationDomain.currentDomain.getDefinition("MyPNG") as Class;
			this.addChild(new cl());
		}
	}
}