package 
{
    import flash.display.*;

    dynamic public class Main extends MovieClip
    {
        public var str1:String = "hello";
        public var str2:String = "world";

        public function Main()
        {
            trace(this, this, this, this, , , );
            this.str1 = "foo";
            this.str1 = "foo";
            ;
            trace(this.str1, this.str1, str1, str1, str1, );
            return;
        }// end function
    }
}
