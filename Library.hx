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
import flash.Lib;
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
import flash.external.ExternalInterface;
import flash.geom.Point;
import flash.geom.Rectangle;
import flash.geom.Transform;
import flash.net.FileFilter;
import flash.net.FileReference;
import flash.net.FileReferenceList;
import flash.net.URLLoader;
import flash.net.URLRequest;
import flash.system.Capabilities;
import flash.text.TextField;
import haxe.Timer;
import haxe.remoting.HttpAsyncConnection;
import haxegui.Appearance;
import haxegui.Automator;
import haxegui.Binding;
import haxegui.ColorPicker2;
import haxegui.ColorPicker;
import haxegui.Console;
import haxegui.Haxegui;
import haxegui.Introspector;
import haxegui.RichTextEditor;
import haxegui.Stats;
import haxegui.Window;
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
import haxegui.controls.UiList;
import haxegui.controls.Tree;
import haxegui.events.MenuEvent;
import haxegui.events.ResizeEvent;
import haxegui.managers.CursorManager;
import haxegui.managers.FocusManager;
import haxegui.managers.LayoutManager;
import haxegui.managers.MouseManager;
import haxegui.managers.ScriptManager;
import haxegui.managers.StyleManager;
import haxegui.managers.WindowManager;
import haxegui.utils.Color;
import haxegui.utils.Printing;
import haxegui.utils.Size;
import haxegui.DataSource;

import Actions;
//}}}


using haxegui.utils.Color;


/**
* Library
*
*
* @author Omer Goshen <gershon@goosemoose.com>
* @author Russell Weir <damonsbane@gmail.com>
* @version 0.26
*/
class Library extends Window {

	//{{{ Members
	public var tabnav  		: TabNavigator;
	public var container  	: Container;
	public var scrollpane	: ScrollPane;
	public var list1		: UiList;
	public var list2		: UiList;
	//}}}


	//{{{ Functions
	//{{{ init
	override public function init(?opts:Dynamic=null) {
		minSize = new Size(70,88);

		super.init(opts);


		scrollpane = new ScrollPane(this, "ScrollPane1", 10, 44);
		scrollpane.init({
		top: 44
		});


		container = new Container(scrollpane, "Container1");
		container.init();


		list1 = new UiList(container, "list1", 0, 0);
		list1.init({
			left: 0,
			right: 60,
			top: 0,
			bottom: 20,
			description: "Item"
		});

		list2 = new UiList(container, "list2", 0, 0);
		list2.init({
			width: 60,
			right: 0,
			top: 0,
			bottom: 20,
			description: "Size"
		});

		tabnav = cast getChildByName("tabnav");
	}
	//}}}


	//{{{ onResize
	public override function onResize(e:ResizeEvent) {
		super.onResize(e);

		tabnav = cast getChildByName("tabnav");
		if(tabnav!=null) {
			tabnav.box.width = this.box.width - 10;
			tabnav.dirty = true;
		}
	}
	//}}}


	//{{{ clear
	public function clear() {
		list1.removeItems();
		list2.removeItems();

		list1.dirty = true;
		list2.dirty = true;
	}
	//}}}


	//{{{ addItem
	public function addItem(clip:Xml) {
		//trace(StringTools.htmlEscape(Std.string(clip)));

		var i = list1.numChildren-2;

		var item = new ListItem(list1, 0, 20*i);
		item.init({
			// color: DefaultStyle.INPUT_BACK,
			color: i%2==0 ? DefaultStyle.INPUT_BACK : DefaultStyle.INPUT_BACK.darken(10),
			label: clip.get("id")
		});

		var img = "assets/icons/MovieClip.png";
		var s = 16;
		var l = 8;
		var t = 4;

		if(clip.exists("import")) {
			var ext = clip.get("import").split(".").pop();
			switch(ext) {
				case "jpg", "jpeg", "png":
				img = clip.get("import");
				s = 24;
				t = 0;
				l = 4;
				case "svg":
				img = "assets/icons/vector-gfx-16x16.png";
			}
		}

		var image = new Image(item, "image", 4, 0);
		image.init({
			top: t,
			left: l,
			width: s,
			height: s,
			src: img
		});

		item.label.x += 24;

		var l2 = list2;
		var onStats = function(s:Dynamic) {
			var size = "";
			if(s.size<1024)
			size = s.size + " B";
			else
			size = Std.string(s.size/(2<<10)).substr(0,5) + " KB";

			var item2 = new ListItem(l2, 0, 20*i);
			item2.init({
				// color: DefaultStyle.INPUT_BACK,
				color: i%2==0 ? DefaultStyle.INPUT_BACK : DefaultStyle.INPUT_BACK.darken(10),
			label: size});

		}
		Actions.getFileStats(clip.get("import"), onStats);

		item.setAction("mouseDown",
		"
		var img = this.getChildByName('image');
		img = root.addChild(img.clone());

		img.x = event.stageX;
		img.y = event.stageY;
		img.mouseEnabled = false;

		img.box = this.getChildByName('image').originalSize.toRect();

		img.startDrag();

		function onMouseUp(e) {
			img.stopDrag();

			var p = new flash.geom.Point(e.stageX, e.stageY);
			var oo = stage.getObjectsUnderPoint(p);
			var o = oo.pop();

			if(o==null || o.getParentWindow().name!='Stage') {
				img.destroy();
				stage.removeEventListener(flash.events.MouseEvent.MOUSE_UP, onMouseUp);
				return;
			}

			img.swapParent(o);
			img.mouseEnabled = true;
			img.description = this.label.getText();
			img.name = this.label.getText() + o.getChildIndex(img);
			p = img.parent.globalToLocal(p);
			img.x = p.x;
			img.y = p.y;
			stage.removeEventListener(flash.events.MouseEvent.MOUSE_UP, onMouseUp);

			var w = this.getParentWindow().getParentWindow();
			trace(w);
			var xmlWin = w.getChildByName('ScrollPane1').getChildByName('content').getChildByName('Container1').getChildByName('XML');
			var xml = Xml.parse(xmlWin.tf.text).firstElement();

			var frame = xml.elementsNamed('frame').next();

			var place = Xml.createElement('place');
			place.set('id', this.label.getText());
			place.set('name', img.name);
			place.set('x', img.x);
			place.set('y', img.y);
			place.set('depth', o.getChildIndex(img));

			trace(StringTools.htmlEscape(place));

			frame.addChild(Xml.createPCData('\t\t'));
			frame.addChild(place);
			frame.addChild(Xml.createPCData('\n'));

			xmlWin.tf.text = Std.string(xml);
			xmlWin.highlight();

		}
		stage.addEventListener(flash.events.MouseEvent.MOUSE_UP, onMouseUp, false, 0, true);
		");


		// minSize.height = Std.int(Math.max(minSize.height, 90 + 20*i));
		list1.toFront();
	}
	//}}}


	//{{{ __init__
	static function __init__() {
		haxegui.Haxegui.register(Library);
	}
	//}}}
	//}}}
}
