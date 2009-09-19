// Copyright (c) 2009 The haxegui developers
//
// Permission is hereby granted, free of charge, to any person obtaining a copy of
// this software and associated documentation files (the "Software"), to deal in
// the Software without restriction, including without limitation the rights to
// use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
// the Software, and to permit persons to whom the Software is furnished to do so,
// subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in all
// copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
// FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
// COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
// IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
// CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


//{{{ Imports
import feffects.Tween;
import flash.accessibility.Accessibility;
import flash.display.Bitmap;
import flash.display.BitmapData;
import flash.display.DisplayObject;
import flash.display.DisplayObjectContainer;
import flash.display.Loader;
import flash.display.LoaderInfo;
import flash.display.MovieClip;
import flash.display.Sprite;
import flash.display.Stage;
import flash.events.DataEvent;
import flash.events.Event;
import flash.events.EventDispatcher;
import flash.events.FocusEvent;
import flash.events.KeyboardEvent;
import flash.events.MouseEvent;
import flash.events.TextEvent;
import flash.external.ExternalInterface;
import flash.geom.Point;
import flash.geom.Rectangle;
import flash.geom.Transform;
import flash.Lib;
import flash.net.FileFilter;
import flash.net.FileReference;
import flash.net.FileReferenceList;
import flash.net.URLLoader;
import flash.net.URLRequest;
import flash.system.Capabilities;
import flash.text.TextField;
import flash.ui.Keyboard;
import haxegui.Appearance;
import haxegui.Automator;
import haxegui.Binding;
import haxegui.ColorPicker;
import haxegui.ColorPicker2;
import haxegui.Console;
import haxegui.containers.Accordion;
import haxegui.containers.Container;
import haxegui.containers.Divider;
import haxegui.containers.Grid;
import haxegui.containers.ScrollPane;
import haxegui.containers.Stack;
import haxegui.controls.Button;
import haxegui.controls.CheckBox;
import haxegui.controls.ComboBox;
import haxegui.controls.Component;
import haxegui.controls.Expander;
import haxegui.controls.Image;
import haxegui.controls.Input;
import haxegui.controls.Label;
import haxegui.controls.MenuBar;
import haxegui.controls.PopupMenu;
import haxegui.controls.RadioButton;
import haxegui.controls.Slider;
import haxegui.controls.Stepper;
import haxegui.controls.TabNavigator;
import haxegui.controls.ToolBar;
import haxegui.controls.Tree;
import haxegui.controls.UiList;
import haxegui.DataSource;
import haxegui.events.MenuEvent;
import haxegui.events.ResizeEvent;
import haxegui.Haxegui;
import haxegui.Introspector;
import haxegui.managers.CursorManager;
import haxegui.managers.FocusManager;
import haxegui.managers.LayoutManager;
import haxegui.managers.MouseManager;
import haxegui.managers.ScriptManager;
import haxegui.managers.StyleManager;
import haxegui.managers.WindowManager;
import haxegui.RichTextEditor;
import haxegui.Stats;
import haxegui.utils.Color;
import haxegui.utils.Printing;
import haxegui.utils.Size;
import haxegui.Window;
import haxe.remoting.HttpAsyncConnection;
import haxe.Timer;
//}}}


using haxegui.utils.Color;


/**
* XmlEditor
*
*
* @author Omer Goshen <gershon@goosemoose.com>
* @author Russell Weir <damonsbane@gmail.com>
* @version 0.26
*/
class XmlEditor extends Window {

	//{{{ Members
	// public var container		: Container;
	public var vdivider 		: Divider;
	public var hdivider 		: Divider;
	public var scrollpane 		: ScrollPane;
	public var treePane			: ScrollPane;

	public var tree				: Tree;
	public var hbox				: Grid;
	public var list1			: UiList;
	public var list2			: UiList;

	public var tf 				: TextField;
	public var gutter 			: TextField;

	public var xml				: Xml;

	public var currentLine 		: Int;
	public var currentAttrib	: String;
	public var indent			: String;

	public var mode	  			: Xml;

	private var openTags 		: Array<String>;

	//{{{ Static

	public static var SWFMILL_TAGS : Array<String> = ["place", "clip", "sound", "textfield", "font"];


