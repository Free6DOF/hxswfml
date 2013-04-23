package;
import flash.display.MovieClip;
import flash.events.MouseEvent;

class Main extends MovieClip
{
	public static function main()
	{
		var mc:MovieClip = cast flash.Lib.current.getChildByName('my_mc');
		mc.buttonMode=true;
		mc.addEventListener(MouseEvent.MOUSE_DOWN, function(e){ cast e.currentTarget.startDrag();});
		mc.addEventListener(MouseEvent.MOUSE_UP, function(e){ cast e.currentTarget.stopDrag();});
	}
}