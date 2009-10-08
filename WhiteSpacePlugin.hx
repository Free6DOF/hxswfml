import haxegui.utils.Color;
import XmlEditor;

//{{{ EditorPlugin
class WhiteSpacePlugin extends EditorPlugin {

	public var folds : Array<String>;

	public static function main() {
	}

	public override function start() {
		console.log("Starting WhiteSpace Plugin...");
	}

	public override function run() {
		console.log("WhiteSpacing");
		// this.editor.tf.text += "\nFolded\n";
	}

	public override function redraw() {
		var p = 0;

		var tf = editor.tf;
		var scrollpane = editor.scrollpane;
		var gutterWidth = editor.gutterWidth;

		var start = tf.getLineOffset(tf.scrollV-1);
		var last = tf.getLineOffset(tf.bottomScrollV-1) + tf.getLineLength(tf.bottomScrollV-1);

		var r = tf.getCharBoundaries(start);
		var _y : Float = -r.y + r.height/2 + 3;

		var i = start;

		// while((i = tf.text.indexOf("\t", i))<last) {
		while((i = tf.text.indexOf("\t", i))!=-1) {
			if(i>last) break;
			var l = tf.getLineIndexOfChar(i);

			//if(l > tf.bottomScrollV) return;

			// var metrics = tf.getLineMetrics(l);
			// _y = metrics.height + 1 ;

			var rect = tf.getCharBoundaries(i);
			if(rect==null || rect.isEmpty()) rect = new flash.geom.Rectangle();
			// scrollpane.graphics.beginFill(Color.MAGENTA, .5);
			// scrollpane.graphics.drawRect(30+rect.x,rect.y,rect.width,rect.height);
			// scrollpane.graphics.endFill();

			scrollpane.content.graphics.lineStyle(1, Color.tint(Color.BLACK, .1), 1, false, flash.display.LineScaleMode.NONE);
			scrollpane.content.graphics.moveTo(gutterWidth+rect.x, _y + rect.y);
			scrollpane.content.graphics.lineTo(gutterWidth+rect.x+rect.width, _y + rect.y);

			scrollpane.content.graphics.lineStyle(1, Color.tint(Color.BLACK, .3), 1, false, flash.display.LineScaleMode.NONE);
			scrollpane.content.graphics.lineTo(gutterWidth-3+rect.x+rect.width, _y + rect.y+3);
			scrollpane.content.graphics.moveTo(gutterWidth+rect.x+rect.width, _y + rect.y);
			scrollpane.content.graphics.lineTo(gutterWidth-3+rect.x+rect.width, _y + rect.y-3);

			i++;
		}
	}

/*
	public function new() {
		super.new();
	}
*/
}
//}}}
