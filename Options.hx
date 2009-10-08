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

import haxegui.Window;
import haxegui.containers.Container;
import haxegui.controls.TabNavigator;
import haxegui.controls.Image;

class Options extends Window {

	public var container : Container;
	public var tabNav : TabNavigator;

	public override function init(?opt:Dynamic=null) {
		super.init();

		type = WindowType.MODAL;

		this.center();

		container = new Container(this);
		container.init();

		tabNav = new TabNavigator(container);
		tabNav.init({left:0, right:0, top:0, height: 48});

		var tab = new Tab(tabNav);
		tab.init({width:48, height: 48});

		var icon = new Icon(tab);
		icon.init({src:Icon.STOCK_NEW});

		var tab = new Tab(tabNav, 48);
		tab.init({width:48, height: 48});

		var icon = new Icon(tab);
		icon.init({src:Icon.STOCK_OPEN});
	}

}

