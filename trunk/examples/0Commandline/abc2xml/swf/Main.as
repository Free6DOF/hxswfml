package
{
	import flash.display.*;
	import flash.events.*;
	import flash.text.*;
	
	public class Main extends MovieClip
	{
		public const cnst:String = "Constant"
		public static var TEXT:String = "Hello World";
		public var bool:Boolean=true;
		public var nr:int=7;
		public var tf:TextField = new TextField();
		
		public function Main()
		{
			tf.border = true;
			tf.autoSize = TextFieldAutoSize.LEFT;
			tf.text = TEXT;
			addChild(tf);
		
			var loc_btn:MovieClip = new MovieClip();
			loc_btn.x = loc_btn.y=100;
			loc_btn.graphics.beginFill(0x0000FF, 0.5);
			loc_btn.graphics.drawRect(0, 0, 100, 100);
			loc_btn.buttonMode = true;
			loc_btn.addEventListener(MouseEvent.CLICK, onClick);
			addChild(loc_btn);
			//var v:Vector.<Array> = new Vector.<Array>();
			//v.push([0]);
			//trace(v);
			trace(this, Main, TEXT, Main.TEXT, bool, nr, tf, loc_btn, onClick, staticFunc, Main.staticFunc);
			try 
			{
				var value:* = new Array();
				value.getChildAt(0);
			} 
			catch(error:TypeError) 
			{
				trace("TypeError catch: " + error);	
			}
			trace("Continuing with script...");
			while(nr<20)
			{
				if(++nr%2)
					trace('while:' +nr);
			}
			for(var i:int=0; i< 10; i++)
			{
				trace('for:'+i);
			}
		}
		public function onClick(event:MouseEvent):void
		{
			tf.appendText(Main.TEXT);
		}
		public static function staticFunc(param0:int = 13):int
		{
			return param0 * 2;
		}
	}
}