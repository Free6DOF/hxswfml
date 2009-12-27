package;
import flash.display.MovieClip;
import flash.text.TextField;
import flash.Lib;
class Main extends flash.display.MovieClip
{
	public static function main()
	{
		Lib.current.addChild(new Main());
	}
	public function new ()
	{
		super();
		var tf = new TextField();
		tf.border = true;
		tf.text = "hello world";
		tf.x=tf.y=100;
		addChild(tf);
		trace('test');
		untyped __global__['trace']('test');
	}
}