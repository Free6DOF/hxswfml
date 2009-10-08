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
//{{{ Flash9
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
//}}}
//{{{ haxe
import haxe.Timer;
import haxe.remoting.HttpAsyncConnection;
//}}}
//{{{ haxegui
import haxegui.Appearance;
import haxegui.Automator;
import haxegui.Binding;
import haxegui.ColorPicker2;
import haxegui.ColorPicker;
import haxegui.Console;
import haxegui.DataSource;
import haxegui.FileDialog;
import haxegui.FindDialog;
import haxegui.Haxegui;
import haxegui.Introspector;
import haxegui.Profiler;
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
import haxegui.controls.Tree;
import haxegui.controls.UiList;
import haxegui.events.FileEvent;
import haxegui.events.MenuEvent;
import haxegui.events.ResizeEvent;
import haxegui.events.TreeEvent;
import haxegui.events.WindowEvent;
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
//}}}
//{{{ Frontend
import XmlEditor;
import Library;
import Actions;
import Options;
//}}}
//}}}


using haxegui.controls.Component;
using haxegui.utils.Color;


/**
* Haxegui Demo Application
*
*
* @author Omer Goshen <gershon@goosemoose.com>
* @author Russell Weir <damonsbane@gmail.com>
* @version 0.26
*/
class Main extends Sprite
{

	//{{{ members
	static var load:Xml;
	static var desktop:Sprite;
	static var root	: MovieClip = flash.Lib.current;
	static var stage	: Stage = root.stage;

	public static var cnx : HttpAsyncConnection;

	public static var filename 		 : String = "Untitled_1";
	public static var output	 	 : String = "assets.swf";

	public static var window		 : Window;
	public static var editor		 : XmlEditor;
	public static var preview 		 : Window;
	public static var library		 : Library;
	public static var timeline		 : Container;
	public static var stageWin		 : Window;

	public static var throbber		 : MovieClip;

	public static var modeCombo  	 : ComboBox;
	public static var filedialog	 : FileDialog;

	public static var canvas  		 : haxegui.toys.Rectangle;
	public static var swf			 : flash.display.AVM1Movie;
	public static var source  	 	 : TextField;
	public static var xml	 		 : Xml;

	public static var currentFrame 	 : Int;
	public static var totalFrames  	 : Int;

	public static var modes 		 : Xml;
	public static var directoryCache : Dynamic ;

	// public static var SERVER_URL : String = "http://localhost:2000/server.n";
	public static var SERVER_URL : String = Haxegui.loader.node.server.att.address + ":" + Haxegui.loader.node.server.att.port + "/" + Haxegui.loader.node.server.att.file;
	//}}}


	//{{{ main
	public static function main () {

		// Set stage propeties
		stage.scaleMode = flash.display.StageScaleMode.NO_SCALE;
		stage.align = flash.display.StageAlign.TOP_LEFT;
		stage.stageFocusRect = true;
		//stage.frameRate = 120;

		// Assign a stage resize listener
		stage.addEventListener (Event.RESIZE, onStageResize, false, 0, true);


		// Logos
		/*
		var logo = cast flash.Lib.current.addChild(flash.Lib.attach("Logo"));
		logo.name = "Logo";
		logo.x = cast (stage.stageWidth - logo.width) >> 1;
		logo.y = cast (stage.stageHeight - logo.height) >> 1;
		logo.mouseEnabled = false;
		*/

		//Reflect.setField(root, "SERVER_URL", SERVER_URL);
		cnx = haxe.remoting.HttpAsyncConnection.urlConnect (SERVER_URL);
		cnx.setErrorHandler (function (err) trace ("Error : " + Std.string (err)));

		Actions.cnx = cnx;
		Reflect.setField (root, "cnx", cnx);
		Reflect.setField (root, "readDirectory", Actions.readDirectory);
		Reflect.setField (root, "getFullPath", Actions.getFullPath);

		// init
		init();
	}
	//}}}


	//{{{ makeDekstop
	/**
	* Draws a vertical gradient across the stage.
	*/
	public static function makeDekstop () {
		desktop = untyped flash.Lib.current.addChild (new Sprite ());
		desktop.name = "desktop";
		desktop.mouseEnabled = false;

		var matrix = new flash.geom.Matrix ();
		matrix.createGradientBox (stage.stageWidth, stage.stageHeight, .5*Math.PI, 0, 0);

		desktop.graphics.beginGradientFill (flash.display.GradientType.LINEAR, [DefaultStyle.BACKGROUND, Color.darken (DefaultStyle.BACKGROUND, 40)], [1,1], [0, 0xFF], matrix);
		desktop.graphics.drawRect (0, 0, stage.stageWidth, stage.stageHeight);
		desktop.graphics.endFill ();
	}
	//}}}


