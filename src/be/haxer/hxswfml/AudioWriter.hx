package be.haxer.hxswfml;

import format.swf.Data;
import format.swf.Writer;
import format.mp3.Data;
import format.mp3.Reader;

import format.mpeg.audio.MpegAudioReader;

import haxe.io.Bytes;
import haxe.io.BytesInput;
import haxe.io.BytesOutput;

/**
 * ...
 * @author Jan J. Flanders
 */

class AudioWriter
{
	private var soundData:Sound;
	public function new()
	{
	}
	public function write(bytes, ?currentTag=null)
	{
		var mp3Reader = new format.mp3.Reader(bytes);

		var mp3 = mp3Reader.read();
		var mp3Frames : Array<MP3Frame> = mp3.frames;
		var mp3Header : MP3Header = mp3Frames[0].header;
		
		var output = new BytesOutput();
		var mp3Writer = new format.mp3.Writer(output);
		mp3Writer.write(mp3, false);
		var samplingRate = 
		switch(mp3Header.samplingRate) 
		{
			case SR_11025 : SR11k;
			case SR_22050 : SR22k;
			case SR_44100 : SR44k;
			default: null; 
		}
		if(samplingRate == null)
			throw 'ERROR: Unsupported MP3 SoundRate ' + mp3Header.samplingRate + '. TAG: ' + currentTag.toString();
		soundData= 
		{
			sid : 1,
			format : SFMP3,
			rate : samplingRate,
			is16bit : true,
			isStereo : 
			switch(mp3Header.channelMode) 
			{
				case Stereo : true;
				case JointStereo : true;
				case DualChannel : true;
				case Mono : false;
			},
			samples : mp3.sampleCount,
			data : SDMp3(0, output.getBytes())
		};
	}
	public function writeGapless(input, ?currentTag=null)
	{
			var reader = new format.mpeg.audio.MpegAudioReader(input);

			var output = new haxe.io.BytesOutput();
			var totalLengthSamples = 0;
			var samplingFrequency = -1;
			var isStereo:Null<Bool> = null;
			var encoderDelay = 0;
			var endPadding = 0;
			var decoderDelay = 529; // This is a constant delay caused by the Fraunhofer MP3 Decoder used in Flash Player.

			while (true) 
			{
				switch (reader.readNext()) 
				{
					case Frame(frame):
						if (frame.header.layer != format.mpeg.audio.Layer.Layer3) 
						{
							throw "Only Layer-III MP3 files are supported by Flash. File in " + currentTag.toString() + " is: " + frame.header.layer + ".";
						}
						var frameSamplingFrequency = frame.header.samplingFrequency;
						if (samplingFrequency == -1) 
						{
							samplingFrequency = frameSamplingFrequency;
						} 
						else if (frameSamplingFrequency != samplingFrequency) 
						{
							throw "File in " + currentTag.toString() + " has a variable sampling frequency, which is not supported by Flash.";
						}
						var frameIsStereo = frame.header.mode != format.mpeg.audio.Mode.SingleChannel;
						if (isStereo == null) 
						{
							isStereo = frameIsStereo;
						} 
						else if (frameIsStereo != isStereo) 
						{
							throw "File in " + currentTag.toString() + " contains mixed mono and stereo frames, which is not supported by Flash.";
						}
						output.write(frame.frameData);
						totalLengthSamples += format.mpeg.audio.Utils.lookupSamplesPerFrame(frame.header.version,frame.header.layer);

					case GaplessInfo(giEncoderDelay, giEndPadding):
						encoderDelay = giEncoderDelay;
						endPadding = giEndPadding;

					case Info(info): // ignore
					case Unknown(bytes): // ignore
					case End: break;
				}
			}

			if (totalLengthSamples == 0) 
			{
				throw "File in " + currentTag.toString() + " does not contain any valid MP3 audio data!";
			}

			var flashSamplingFrequency = switch (samplingFrequency) 
			{
				case 11025: SR11k;
				case 22050: SR22k;
				case 44100: SR44k;

				default: throw "Only 11025, 22050 and 44100kHz MP3 files are supported by Flash. " + "File in " + currentTag.toString() + " is: " + samplingFrequency + "kHz.";
			}

			soundData = 
			{
				sid: 1,
				format: SFMP3,
				rate: flashSamplingFrequency,
				is16bit: true,
				isStereo: isStereo,
				samples: totalLengthSamples - endPadding - encoderDelay,
				data: SDMp3(encoderDelay + decoderDelay, output.getBytes())
			};
	}
	public function getTag(?id:Int=1):SWFTag
	{
		soundData.sid=id;
		return TSound(soundData);
	}
	public function getSWF(?id:Int=1):Bytes
	{
		var swfFile = 
		{
			header: {version:10, compressed:true, width:800, height:600, fps:30, nframes:1},
			tags: 
			[
				getTag(id),
				TStartSound(id, {syncStop:false, hasLoops:false, loopCount:null}),
				TShowFrame
			]
		}
		var swfOutput:haxe.io.BytesOutput = new haxe.io.BytesOutput();
		var writer = new Writer(swfOutput);
		writer.write(swfFile);
		return swfOutput.getBytes();
	}
}