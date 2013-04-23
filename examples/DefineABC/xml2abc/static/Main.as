package [Global]
{
	import flash.display.MovieClip
    public class Main extends MovieClip 
    {
		public var mc:MovieClip=new MovieClip();
		public var arr:Array = ["a",1,mc];
		public var str1 : String = "hello";
        public static var str2 : String = "world";
        
        public static function Main()
        {
            return;
        }
        public function Main()
        {
					/*
            super();
						trace(arr);
            trace(this.str1, this.str2, this.str1, this.str2, blah, blah);
            this.test1();
            Main.test2();
            //FAILED to Decompile Block:NEED TO IMPLEMENT THIS opcode: getglobalslot
					*/
						super();
            trace(this.str1, this.str2, this.str1, this.str2, this.str1, this.str2);
            this.test1();
            Main.test2();
            Main.test2();
						Main.test2();
						return;
        }
        public static function test2()
        {
            trace("World");
            return;
        }
        public function test1()
        {
            this.trace("Hello");
            return;
        }
    }
}