	//{{{ updatePreview
	public static function updatePreview () {
		if (xml != null) {
			var w = Std.parseInt (xml.get ("width"));
			var h = Std.parseInt (xml.get ("height"));
			preview.resize (new Size (w, h));
		}

		var sp = cast preview.getChildByName ("ScrollPane1");
		var content = sp.content;

		clearPreview ();

		var background = new flash.display.Sprite ();
		background.name = "background";

		var matrix = new flash.geom.Matrix ();
		var bmpd = new BitmapData (20, 20);
		var rect1 = new Rectangle (0, 0, 10, 10);
		var rect2 = new Rectangle (0, 10, 10, 20);
		var rect3 = new Rectangle (10, 0, 20, 10);
		var rect4 = new Rectangle (10, 10, 20, 20);
		bmpd.fillRect (rect1, 0xFFBFBFBF);
		bmpd.fillRect (rect2, 0xFFDDDDDD);
		bmpd.fillRect (rect3, 0xFFDDDDDD);
		bmpd.fillRect (rect4, 0xFFBFBFBF);

		background.graphics.beginBitmapFill (bmpd, matrix, true, true);
		background.graphics.drawRect (0, 0, stage.stageWidth, stage.stageHeight);
		background.graphics.endFill ();
		//sp.content.addChild (background);
		preview.addChild(background);
		var onResize=function(e:ResizeEvent) {
			var b = preview.box.clone();
			background.scrollRect = new flash.geom.Rectangle(0,0,b.width-10,b.height-60);
		}
		background.x = 10;
		background.y = 60;
		sp.toFront();

		preview.addEventListener(ResizeEvent.RESIZE, onResize);
		var sprite = new flash.display.Sprite ();
		var bgColor = Color.WHITE;
		if(xml!=null) {
			var fast = new haxe.xml.Fast(xml.firstElement());
			// bgColor = Std.parseInt("0x"+xml.firstElement().elementsNamed("background").next().get("color"));
			bgColor = Std.parseInt("0x"+fast.att.color.substr(1));
		}

		sprite.graphics.beginFill (bgColor);
		sprite.graphics.drawRect (0, 0, preview.box.width, preview.box.height);
		sprite.graphics.endFill ();
		sp.content.addChild (sprite);

		if(output!=null && output!="")
		try {
			var loader = new Loader ();
			loader.load (new URLRequest (output));

			var onComplete = function (e) {
				swf = sp.addChild (e.currentTarget.content);
				//var swf = flash.Lib.as(e.currentTarget.content, flash.display.MovieClip);
				//swf.gotoAndStop(1);
				//sp.addChild(swf);
				//trace(swf.bytesTotal+" "+swf.totalFrames);
			}
			loader.contentLoaderInfo.addEventListener (flash.events.Event.COMPLETE, onComplete, false, 0, true);
		}
		catch(e:Dynamic) {
			trace(e);
		}
	}
	//}}}


	//{{{ setRedirection
	/**
	* Redirect tracing to console
	*/
	public static function setRedirection (f:Dynamic) {
		haxe.Log.trace = f;
		ScriptManager.redirectTraces (f);
	}
	//}}}


