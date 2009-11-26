package;
import flash.display.MovieClip;
import flash.events.MouseEvent;

class MyButton extends MovieClip
{
	public function new()
	{
		super();
		this.gotoAndStop(1);
		addEventListener(MouseEvent.MOUSE_OUT, onRollOut);
		addEventListener(MouseEvent.MOUSE_OVER, onRollOver);
		addEventListener(MouseEvent.MOUSE_DOWN, onPress);
		addEventListener(MouseEvent.MOUSE_UP, onMouseUp);
	}
	private function onRollOver(event:MouseEvent):Void
	{
		//this.gotoAndStop(2);//frameNumber
		this.gotoAndStop('f02');//frameLabel
		trace('over');
	}
	private function onRollOut(event:MouseEvent):Void
	{
		this.gotoAndStop('f01');
		trace('out');
	}
	
	private function onPress(event:MouseEvent):Void
	{
		this.gotoAndStop('f03');
		trace('down');
	}
	private function onMouseUp(event:MouseEvent):Void
	{
		this.gotoAndStop('f02');
		trace('up');
	}
}