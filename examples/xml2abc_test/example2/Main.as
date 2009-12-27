package 
{
    import flash.display.*;
    import flash.events.*;

    dynamic public class Main extends MovieClip
    {
        public var mc:Object;

        public function Main()
        {
            mc.buttonMode = true;
            mc.addEventListener(MouseEvent.CLICK, onClick);
            return;
        }

        public function onClick(param1:MouseEvent)
        {
            param1.currentTarget.x = param1.currentTarget.x + 10;
            param1.currentTarget.y = param1.currentTarget.y + 10;
            return;
        }

    }
}