package
{
	import flash.display.*;
	import flash.net.*;
	import flash.events.*;
	import flash.utils.*;
	import flash.text.*;
	import be.haxer.hxswfml.SwfWriter;
	import be.haxer.hxswfml.AbcReader;
	import haxe.io.Bytes;
	
	public class Main extends Sprite
	{
		var script:String;
		var i=0;

		public function Main()
		{
			var req = new URLRequest('original.swf');
			var l:URLLoader = new URLLoader();
			l.dataFormat = URLLoaderDataFormat.BINARY;
			l.addEventListener(Event.COMPLETE, onComplete)
			l.load(req);
			addEventListener(MouseEvent.CLICK, onClickSave)
		}
		private function onComplete(event:Event):void
		{
			var abcReader  = new AbcReader();
			var t = getTimer();
			abcReader.read('swf', haxe.io.Bytes.ofData(event.target.data));
			script = abcReader.getXML();
			tf.mouseEnabled=false;
			tf.text = "-" + String((getTimer()-t) /1000)+' s\n';
			stage.addEventListener(MouseEvent.CLICK, onClickSave)
			tf.text+="- First click on stage saves abc.xml\n-Second click saves swf";
		}
		private function onClickSave(event:MouseEvent)
		{
			var p1 = '<swf><fileattributes/>';
			var p2 = '<defineabc>' + script + '</defineabc>';
			var p3 = '<symbolclass id="0" class="flash.Boot"/><Showframe/></swf>';
			var xml = p1+p2+p3;
			
			if(i==0)
			{
				tf.text+="- Saving abc.xml\n";
				new FileReference().save(xml, 'abc.xml');
				i++
			}
			else
			{
				stage.addEventListener(MouseEvent.CLICK, onClickSave)
				tf.text+="- Compiling copy.swf";
				var swfWriter = new SwfWriter();
			swfWriter.write(xml, 'copy.swf').getData();
			var byteArray:ByteArray =swfWriter.getSWF().getData();
			new FileReference().save(byteArray, 'copy.swf');
				//setTimeout(compileCopy, 30, xml);
			}
		}
		private function compileCopy(xml)
		{
			var swfWriter = new SwfWriter();
			swfWriter.write(xml, 'copy.swf').getData();
			var byteArray:ByteArray =swfWriter.getSWF().getData();
			new FileReference().save(byteArray, 'copy.swf');
		}
	}
}