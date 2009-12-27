package 
{
    import flash.display.MovieClip;

    public class Main extends MovieClip
    {
        public var nr1:int = 2;

        public function Main()
        {
            if (this.nr1 == 1)
            {
                trace("one");
            }
            else if (this.nr1 == 2)
            {
                trace("two");
            }
            else if (this.nr1 == 3)
            {
                trace("three");
            }
            else
            {
                trace("other");
            }
            var _loc_1:int;
            while (_loc_1 < 5)
            {
                trace(_loc_1);
                _loc_1++;
            }
            return;
        }
    }
}