	//{{{ loadLayoutXml
	/**
	* Loads the layout
	*/
	static function loadLayoutXml (e:Event) : Void {
		trace (here.methodName);
		var str = e.target.data;
		LayoutManager.loadLayouts (Xml.parse (str));

		for (k in LayoutManager.layouts.keys ())
		trace ("Loaded layout : " + k);

		LayoutManager.setLayout (Xml.parse (str).firstElement ().get ("name"));

		trace ("Finished Initialization in " + haxe.Timer.stamp () + " sec.");




		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		window = cast root.getChildByName ("hXswfML FrontEnd");
		updateTitle();


		//{{{ StatusBar
		window.statusbar = new haxegui.windowClasses.StatusBar (cast window, 10);
		window.statusbar.init ();
		var label = new Label (window.statusbar, 4, 4);
		label.init ({ text: "Mem: " +  Std.string (flash.system.System.totalMemory / Math.pow (10, 6)).substr (0, 5)});

		var t = new haxe.Timer (100);
		var updateMem = function () label.setText ("Mem: " + Std.string (flash.system.System.totalMemory / Math.pow (10, 6)).substr (0, 5));
		t.run = updateMem;
		//}}}


		var o = cast window.getChildByName ("ScrollPane1");
		o = cast o.firstChild ().getChildByName ("Container1");

		library = cast o.getChildByName ("Library");

		editor = cast o.getChildByName ("XML");
		source = editor.tf;


		var onReadPluginsDirectory = function(v:Array<String>) {
			// trace(Std.string(v));
			editor.plugins = [];
			for(p in v) {
				//var plug = new EditorPlugin();
				var className = p.split(".").shift();
				var plug : IEditorPlugin = Type.createInstance(Type.resolveClass(className), [Haxegui.baseURL+"plugins/"+p]);
				plug.url = Haxegui.baseURL+"plugins/"+p;
				editor.plugins.push(plug);
			}
			editor.loadPlugins();
		}
		Actions.readDirectoryFiltered ("plugins", "^.+\\.(swf)$", onReadPluginsDirectory);

		preview = cast o.getChildByName ("Preview");

		stageWin = cast o.getChildByName ("Stage");
		canvas = untyped stageWin.getChildByName ("ScrollPane1").getChildByName ("content").getChildByName ("Container1").firstChild ();
		canvas.description = null;


		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// Toolbar
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		o = cast window.getChildByName ("Toolbar");

		// throbber
		throbber = o.getChildByName("Throbber").firstChild();

		// hbox
		o = cast o.firstChild ().nextSibling ();

		modeCombo = cast o.getChildByName ("Mode");

		loadModes();
		Reflect.setField(root, "loadModes", loadModes);


		Reflect.setField(root, "options", function() new Options().init());
		Reflect.setField(root, "toggleLibraryVisible", toggleLibraryVisible);
		Reflect.setField(root, "togglePreviewVisible", togglePreviewVisible);
		Reflect.setField(root, "toggleSourceVisible", toggleSourceVisible);
		Reflect.setField(root, "toggleStageVisible", toggleStageVisible);


		//{{{ Run
		var btn = o.getChildByName ("Run");
		var doCall = function (e) {
			cnx.Server.run.call ([filename, output], function(v) haxe.Log.trace(v, here));
			updatePreview ();
		}
		btn.addEventListener (MouseEvent.CLICK, doCall);
		//}}}


		//{{{ Find
		var btn = o.getChildByName ("Find");
		var openFindDialog = function (e) {
			var fd = new FindDialog();
			fd.init();
		}
		btn.addEventListener (MouseEvent.CLICK, openFindDialog);
		//}}}


		//{{{ New
		var btn = o.getChildByName ("New");
		var doNew = function (?e) {
			throbber.visible = true;
			throbber.play();

			var d = new haxegui.Dialog ();
			d.init ();
			d.label.setText("Discard the current file?");
			d.dispatchEvent(new ResizeEvent(ResizeEvent.RESIZE));

			window.updateSaturationTween(new feffects.Tween(0, 1, 500, feffects.easing.Linear.easeNone));

			var clearAll = function(e:MouseEvent) {
				d.destroy();
				window.updateSaturationTween(new feffects.Tween(1, 0, 500, feffects.easing.Linear.easeNone));
				filename = "Untitled_1";
				updateTitle();
				clearStage ();
				clearPreview ();
				library.clear ();
				editor.clear();
				throbber.stop();
				throbber.visible = false;
			}
			var c = untyped d.getChildByName("Container").getChildAt(0).getChildAt(1);
			var ok : Button = cast c.getChildAt(0);
			ok.addEventListener(MouseEvent.CLICK, clearAll, false, 0, true);

			var cancel : Button = cast c.getChildAt(1);
			cancel.addEventListener(MouseEvent.CLICK, function(e) {
				d.destroy();
				window.updateSaturationTween(new feffects.Tween(1, 0, 500, feffects.easing.Linear.easeNone));
				throbber.stop();
				throbber.visible = false;
			}, false, 0, true);
		}
		btn.addEventListener (MouseEvent.CLICK, doNew);
		Reflect.setField(root, "new", doNew);
		//}}}


		//{{{ Save
		var btn = o.getChildByName ("Save");
		var doSave = function (e) {
			cnx.Server.save.call ([filename, source.text], function(v) haxe.Log.trace(v, here));

			var label = new Label (window.statusbar, 60, 4);
			label.init ({text: "Saving file '" + filename + "'."});
			haxe.Timer.delay (label.destroy, 2000);

			updatePreview ();
		}
		btn.addEventListener (MouseEvent.CLICK, doSave);
		Reflect.setField(root, "save", doSave);
		//}}}


		//{{{ Load
		btn = o.getChildByName ("Load");
		var doLoad = function (?e) {
			var dt = haxe.Timer.stamp();

			throbber.visible = true;
			throbber.play();

			window.updateSaturationTween(new feffects.Tween(0, 1, 500, feffects.easing.Linear.easeNone));


			filedialog = new haxegui.FileDialog ();
			filedialog.addEventListener(WindowEvent.CLOSE, function(e) {
				throbber.visible=false;
				window.updateSaturationTween(new feffects.Tween(1, 0, 500, feffects.easing.Linear.easeNone));
			}, false, 0, true);

			var onPath = function (p:String) {
				filedialog.init ({path:p});
				filedialog.filter = "^.+\\.(xml)$";
				filedialog.pathCombo.addEventListener(Event.CHANGE,
				function(e) {
					var dir = null;

					if(Std.is(e.target, flash.text.TextField))
					dir = e.target.text;
					else
					e.target.input.getText();

					var onDirCheck = function(b:Bool) {
						if(!b) return;
						// Actions.readDirectoryFiltered (dir, "^(.+[^~])$", onReadDirectory);
						Actions.readDirectoryFiltered (".", "^.+\\.(xml)$", onReadDirectory);
					}
					cnx.Server.directoryExists.call([dir], onDirCheck);
				});

				// handle filter changes
				filedialog.filterCombo.addEventListener(Event.CHANGE, function(e) Actions.readDirectoryFiltered (".", filedialog.filterCombo.input.getText(), onReadDirectory));

				// read directory (xml filter)
				Actions.readDirectoryFiltered (".", "^.+\\.(xml)$", onReadDirectory);
				// var readDir = function(s) {
					// Actions.readDirectoryFiltered (s, "^.+\\.(xml)$", onReadDirectory);
				// }
				// cnx.Server.getWebCwd.call ([], readDir);
				//Actions.readDirectoryFiltered (d, "^.+\\.(xml)$", onReadDirectory);

				var path = "Container1.VDivider.ScrollPane1.content";

				var c:DisplayObjectContainer = cast filedialog;
				for (p in path.split (".")) {
					c = cast c.getChildByName (p);
					// trace (c);
				}

				var tree:Tree = cast c.getChildAt (0);
				//{{{ onDirectoryTree
				var onDirectoryTree = function (o:Dynamic) {
					directoryCache = o;
					tree.process (o, tree.rootNode);

					tree.rootNode.expander.expanded = true;
					tree.rootNode.expand();
					for(i in tree.rootNode.expander)
					i.visible = true;


					for(i in tree.rootNode.expander) {
						if(Std.is(i, TreeNode)) {
							i.addEventListener(TreeEvent.ITEM_OPENING, onTreeItemExpanded);
						}
					}

					//tree.expandFull();
					trace("Loading took: "+(haxe.Timer.stamp()-dt));
				}
				//}}}
				if(directoryCache==null)
				// Actions.getDirectoryTree (".", onDirectoryTree)
				Actions.getDirectoryTree (p, onDirectoryTree)
				else {
					tree.process (directoryCache, tree.rootNode);
					tree.rootNode.expander.expanded = true;
					tree.rootNode.expand();
					for(i in tree.rootNode.expander)
					i.visible = true;
				}

			}

			Actions.getFullPath (".", onPath);
			// Actions.getWebCwd(onPath);

			//{{{ onFileSelected
			var onFileSelected = function(e:Event) {
				//filename = e.target.fileInput.getText();
				filename = e.target.pathCombo.input.getText() + "/" + e.target.fileInput.getText();

				var ext = filename.split(".").pop();

				if(e.target.fileInput.getText().toLowerCase()=="makefile") ext = "makefile";

				var mode = modes.elementsNamed(ext).next();
				for(mode in modes.elements())
				if(mode.get("ext")==ext) {
					modeCombo.input.setText(mode.get("name"));

					// var onPath = function(s) {
					// Actions.load(s+mode.get("file"), function(x:String) {
					Actions.load(mode.get("file"), function(x:String) {
						editor.mode = Xml.parse(x).firstElement();
						trace("Loaded mode for "+ext);
					});
					// }
					// Actions.getWebCwd(onPath);
				}

				throbber.stop();
				throbber.visible = false;
				window.updateSaturationTween(new feffects.Tween(1, 0, 500, feffects.easing.Linear.easeNone));
				updateTitle();
				e.target.destroy();
				library.clear ();
				clearStage ();
				//		  Actions.load("filename", getFileContents);
				cnx.Server.load.call ([filename], getFileContents);

			}
			//}}}
			//filedialog.addEventListener(Event.CHANGE, onFileSelected);
			filedialog.addEventListener(FileEvent.SELECT, onFileSelected);

			//updatePreview();

			// o.getChildByName ("Find").__setDisabled (false);
			o.getChildByName ("Run").__setDisabled (false);
			o.getChildByName ("Mode").__setDisabled (false);
			o.getChildByName ("Find").__setDisabled (false);
			o.getChildByName ("Find").__setDisabled (false);
			o.getChildByName ("FindReplace").__setDisabled (false);
		}
		btn.addEventListener (MouseEvent.CLICK, doLoad);
		Reflect.setField (root, "load", doLoad);
		//}}}

		//{{{ Import
		var doImport = function (?e) {
			var dt = haxe.Timer.stamp();

			throbber.visible = true;
			throbber.play();

			window.updateSaturationTween(new feffects.Tween(0, 1, 500, feffects.easing.Linear.easeNone));


			filedialog = new haxegui.FileDialog ();
			filedialog.addEventListener(WindowEvent.CLOSE, function(e) {
				throbber.visible=false;
				window.updateSaturationTween(new feffects.Tween(1, 0, 500, feffects.easing.Linear.easeNone));
			}, false, 0, true);

			var filter = "^.+\\.(jpg|png|swf|ttf)$";

			var onPath = function(p:String) {
				filedialog.init ({path:p});
				filedialog.filterCombo.input.setText(filter);
				filedialog.pathCombo.addEventListener(Event.CHANGE,
				function(e) {
					var dir = null;

					if(Std.is(e.target, flash.text.TextField))
					dir = e.target.text;
					else
					e.target.input.getText();

					var onDirCheck = function(b:Bool) {
						if(!b) return;
						Actions.readDirectoryFiltered (".", filter, onReadDirectory);
					}
					cnx.Server.directoryExists.call([dir], onDirCheck);
				});

				// handle filter changes
				filedialog.filterCombo.addEventListener(Event.CHANGE, function(e) Actions.readDirectoryFiltered (".", filedialog.filterCombo.input.getText(), onReadDirectory));

				// read directory
				Actions.readDirectoryFiltered (".", filter, onReadDirectory);

			}
			Actions.getFullPath(".", onPath);
			// Actions.getWebCwd(onPath);

		}
		Reflect.setField (root, "import", doImport);
		//}}}

		//{{{ getCwd
		var getCwd = function (){
			cnx.Server.getCwd.call ([], function(v) haxe.Log.trace(v, here));
		}
		Reflect.setField (root, "getCwd", getCwd);
		//}}}


		//{{{ getExePath
		var getExePath = function () {
			cnx.Server.getExePath.call ([], function(v) haxe.Log.trace(v, here));
		}
		Reflect.setField (root, "getExePath", getExePath);
		//}}}


		//{{{ getWebCwd
		var getWebCwd = function() {
			//return neko.Web.getCwd();
			cnx.Server.getWebCwd.call ([], function(v) haxe.Log.trace(v, here));
		}
		Reflect.setField (root, "getWebCwd", getWebCwd);
		//}}}


		//{{{ dump
		var dump = function (){
			cnx.Server.dump.call ([output], function(v) haxe.Log.trace(v, here));
		}
		Reflect.setField (root, "dump", dump);
		//}}}


		//{{{ make
		var make = function (){
			cnx.Server.make.call ([], function(v) haxe.Log.trace(v, here));
		}
		Reflect.setField (root, "make", make);
		//}}}


		//{{{ indent
		var indent = function (){
			//                      cnx.Server.xsltproc.call([["indent.xsl", "'"+StringTools.htmlEscape(source.text)+"'"]], getIndented);
			//                      cnx.Server.xsltproc.call([["indent.xsl", "'"+source.text+"'"]], getIndented);
			cnx.Server.xsltproc.call ([["--nonet", "indent.xsl", filename]],
			getIndented);
		}
		Reflect.setField (root, "indent", indent);
		//}}}



		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// Timeline
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		timeline = cast window.getChildByName ("timeline");
		var onTimeLineResize = function(e:ResizeEvent) {
			timeline.scrollRect = timeline.box;
		}
		timeline.addEventListener(ResizeEvent.RESIZE, onTimeLineResize);
		//timeline.filters = [new flash.filters.DropShadowFilter (4,45,DefaultStyle.DROPSHADOW,.5,4,4,.5,flash.filters.BitmapFilterQuality.HIGH,false,false,false)];


		for (j in 0...Std.int (timeline.box.width / 10)) {
			var b = new haxegui.controls.Component (timeline, "frame" + j, 10 * j, 20);
			b.init ({width: 10, height:20});
			b.setAction ("redraw",
			"
			this.graphics.clear();
			this.graphics.lineStyle(1, Color.tint(Color.BLACK, .5), 1, flash.display.LineScaleMode.NONE);
			this.graphics.beginFill(" + ((j % 4 == 0) ? Color.tint (Color.BLACK, .15) : Color.tint (Color.BLACK, .05)) + ");
			this.graphics.drawRect(0,0,10,20);
			this.graphics.endFill();
			");
		}



		var c = new haxegui.containers.Container (timeline);
		c.init ({ height: 20, color:Color.tint (window.color, .7)});
		c.filters = [new flash.filters.DropShadowFilter (4, 45, DefaultStyle.DROPSHADOW, .5, 4, 4, .5, flash.filters.BitmapFilterQuality.HIGH, false, false, false)];
		c.setAction ("redraw",
		"
		this.graphics.clear();
		var colors = [ Color.darken(this.color, 20), Color.tint(this.color, .8) ];
		var alphas = [ 1, 1 ];
		var ratios = [ 0, 0xFF ];
		var matrix = new flash.geom.Matrix();
		matrix.createGradientBox(this.box.width, 20, .5*Math.PI, 0, 0);

		this.graphics.beginGradientFill( flash.display.GradientType.LINEAR, colors, alphas, ratios, matrix );
		this.graphics.drawRect (0, 0, this.box.width, 20);
		this.graphics.endFill();
		");

		for (i in 0...20)
		new haxegui.controls.Label (c, 40 * i, 4).init ({text: 5*i});

		var bar = new haxegui.controls.ToolBar (timeline, "toolbar", 0, 40);
		bar.init({ width: 400, height: 20, color:Color.tint (window.color,.9)});
		//(cast timeline.getChildByName("Toolbar")).toFront();

		var m = new haxegui.controls.AbstractButton (timeline);
		m.init ();

		m.setAction ("redraw",
		"
		this.graphics.clear();
		this.graphics.lineStyle(1, Color.tint(Color.RED, 1), 1, flash.display.LineScaleMode.NONE);
		this.graphics.beginFill(Color.RED, .5);
		this.graphics.drawRect(0,0,10,20);
		this.graphics.endFill();
		this.graphics.moveTo(5,20);
		this.graphics.lineTo(5,40);
		");
		m.setAction ("mouseDown", "this.startDrag(false, new flash.geom.Rectangle(-stage.stageWidth,0,2*stage.stageWidth,0));");
		m.setAction ("mouseUp", "this.stopDrag();");

		//cnx.Server.load.call([filename], getFileContents);
		updatePreview ();

		window.dispatchEvent(new ResizeEvent(ResizeEvent.RESIZE));
	}
	//}}}

	public static function getIndented (x:String)  {
		xml = Xml.parse (x).firstElement ();

		var r = ~/^() + /gm;
		x = r.replace (x, "\t\t");

		source.text = x;

		editor.highlight ();
	}


	//{{{ init
	public static function init () {
		// Setup Haxegui
		haxegui.Haxegui.init ();
		DefaultStyle.BACKGROUND = Color.BLACK.tint (.5);

		// Desktop
		makeDekstop ();

		var bootupMessages = new Array < { v: Dynamic, inf:haxe.PosInfos } >();
		var bootupHandler = function (v:Dynamic, ? inf : haxe.PosInfos) {
			bootupMessages.push ({v: v, inf:inf});
		}
		setRedirection (bootupHandler);


		// Console to show some debug
		var console = new Console (flash.Lib.current, 50, 50);
		console.init ({ color: 0x2E2E2E, visible:true});
		haxe.Log.clear ();
		setRedirection (console.log);

		var log = function (v:Dynamic) console.log (v, null);

		log ("*** Bootup messages:");
		for (e in bootupMessages)
		console.log (e.v, e.inf);

		stage.addEventListener (KeyboardEvent.KEY_DOWN,
		function (e) {
			switch (e.charCode) {
				case "`".code:
				console.visible = !console.visible;
			}
		});


		/////////////////////////////////////////////////////////////////////////
		// Load XML
		/////////////////////////////////////////////////////////////////////////
		var loader:URLLoader = new URLLoader ();
		loader.addEventListener (Event.COMPLETE, loadLayoutXml, false, 0, true);

		Haxegui.baseURL = Haxegui.loader.node.domain.att.baseurl;
		var layout = Haxegui.loader.node.layout.att.url;
		loader.load (new URLRequest (Haxegui.baseURL + layout));
	}
	//}}}


	//{{{ onStageResize
	/**
	*
	*/
	public static function onStageResize (e:Event) {
		if (desktop == null) return;
		if(root.numChildren==1) return;

		var mazk = new flash.display.Shape();
		mazk.graphics.beginFill(Color.MAGENTA,0);
		mazk.graphics.drawRect (0, 0, stage.stageWidth, stage.stageHeight);
		mazk.graphics.endFill ();
		root.mask = mazk;

		Profiler.begin(here.className+"."+here.methodName);

		var stage = e.target;

		var matrix = new flash.geom.Matrix ();
		matrix.createGradientBox (stage.stageWidth, stage.stageHeight, .5 * Math.PI, 0, 0);

		desktop.graphics.clear ();
		desktop.graphics.beginGradientFill (flash.display.GradientType.LINEAR, [DefaultStyle.BACKGROUND, Color.darken (DefaultStyle.BACKGROUND, 40)], [1,1],[0,0xFF], matrix);
		desktop.graphics.drawRect (0, 0, stage.stageWidth, stage.stageHeight);
		desktop.graphics.endFill ();

		Profiler.end();
	}
	//}}}


	//{{{ getFileContents
	/**
	*
	*
	*/
	public static function getFileContents (x:String) {

		source.text = x;
		editor.highlight ();
		editor.dispatchEvent(new ResizeEvent(ResizeEvent.RESIZE));

		try {
			xml = Xml.parse (x).firstElement ();


			var w = Std.parseInt (xml.get ("width"));
			var h = Std.parseInt (xml.get ("height"));

			canvas.resize (new Size (w, h));

			var totalFrames = 0;

			for (frame in xml.elementsNamed ("frame")) {

				var lib = frame.firstElement ();
				for (clip in lib.elementsNamed ("clip"))
				library.addItem (clip);

				library.dispatchEvent( new ResizeEvent(ResizeEvent.RESIZE));

				for (place in frame.elementsNamed ("place"))  {
					//trace(StringTools.htmlEscape(Std.string(place)));
					var id = place.get ("id");
					var clip = null;
					for (c in lib.elementsNamed ("clip"))
					if (c.get ("id") == id)
					clip = c;
					if (clip != null) {
						if(clip.exists("import")) {
							var ext = clip.get("import").split(".").pop();
							switch(ext) {
								case "png", "jpg":
								var image =	new Image (cast canvas,
								place.get ("name") + canvas.numChildren,
								Std.parseFloat (place.get ("x")),
								Std.parseFloat (place.get ("y")));

								image.init ({
									src: clip.get ("import")
								});

								case "svg":
								var note =	new haxegui.toys.Note (cast canvas,
								place.get ("name") + canvas.numChildren,
								Std.parseFloat (place.get ("x")),
								Std.parseFloat (place.get ("y")));

								note.init ({
									width: 140,
									height: 46,
									text: "SVG Place Holder"
								});

								default:

							}
						}
					}
				}

				var f = cast timeline.getChildByName ("frame" + totalFrames);
				f.graphics.lineStyle (0, 0, 0);
				f.graphics.beginFill (Color.BLACK);
				f.graphics.drawCircle (5, 6, 3);
				f.graphics.endFill ();

				totalFrames++;

			}
		}
		catch(e:Dynamic) {
			trace(e);
		}

		trace ("XML Loaded, " + totalFrames + " frame(s).");

		var label = new Label (window.statusbar, 60, 4);
		label.init ( { text:	 "Loaded file '" + filename + "', total " + totalFrames + " frame(s)."} );
		haxe.Timer.delay (label.destroy, 2000);

		editor.updateTree();
		editor.highlight();

		throbber.visible = false;
		throbber.stop();
	}
	//}}}


	//{{{ updateTitle
	public static function updateTitle() {
		window.titlebar.title.setText("hXswfML FrontEnd - " + filename);
	}
	//}}}


	//{{{ loadModes
	public static function loadModes() {
		var o = cast window.getChildByName ("Toolbar");
		o = cast o.firstChild ().nextSibling ();

		var combo : ComboBox = cast o.getChildByName ("Mode");

		var onModesLoaded = function(s:String) {
			modes = Xml.parse(StringTools.htmlUnescape(s)).firstElement();
			var ds = new DataSource();
			ds.data = [];
			for(mode in modes.elements()) {
				ds.data.push(mode.get("name"));
				// 	if(mode.get("name")=="xml") {
				// 		trace("Loading mode: " + mode.get("name") );
				// 		Actions.load(mode.get("file"), function(x:String) editor.mode = Xml.parse(x).firstElement());
				// 	}
			}

			combo.dataSource = ds;
		}

		Actions.load("modes.xml", onModesLoaded);

		// var loadModes = function(s) {
		// Actions.load(s+"modes.xml", onModesLoaded);
		// }
		// cnx.Server.getWebCwd.call ([], loadModes);

	}
	//}}}


	//{{{ onReadDirectory
	public static function onReadDirectory(o:Dynamic) {
		//if(o==null) return;

		var ds1 = new DataSource();
		var ds2 = new DataSource();
		var ds3 = new DataSource();
		var ds4 = new DataSource();
		var ds5 = new DataSource();


		var path = "Container1.VDivider.Container2.Container3.ScrollPane2.content.Grid3";

		var c : DisplayObjectContainer = cast filedialog;
		for (p in path.split ("."))
		c = cast c.getChildByName (p);

		var list1:UiList = cast c.getChildAt (0);
		var list2:UiList = cast c.getChildAt (1);
		var list3:UiList = cast c.getChildAt (2);
		var list4:UiList = cast c.getChildAt (3);
		var list5:UiList = cast c.getChildAt (4);

		list1.removeItems();
		list2.removeItems();
		list3.removeItems();
		list4.removeItems();
		list5.removeItems();

		ds1.data = o;
		list1.dataSource = ds1;

		ds2.data = [];
		ds3.data = [];
		ds4.data = [];
		ds5.data = [];

		for (i in list1.getElementsByClass (ListItem)) {
			i.label.x += 22;
			var icon = new Icon (cast i, "icon", 2, 2);

			var typeIcon = Icon.STOCK_DOCUMENT;
			var ext : String = i.label.getText().split(".").pop();

			// file extension
			switch(ext) {
				case "hx":
				typeIcon = "text-x-source.png";
				// ds2.data.push("haXe Source");
				case "css":
				typeIcon = "gnome-mime-text-css.png";
				// ds2.data.push("Cascading Style Sheet");
				case "html", "xhtml":
				typeIcon = "gnome-mime-application-xml.png";
				// ds2.data.push("HTML Markup");
				case "xml":
				typeIcon = "gnome-mime-application-xml.png";
				// ds2.data.push("XML Markup");
				case "xsl", "xslt":
				typeIcon = "gnome-mime-application-xml.png";
				// ds2.data.push("XSLTL Markup");
				case "swf":
				typeIcon = "gnome-mime-application-x-shockwave-flash.png";
				// ds2.data.push("Flash Binary");
				case "n", "exe":
				typeIcon = "application-x-executable.png";
				// ds2.data.push("Executable Binary");
				case "sh":
				typeIcon = "text-x-script.png";
				// ds2.data.push("Shell Script");
				case "jpg", "png":
				typeIcon = "image-x-generic.png";
				// ds2.data.push("Bitmap Image");
				case "wav", "mp3":
				typeIcon = "audio-x-generic.png";
				// ds2.data.push("Audio File");
				case "ttf":
				typeIcon = "font-x-generic.png";
				// ds2.data.push("TrueType Font");
				default:
				typeIcon = Icon.STOCK_DOCUMENT;
				// ds2.data.push("Unknown File");
			}
			icon.init ({src: typeIcon});
		}


		for(i in cast(ds1.data, Array<Dynamic>)) {
			var ext : String = i.split(".").pop();

			// file extension
			switch(ext) {
				case "hx":
				ds2.data.push("haXe Source");
				case "css":
				ds2.data.push("Cascading Style Sheet");
				case "html", "xhtml":
				ds2.data.push("HTML Markup");
				case "xml":
				ds2.data.push("XML Markup");
				case "xsl", "xslt":
				ds2.data.push("XSLTL Markup");
				case "swf":
				ds2.data.push("Flash Binary");
				case "n", "exe":
				ds2.data.push("Executable Binary");
				case "sh":
				ds2.data.push("Shell Script");
				case "jpg", "png":
				ds2.data.push("Bitmap Image");
				case "wav", "mp3":
				ds2.data.push("Audio File");
				case "ttf":
				ds2.data.push("TrueType Font");
				default:
				ds2.data.push("Unknown File");
			}
		}

		var onStats = function(o:Dynamic) {
			var stats = cast(o, Array<Dynamic>);
			for(s in stats) {

				if(s.size<1024)
				ds3.data.push(s.size + " B");
				else
				ds3.data.push( Std.string(s.size/(2<<10)).substr(0,5) + " KB");

				ds4.data.push(s.ctime);
				ds5.data.push(s.mtime);
			}

			list2.dataSource = ds2;
			list3.dataSource = ds3;
			list4.dataSource = ds4;
			list5.dataSource = ds5;

			list1.redraw();
			list2.redraw();
			list3.redraw();
			list4.redraw();
			list5.redraw();

			filedialog.dispatchEvent(new ResizeEvent(ResizeEvent.RESIZE));
		}
		var data = [];
		for(d in cast(ds1.data, Array<Dynamic>))
		data.push(filedialog.pathCombo.input.getText()+"/"+d);
		Actions.getFileArrayStats(data, onStats);
	}
	//}}}


	//{{{ onTreeItemExpanded
	public static function onTreeItemExpanded(e:TreeEvent) {
		e.target.expander.expanded = false;
		e.target.collapse();
		e.target.removeItems();

		//var bar : haxegui.controls.ProgressBar = cast filedialog.getElementsByClass(haxegui.windowClasses.StatusBar).next().firstChild();
		//bar.progress = 0;

		var o = {};
		Actions.getDirectoryTree (e.target.name, function(o:Dynamic) {
			filedialog.tree.process(o, e.target);

			var onPath = function(s:String) {
				filedialog.pathCombo.input.setText(s);
				trace("Directory changed: "+s);
				filedialog.dispatchEvent(new FileEvent(FileEvent.DIRECTORY_CHANGE));
				Actions.readDirectoryFiltered (s, "^(.+[^~])$", onReadDirectory);
			}
			//Actions.getFullPath (e.target.name, onPath);
			Actions.getFullPath (filedialog.path+"/"+e.target.name, onPath);
			//Actions.getWebCwd(onPath);

			if(e.target.hasEventListener(TreeEvent.ITEM_OPENING))
			e.target.removeEventListener(TreeEvent.ITEM_OPENING, onTreeItemExpanded);

			e.target.expander.expanded = true;
			e.target.expand();
			for(i in 0...e.target.expander.numChildren) {
				var child = e.target.expander.getChildAt(i);
				child.visible = true;
				if(Std.is(child, TreeNode)) {
					child.addEventListener(TreeEvent.ITEM_OPENING, onTreeItemExpanded);
				}
			}


		});

	}
	//}}}

	//{{{ clearStage
	public static function clearStage () {
		if (canvas == null)
		return;
		canvas.removeChildren ();
	}
	//}}}


	//{{{ clearPreview
	public static function clearPreview ()
	{
		var sp = cast preview.getChildByName ("ScrollPane1");
		var o = sp.content;
		for (i in 0...o.numChildren-1)
		o.removeChild (o.getChildAt (i));

	}
	//}}}


	//{{{ toggleLibraryVisible
	public static function toggleLibraryVisible() {
		library.visible = !library.visible;
	}
	//}}}


	//{{{ toggleStageVisible
	public static function toggleStageVisible() {
		stageWin.visible = !stageWin.visible;
	}
	//}}}


	//{{{ toggleSourceVisible
	public static function toggleSourceVisible() {
		editor.visible = !editor.visible;
	}
	//}}}


	//{{{ togglePreviewVisible
	public static function togglePreviewVisible(?e:MouseEvent) {
		preview.visible = !preview.visible;
		var chkbox = e.target.getElementsByClass(CheckBox).next();
		if(chkbox==null) return;
		chkbox.selected = preview.visible;
	}
	//}}}
}
