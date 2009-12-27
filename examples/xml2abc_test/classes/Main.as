package 
{
    import flash.display.MovieClip;

    public class Main extends MovieClip
    {
        public var test:Test;

        public function Main()
        {
            this.test = new Test();
            trace(this.test.nr1, Test.nr2, this.test.func1(), Test.func2(), Test.func2());
            return;
        }
    }
}
