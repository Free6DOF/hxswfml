package;

import flash.display.Sprite;
import flash.events.MouseEvent;
import flash.Lib;

class Script extends Sprite
{
	public static function main()
	{
		Lib.current.addChild(new Script());
	}
	public function new()
	{
		super();
		Lib.current.getChildByName('tf').addEventListener(MouseEvent.MOUSE_DOWN, onMouseDown);
	}
	private function onMouseDown(event:MouseEvent):Void
	{
		trace (event.currentTarget);
	}
}