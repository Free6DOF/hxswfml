package 
{
    import flash.display.*;

    public class Main extends MovieClip
    {
        public var any;
        public var str1:String;
        public var str2:String = "hello world";
        public var nr1:int;
        public var nr2:int = -10;
        public var nr3:uint;
        public var nr4:uint = 10;
        public var nr5:Number;
        public var nr6:Number = 10.5;
        public var b1:Boolean;
        public var b2:Boolean = true;
        public var obj:Object;
        public var arr:Array;
        public var mc:MovieClip;
        public static var nr7:int = 11;
				public const nr8:int = 12;
				
        public function Main()
        {
						super();
            trace(this.any);
            trace(this.nr1);
            trace(this.nr2);
            trace(this.nr3);
            trace(this.nr4);
            trace(this.nr5);
            trace(this.nr6);
            trace(this.b1);
            trace(this.b2);
            trace(this.obj);
            trace(this.arr);
            trace(this.mc);
            trace(Main.nr7);
            trace(this.nr8);
            return;
        }// end function

    }
}
