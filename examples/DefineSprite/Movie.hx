package;
import flash.display.MovieClip;
import flash.display.Sprite;
import flash.events.MouseEvent;
import flash.Lib;
import MyButton;

class Movie extends Sprite
{
	var btn:MyButton;
	public function new()
	{
		super();
		btn=new MyButton();
		btn.x=150;
		btn.y=50;
		addChild(btn);
	}
	public static function main()
	{
		Lib.current.addChild(new Movie());
	}
}
