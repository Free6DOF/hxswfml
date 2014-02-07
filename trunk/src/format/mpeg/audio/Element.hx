package format.mpeg.audio;

import format.mpeg.audio.Frame;
import format.mpeg.audio.Info;

import haxe.io.Bytes;

enum Element {
    Frame(frame:Frame);
    Info(info:Info);
    GaplessInfo(encoderDelay:Int, endPadding:Int);
    Unknown(bytes:Bytes);
    End;
}