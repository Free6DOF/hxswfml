package 
{
	import flash.display.MovieClip;
	public class Main extends MovieClip 
	{
		//available constantpool(s):[[string], [int], [uint], [float], [double], [namespace]] and Boolean
		
		public var str1:String="hello world";//str1 is an INSTANCE member and a String so it can go straight into the strings constantpool
		public var arr1:Array = ["a", 13, new MovieClip()];// no constantpool for arrays and arr1 is an INSTANCE member, so move creation to INSTANCE constructor
		
		public static var str2:String="Hello World";//str2 is a CLASS member and a String so it can go straight into the strings constantpool
		public static var arr2:Array = ["A", 23, new MovieClip()];// no constantpool for arrays and arr2 is a STATIC member so move creation to (static)CLASS constructor

		public function Main()
		{
			trace(str1, Main.str2, arr1, Main.arr2);
		}
	}
}
/*
package 
{
	import flash.display.MovieClip;
	public class Main extends MovieClip 
	{
		
		public var str1:String="hello world";
		public var arr1:Array;
		
		public static var str2:String="Hello World";
		public static var arr2:Array;

		static function Main()
		{
			arr2 = ["A", 23, new MovieClip()];
		}
		
		public function Main()
		{
			arr1 = ["a", 13, new MovieClip()];
			super();
			trace(arr1);
			trace(Main.arr2);
		}
		
	}
}
*/


