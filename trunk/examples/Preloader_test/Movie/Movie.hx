package;

import flash.display.Loader;
import flash.display.MovieClip;
import flash.events.Event;
import flash.system.LoaderContext;
import flash.system.ApplicationDomain;
import flash.utils.ByteArray;

import flash.Lib;

class MyImage extends ByteArray{}

class Movie extends MovieClip
{
	var loader:Loader;
	var ctx : LoaderContext;

	public static function main()
	{
		Lib.current.addChild(new Movie());
	}
	public function new()
	{
		super();
		loader=new Loader();
		loader.x=loader.y=100;
		loader.loadBytes(new MyImage());
		addChild(loader);
	}
}