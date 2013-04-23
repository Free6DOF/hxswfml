package 
{
    import flash.display.*;

    dynamic public class Main extends MovieClip
    {
        public var _id:int = 10;

        public function Main()
        {
            this.func1();
            var _loc_1:* = this.func2();
            trace(this.func3(3, "three"));
            Main.func4();
            trace(this.id);
            this.id = 11;
            return;
        }// end function

        public function func1()
        {
            trace(1);
            return;
        }// end function

        public function func2()
        {
            return 2;
        }// end function

        public function func3(param1:int, param2:String)
        {
            return param1 + "=" + param2;
        }// end function

        public function get id()
        {
            return _id;
        }// end function

        public function set id(param1:int)
        {
            this._id = param1;
            trace(this._id);
            return;
        }// end function

        public static function func4()
        {
            trace(4);
            return;
        }// end function

    }
}