	static var layoutXml = Xml.parse('
	<haxegui:Layout name="XmlEditor">
	<haxegui:controls:ToolBar y="20" height="24"/>
	<haxegui:containers:VDivider name="divider" handlePosition="200"  top="44" bottom="0" fitV="false">
	<haxegui:containers:HDivider name="divider2" top="0">
	<haxegui:containers:ScrollPane name="treePane">
			<!-- Tree will be added here later -->
	</haxegui:containers:ScrollPane>
	<haxegui:containers:Grid name="hbox" cellSpacing="0" rows="1" cols="2">
	<!-- Lists will be added here later -->
	</haxegui:containers:Grid>
	</haxegui:containers:HDivider>
	<haxegui:containers:ScrollPane name="textPane">
	<!-- Text will be added here later -->
	</haxegui:containers:ScrollPane>
	</haxegui:containers:VDivider>
	<haxegui:windowClasses:StatusBar>
	<haxegui:controls:Label name="info" x="2" y="2" />
	</haxegui:windowClasses:StatusBar>
	</haxegui:Layout>
	').firstElement();
	//}}}
	//}}}

	//{{{ Functions
	//{{{ init
	override public function init(?opts:Dynamic=null) {
		openTags = [];

		super.init(opts);

		layoutXml.set("name", name);

		haxegui.XmlParser.apply(XmlEditor.layoutXml, this);


		statusbar = getElementsByClass(haxegui.windowClasses.StatusBar).next();

		// container = cast getChildByName("container");

		vdivider = cast getChildByName("divider");
		hdivider = untyped vdivider.getChildByName("divider2");
		treePane = cast hdivider.getChildByName("treePane");
		scrollpane = cast vdivider.getChildByName("textPane");


		//tree = cast treePane.getChildByName("tree");
		tree = new Tree(treePane);
		tree.init({});


		hbox = cast hdivider.getChildByName("hbox");
		list1 = new UiList(hbox);
		list1.init({description: "Attribute"});

		list2 = new UiList(hbox);
		list2.init({description: "Value"});

		// graphics for the gutter
		scrollpane.setAction("redraw",
		"
		this.graphics.clear();
		this.graphics.beginFill(Color.tint(Color.BLUE, .1));
		this.graphics.drawRect(0,0,30,this.box.height);
		this.graphics.endFill();
		this.graphics.lineStyle(2, Color.tint(Color.BLUE, .4), 1, false, flash.display.LineScaleMode.NONE, flash.display.CapsStyle.NONE);
		this.graphics.moveTo(30,0);
		this.graphics.lineTo(30,this.box.height);
		this.graphics.lineStyle(0,0,0);
		this.graphics.beginFill(Color.tint(Color.WHITE, 0));
		this.graphics.drawRect(30,0,this.box.width-30,this.box.height);
		this.graphics.endFill();
		"
		);
		scrollpane.redraw();

		scrollpane.content.tabChildren = false;
		scrollpane.content.tabEnabled = false;

		//
		tf = new flash.text.TextField();
		tf.name = "tf";
		tf.x = 30;
		tf.multiline = true;
		tf.wordWrap = false;
		tf.embedFonts = false;
		tf.alwaysShowSelection = true;
		tf.type = flash.text.TextFieldType.INPUT;
		tf.defaultTextFormat = new flash.text.TextFormat("FreeMono", 14);

		tf.addEventListener(TextEvent.TEXT_INPUT, updateStatusBar);
		tf.addEventListener(Event.SCROLL, onTextFieldScrolled);
		tf.addEventListener(Event.CHANGE, updateStatusBar);
		tf.addEventListener(MouseEvent.MOUSE_DOWN, updateStatusBar);
		tf.addEventListener(MouseEvent.MOUSE_UP, updateStatusBar);
		tf.addEventListener(KeyboardEvent.KEY_DOWN, updateStatusBar);

		var keyFocusChangeHandler = function(e:FocusEvent) {
			e.preventDefault();
			flash.Lib.current.stage.focus = cast e.target;
		}

		var self = this;

		var keyDownHandler = function(e:KeyboardEvent) {
			var tf = e.target;
			var i = tf.caretIndex;
			switch(e.keyCode) {
				case 9:
				if(e.shiftKey) {
					var fp = tf.getFirstCharInParagraph(tf.caretIndex);
					var f = tf.text.charAt(fp);
					if(f=="\t") tf.replaceText(fp,fp+1, "");
					tf.setSelection(i-1,i-1);
				}
				else {
					tf.replaceText(i,i, "\t");
					tf.setSelection(i+1,i+1);
				}
				tf.addEventListener(FocusEvent.KEY_FOCUS_CHANGE, keyFocusChangeHandler);

				// DELETE & BACKSPACE
				case 46, 8:
				try {
					self.xml = Xml.parse(self.tf.text);
					//self.updateTree();
				}
				catch(e:Dynamic) {
					/** @todo highlight error */
				}

				// case ">".code:
				case 190:
				var lastChar = tf.text.substr(tf.text.length-1,1);
				if(lastChar!="/")
				if(e.shiftKey) {
					var line = tf.getLineText(tf.getLineIndexOfChar(tf.caretIndex-1));

					var r = ~/[^<]([\/?!]?\w+)/i;
					if(r.match(line))
					self.openTags.push(r.matched(0));
					//trace(self.openTags);
				}


			}

		}

		tf.addEventListener(KeyboardEvent.KEY_DOWN, keyDownHandler);

		scrollpane.addChild(tf);

		tf.text = "\n";
		var m1 = tf.getLineMetrics(0);
		//
		gutter = new flash.text.TextField();
		var fmt = DefaultStyle.getTextFormat();
		gutter.defaultTextFormat = fmt;
		for(i in 1...1000)
		gutter.text += StringTools.lpad(cast i,'0',3) + '\n';

		var m2 = gutter.getLineMetrics(0);
		gutter.y = Std.int(m1.height - m2.height)>>1 - 1;
		gutter.width = 30;
		gutter.height = 1000;
		gutter.wordWrap = false;
		gutter.mouseEnabled = false;
		fmt.color = Color.tint(Color.BLUE, .4);
		fmt.leftMargin = 6;
		//fmt.leading = 11;
		fmt.leading = m2.height;
		gutter.setTextFormat(fmt);

		scrollpane.addChild(gutter);


		scrollpane.vert.scrollee = tf;
		scrollpane.horz.scrollee = tf;



		tf.addEventListener(Event.SCROLL, onScroll, false, 0, true);


		tf.addEventListener(TextEvent.TEXT_INPUT, onChange, false, 0, true);


	}
	//}}}

	public function onChange(e:TextEvent) {
		highlight();
		//haxe.Timer.delay(updateTree, 300);
	}


	//{{{ onTextFieldScrolled
	public function onTextFieldScrolled(e:Event) {
		updateStatusBar(null);
		redrawTextPane();
	}
	//}}}


	//{{{ getTagUnderPoint
	public function getTagUnderPoint(p:Point) {
		if(tf==null || tf.text==null || tf.text=="") return;
		try {

			//var i = tf.getLineIndexOfChar(tf.caretIndex);
			currentLine = tf.getLineIndexAtPoint(p.x, p.y);

			//var len = tf.getLineLength(i);
			var start = tf.getFirstCharInParagraph(tf.caretIndex);
			//var line = tf.text.substr(start, len);

			var line = "";


			var line = tf.getLineText(currentLine);
			//line = StringTools.ltrim(line);

			var r = ~/[^<]([\/?!]?\w+)/;
			var tag = "";
			var m = { pos : 0, len : 0};
			r.match(line);
			tag = r.matched(0);
			m = r.matchedPos();

			//		var fmt = new flash.text.TextFormat("FreeMono", 14);
			//		fmt.size = 14;
			//		fmt.color = Color.RED;
			//		fmt.bold = true;
			//		tf.setTextFormat(fmt, start+m.pos, start+m.pos+m.len);

			//var tag = line.split("<").pop().split(">").shift();

			//line = StringTools.htmlEscape(line);

			xml = Xml.parse(tf.text);


			var getAll = function(x:Xml, s:String) {
				var e = x.elementsNamed(s);
				var rz = [];
				for(ee in e) rz.push(ee);
				for(xx in x.elements()) {
					var e2 = xx.elementsNamed(s);
					for(ee2 in e2) rz.push(ee2);
				}
				return rz.iterator();
			}
			var els = getAll(xml, tag);

			//trace((i+1)+":"+tag);

			list1.removeItems();
			list2.removeItems();

			var ds1 = list1.dataSource = new DataSource();
			var ds2  = list1.dataSource = new DataSource();
			ds1.data = [""];
			ds2.data = [""];

			var esc = StringTools.htmlEscape(line);
			if(esc.charAt(line.length-1)==">" && esc.charAt(line.length-2)!="/")
			line = esc.substr(0, esc.length-1)+"/>";


			var lineXml = Xml.parse(line).firstElement();
			for(i in lineXml.attributes()) {
				ds1.data.push(i);
				ds2.data.push(lineXml.get(i));
			}

			//trace(ds1.data);
			//trace(ds2.data);
			ds1.data.push("");
			ds2.data.push("");

			ds1.data.push("");
			ds2.data.push("");

			list1.dataSource = ds1;
			list2.dataSource = ds2;

			for(i in list2.getElementsByClass(ListItem)) {

				//	i.removeEventListener(MouseEvent.CLICK, i.onMouseClick);
				i.addEventListener(MouseEvent.CLICK, onListItemClicked, false, 0, true);

				i.setAction("focusOut",
				"
				if(this.numChildren==1) return;

				var o = this.getChildAt(1);
				if(o==null) return;

				if(Std.is(o, controls.Input))
				this.label.setText(o.getText());
				else
				if(Std.is(o, controls.Stepper))
				this.label.setText(o.adjustment.valueAsString());

				o.destroy();
				this.label.visible = true;
				");
			}

			updateTree();

			var id = lineXml.get("id");
		}
		catch(e:Dynamic) {
			// trace(Std.string(e));
			// trace(haxegui.utils.Printing.print_r(haxe.Stack.exceptionStack()));
		}
	}
	//}}}

	//{{{ onListItemClicked
	public function onListItemClicked(e:MouseEvent) {
		if(!Std.is(e.target, ListItem)) return;
		if(e.target.numChildren!=1) return;
		if(Std.is(e.target, Input)) return;


		e.preventDefault();
		e.stopPropagation();

		var index = list2.getChildIndex(e.target);
		currentAttrib = list1.dataSource.data[index];


		var start = tf.getFirstCharInParagraph(tf.caretIndex);
		var line = tf.getLineText(currentLine);
		var i = line.indexOf(currentAttrib);
		var xml = Xml.parse(line).firstElement();

		//trace(start+":"+currentAttrib+"='"+xml.get(currentAttrib)+"'");

		tf.setSelection(start+i+2+currentAttrib.length, start+i+2+currentAttrib.length+xml.get(currentAttrib).length);

		updateStatusBar(null);

		e.target.label.visible = false;

		switch(currentAttrib) {
			case "color":
			var swatch = new haxegui.controls.Swatch(e.target);
			swatch.init({
				width: Math.max(e.target.box.width, e.target.label.box.width),
				height: e.target.box.height-2,
				_color: "0x"+xml.get(currentAttrib).substr(2,xml.get(currentAttrib).length-2)
			});

			case "x", "y", "depth":
			var stepper = new haxegui.controls.Stepper(e.target);
			stepper.init({
				width: e.target.box.width-10,
				value: Std.parseInt(xml.get(currentAttrib))
			});

			stepper.adjustment.addEventListener(Event.CHANGE, onStepperChanged, false, 0, true);

			case "id", "name", "import":
			var input = new haxegui.controls.Input(e.target);
			input.init({
				//width: Math.max(e.target.box.width, e.target.label.box.width),
				//text: xml.get(currentAttrib)
				text: xml.get(currentAttrib)
			});

			input.tf.setSelection(0, input.getText().length);
			input.tf.scrollH = 0;
			//input.stage.focus = input.tf;

			input.tf.addEventListener(TextEvent.TEXT_INPUT, onInputChanged, false, 0, true);
		}

	}
	//}}}


	//{{{ onStepperChanged
	public function onStepperChanged(e:Event) {
		if(currentAttrib==null) return;
		updateAttrib(e.target.valueAsString());
	}
	//}}}


	//{{{ onInputChanged
	public function onInputChanged(e:TextEvent) {
		if(currentAttrib==null) return;
		updateAttrib(e.target.text+e.text);
	}
	//}}}


	//{{{ onMouseDown
	public override function onMouseDown(e:MouseEvent) {

		if(e.target==tf) {
			getTagUnderPoint(new Point(e.localX, e.localY));
			redrawTextPane();
			tf.addEventListener(MouseEvent.MOUSE_MOVE, updateStatusBar);
			stage.addEventListener(MouseEvent.MOUSE_UP, onStageMouseUp);
		}
		else
		if(tree.contains(e.target)) {
			// e.stopImmediatePropagation();
			// e.preventDefault();

			// trace(e.target);
			var path : Array<Dynamic> = [];

			if(Std.is(e.target, Label)) {
				var p = e.target.parent;

				if(Std.is(p, TreeLeaf))
				path = p.getPath();
				else
				if(Std.is(p, Expander)) {
					p.expanded = false;
					path = p.parent.getPath();
				}
			}

			if(Std.is(e.target, TreeLeaf)) path = e.target.getPath();
			// if(Std.is(e.target, Expander)) tag = e.target.label.getText();
			// if(Std.is(e.target, TreeNode)) tag = e.target.getPath();
			// if(Std.is(e.target, TreeNode)) tag = e.target.expander.label.getText();

			path.shift();

			var node = xml;

			for(i in path) {
				node = node.elementsNamed(i).next();
			}

			if(node==null) return;

			// trace(path);
			//trace(StringTools.htmlEscape(node.toString()));
			var i = tf.text.indexOf(node.toString());

			tf.setSelection(i, i+node.toString().length);

			var rect = tf.getCharBoundaries(tf.caretIndex);

			var j = tf.getLineIndexOfChar(i);
			// var metrics = tf.getLineMetrics(i);
			// var lineHeight = metrics.height;
			// var offset = j*lineHeight;
			// offset -= (tf.scrollV-1) * lineHeight;
			// var p = new flash.geom.Point(0,offset);
			// var p = tf.localToGlobal(p);
			// var realOffset = scrollpane.globalToLocal(p).y ;
			tf.scrollV = j;
			tf.dispatchEvent(new Event(Event.SCROLL));

			try {
			list1.removeItems();
			list2.removeItems();

			var ds1 = list1.dataSource = new DataSource();
			var ds2  = list1.dataSource = new DataSource();
			ds1.data = [""];
			ds2.data = [""];

			for(i in node.attributes()) {
				ds1.data.push(i);
				ds2.data.push(node.get(i));
			}

			ds1.data.push("");ds2.data.push("");
			ds1.data.push("");ds2.data.push("");

			list1.dataSource = ds1;
			list2.dataSource = ds2;
			}
			catch(e:Dynamic) {
				trace(e);
			}

		}

		super.onMouseDown(e);
	}
	//}}}

	public function onStageMouseUp(e:MouseEvent) {
		tf.removeEventListener(MouseEvent.MOUSE_MOVE, updateStatusBar);
		stage.removeEventListener(MouseEvent.MOUSE_UP, onStageMouseUp);
	}


	//{{{ onResize
	public override function onResize(e:ResizeEvent) {
		super.onResize(e);

		//		if(scrollpane==null) return;
		//		scrollpane.redraw();
		//		drawTabs();
		//		redrawTextPane();


		//		var metrics = tf.getLineMetrics(i);

		if(tf==null) return;
		tf.width = Math.max(scrollpane.width, tf.width);
		tf.height = scrollpane.height - (scrollpane.horz.visible ? 20 : 0);

		// highlight();
	}
	//}}}
	//{{{
	public function onScroll(e:Event) {
		gutter.scrollV = tf.scrollV;
		//		scrollpane.vert.adjustment.setValue( tf.scrollV / tf.maxScrollV );
		var bar = scrollpane.vert;

		if(!bar.handle.isTweening)
		bar.handle.y = tf.scrollV / tf.maxScrollV * (bar.frame.box.height - bar.handle.box.height - 20);
		else
		bar.updatePositionTween();
	}
	//}}}


	//{{{ onKeyDown
	public override function onKeyDown(e:KeyboardEvent) {
		if(e.target==tf)
		updateStatusBar(e);

		super.onKeyDown(e);
	}
	//}}}


	public function moveToEOL(e:Dynamic) {
		var p = tf.getFirstCharInParagraph(tf.caretIndex);
		var line = tf.getLineText(tf.getLineIndexOfChar(tf.caretIndex));

		tf.setSelection(p+line.length, p+line.length);
	}


	//{{{ onKeyUp
	public override function onKeyUp(e:KeyboardEvent) {
		if(e.target==tf) {
			redrawTextPane();
			var i = tf.caretIndex;
			switch(e.keyCode){
				// case "/".code:
				case 191:
				var lastChar = tf.text.charAt(tf.caretIndex-1);
				//if(lastChar=="<" &&
				if(openTags.length>0) {
					var tag = openTags.pop();
					tf.setSelection(i-1, i);
					tf.replaceSelectedText("/"+tag+">");
					tf.setSelection(i + tag.length + 2, i + tag.length + 2);
					highlight();
				}
				case Keyboard.LEFT, Keyboard.RIGHT, Keyboard.UP, Keyboard.DOWN:
				default:
				// highlight();
			}
		}
		super.onKeyUp(e);
	}
	//}}}


	//{{{ onMouseWheel
	public override function onMouseWheel(e:MouseEvent) {
		updateStatusBar(null);


		super.onMouseWheel(e);

	}
	//}}}


	//{{{ redrawTextPane
	public function redrawTextPane() {
		try {
			scrollpane.content.graphics.clear();
			drawTabs();

			var rect = tf.getCharBoundaries(tf.caretIndex);

			var i = tf.getLineIndexOfChar(tf.caretIndex);
			if(i<0) return;
			var metrics = tf.getLineMetrics(i);
			var lineHeight = metrics.height;

			var offset = i*lineHeight;
			//		var offset = i*lineHeight - tf.getLineMetrics(i).leading;
			//		var offset = i*lineHeight - metrics.leading - metrics.descent ;
			offset -= (tf.scrollV-1) * lineHeight;

			var p = new flash.geom.Point(0,offset);
			var p = tf.localToGlobal(p);
			var realOffset = scrollpane.globalToLocal(p).y ;

			scrollpane.content.graphics.lineStyle(1, Color.tint(Color.GREEN, .3), 1, false, flash.display.LineScaleMode.NONE);
			scrollpane.content.graphics.beginFill(Color.tint(Color.GREEN,.2), .5);
			scrollpane.content.graphics.drawRect(30,realOffset,tf.width-50, lineHeight);
			scrollpane.content.graphics.endFill();

		}
		catch(e:Dynamic) {
			// trace(e);
		}
	}
	//}}}


	//{{{ updateTree
	public function updateTree() {
		if(xml==null || xml.firstElement()==null) return;

		haxegui.Profiler.begin(here.className.split(".").pop()+"."+here.methodName);

		tree.rootNode.removeItems();

		/*
		var o = {};

		if(xml.firstElement().elementsNamed("frame").hasNext())
		for(frame in xml.firstElement().elementsNamed("frame")) {
		var f = {};
		Reflect.setField(o, "frame", f);

		var lib = frame.firstElement();

		for(tagName in SWFMILL_TAGS) {
		var tag = {};
		var elements = lib.elementsNamed(tagName);
		if(elements.hasNext()) {
		Reflect.setField(f, tagName, tag);
		for(el in elements)
		Reflect.setField(tag, el.get("id"), el.get("id"));
		}
		}

		}
		tree.process(o, tree.rootNode);
		*/

		tree.processXml(xml, tree.rootNode);

		tree.expandFull();

		haxegui.Profiler.end();
	}
	//}}}


	//{{{ highlight
	public function highlight() {
		haxegui.Profiler.begin(here.className.split(".").pop()+"."+here.methodName);

		//var dt = haxe.Timer.stamp();
		if(mode==null) return;
		// var rules : Iterator<Xml> = mode.elements();

		var rules = new haxe.xml.Fast(mode);

		//  var a : Array<Xml> = [];
		// for(i in rules)	a.push(i);
		// var sortRules = function(x:Xml, y:Xml) return Std.parseInt(x.get("order")) - Std.parseInt(y.get("order"));
		// a.sort(sortRules);
		// for(i in a) {

		// var ri = ~/<data>(.*)<\/data>/gm;

		for(i in rules.nodes.rule) {
			//trace(i.get("name")+": "+StringTools.htmlEscape(i.get("value")));
			// var start = tf.getLineOffset(tf.scrollV-1);
			// var last = tf.getLineOffset(tf.bottomScrollV-1) + tf.getLineLength(tf.bottomScrollV-1);
			// var str = tf.text.substr(start,last);
			var str = tf.text;

			var offset = 0;
			//var r = new EReg(i.get("value"), "i");
			// var r = new EReg(StringTools.htmlUnescape(i.get("value")), "");
			var ereg = StringTools.htmlUnescape(i.att.value);
			var r = new EReg(ereg, "");

			//var fmt = source.getTextFormat();
			var fmt = new flash.text.TextFormat("FreeMono", 14);
			fmt.size = 14;
			fmt.bold = (i.has.bold && i.att.bold=="true");
			fmt.color = Std.parseInt(i.att.color);
			fmt.italic = (i.has.italic && i.att.italic=="true");
			fmt.underline = (i.has.underline && i.att.underline=="true");

			while(r.match(str)) {
				//trace(r.matched(0));
				var m = r.matchedPos();

				tf.setTextFormat(fmt, offset+m.pos, offset+m.pos+m.len);
				str = r.matchedRight();
				offset += m.pos+m.len;
			}
		}


		//trace("Highlighting took: "+(haxe.Timer.stamp()-dt));
		haxegui.Profiler.end();
	}
	//}}}

	//{{{ drawTabs
	public function drawTabs() {
		var p = 0;


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
			scrollpane.content.graphics.moveTo(30+rect.x, _y + rect.y);
			scrollpane.content.graphics.lineTo(30+rect.x+rect.width, _y + rect.y);

			scrollpane.content.graphics.lineStyle(1, Color.tint(Color.BLACK, .3), 1, false, flash.display.LineScaleMode.NONE);
			scrollpane.content.graphics.lineTo(27+rect.x+rect.width, _y + rect.y+3);
			scrollpane.content.graphics.moveTo(30+rect.x+rect.width, _y + rect.y);
			scrollpane.content.graphics.lineTo(27+rect.x+rect.width, _y + rect.y-3);

			i++;
		}
	}
	//}}}


	//{{{ updataAttrib
	public function updateAttrib(a:String) {
		var line = tf.getLineText(currentLine);
		var sh = tf.scrollH;

		indent = "";
		var i = 0;
		while(line.charAt(i)=="\t") {
			indent += "\t";
			i++;
		}

		var start = tf.getFirstCharInParagraph(tf.caretIndex);
		i = line.indexOf(currentAttrib);

		var xml = Xml.parse(line).firstElement();

		//trace(start+":"+currentAttrib+"="+xml.get(currentAttrib));

		tf.setSelection(start+i, start+i+xml.get(currentAttrib).length);

		xml.set(currentAttrib, a);

		tf.setSelection(start, start+line.length);
		tf.replaceSelectedText(indent+xml.toString());
		tf.setSelection(start+i+2+currentAttrib.length, start+i+2+currentAttrib.length+xml.get(currentAttrib).length);

		tf.scrollH = sh;

		highlight();
	}
	//}}}


	//{{{ clear
	public function clear() {
		tf.text = "";
		tf.defaultTextFormat = new flash.text.TextFormat("FreeMono", 14);

		for(i in list1.getElementsByClass(ListItem))
		i.destroy();

		for(i in list2.getElementsByClass(ListItem))
		i.destroy();

		tree.rootNode.removeItems();
	}
	//}}}


	//{{{ updateStatusBar
	public function updateStatusBar(e:Dynamic) {
		if(tf.text=="") return;
		var info = cast statusbar.getChildAt(0);

		var l = 0;
		// var c = 0;
		if(Std.is(e, MouseEvent)) {
			l = tf.getLineIndexAtPoint(e.localX, e.localY);
			// c = tf.getCharIndexAtPoint(e.localX, e.localY);
		}
		if(Std.is(e, KeyboardEvent)) {
			l = tf.getLineIndexOfChar( tf.caretIndex );
		}
		var o = {
			pos: tf.caretIndex,
			line: l,
			scrollV: tf.scrollV-1,
			bottomScrollV: tf.bottomScrollV,
			sel: tf.selectedText.length,
			numLines: tf.numLines,
		};
		var txt = Std.string(o);
		txt = txt.substr(1, txt.length-2);
		txt = txt.split(",").join("\t ");
		info.tf.text = txt;

	}
	//}}}


	//{{{ __init__
	static function __init__() {
		haxegui.Haxegui.register(XmlEditor);
	}
	//}}}
	//}}}
}
