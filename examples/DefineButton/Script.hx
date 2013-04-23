package;

import flash.display.Sprite;
import flash.events.MouseEvent;
import flash.Lib;

/**
* ...
* @author jan j.
*/

class Script extends Sprite
{
	public static function main()
	{
		Lib.current.addChild(new Script());
	}
	public function new()
	{
		super();
		Lib.current.getChildByName('button').addEventListener(MouseEvent.MOUSE_DOWN, onMouseDown);
	}
	private function onMouseDown(event:MouseEvent):Void
	{
		trace (event.currentTarget);
	}
}