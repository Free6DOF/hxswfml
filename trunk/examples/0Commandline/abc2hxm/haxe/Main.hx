package;

	import flash.display.MovieClip;
	import flash.events.MouseEvent;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	
	class Main extends MovieClip
	{
		public static inline var cnst:String = "Constant";
		public static var TEXT:String = "Hello World";
		public var bool:Bool;
		public var nr:Int;
		public var tf:TextField;
		public static function main()
		{
			flash.Lib.current.addChild(new Main());
		}
		public function new()
		{
			bool=true;
			nr=7;
			tf = new TextField();
			super();
			
			tf.border = true;
			tf.autoSize = TextFieldAutoSize.LEFT;
			tf.text = TEXT;
			tf.x=200;
			addChild(tf);
		
			var loc_btn:MovieClip = new MovieClip();
			loc_btn.x = loc_btn.y=200;
			loc_btn.graphics.beginFill(0x0000FF, 0.5);
			loc_btn.graphics.drawRect(0, 0, 100, 100);
			loc_btn.buttonMode = true;
			loc_btn.addEventListener(MouseEvent.CLICK, onClick);
			addChild(loc_btn);

			trace(this, Main, TEXT, Main.TEXT, bool, nr, tf, loc_btn, onClick, staticFunc, Main.staticFunc);
			try 
			{
				//var value:* = new Array();
				//value.getChildAt(0);
			} 
			catch(error:Dynamic) 
			{
				trace("TypeError catch: " + error);	
			}
			trace("Continuing with script...");
			while(nr<20)
			{
				if(++nr%2!=0)
					trace('while:' +nr);
			}
			for(i in 0...10)
			{
				trace('for:'+i);
			}
		}
		public function onClick(event:MouseEvent):Void
		{
			tf.appendText(Main.TEXT);
		}
		public static function staticFunc(param0:Int = 13):Int
		{
			return param0 * 2;
		}
	}