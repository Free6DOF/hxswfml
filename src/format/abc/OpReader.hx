/*
 * format - haXe File Formats
 * ABC and SWF support by Nicolas Cannasse
 *
 * Copyright (c) 2008, The haXe Project Contributors
 * All rights reserved.
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *   - Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *   - Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in the
 *     documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE HAXE PROJECT CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE HAXE PROJECT CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
 * OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
 * DAMAGE.
 */
package format.abc;
import format.abc.Data;

class OpReader {

	public var i : haxe.io.Input;

	public function new(i) {
		this.i = i;
	}

	public function readInt() {
		var a = i.readByte(); ++bytePos;
		if( a < 128 )
			return a;
		a &= 0x7F;
		var b = i.readByte(); ++bytePos;
		if( b < 128 )
			return (b << 7) | a;
		b &= 0x7F;
		var c = i.readByte(); ++bytePos;
		if( c < 128 )
			return (c << 14) | (b << 7) | a;
		c &= 0x7F;
		var d = i.readByte(); ++bytePos;
		if( d < 128 )
			return (d << 21) | (c << 14) | (b << 7) | a;
		d &= 0x7F;
		var e = i.readByte(); ++bytePos;
		if( e > 15 ) throw "assert";
		if( ((e & 8) == 0) != ((e & 4) == 0) ) throw haxe.io.Error.Overflow;
		return (e << 28) | (d << 21) | (c << 14) | (b << 7) | a;
	}

	inline function readIndex<T>() : Index<T> {
		return Idx(readInt());
	}

	public function readInt32() : Int  {
		var a = i.readByte(); ++bytePos;
		if( a < 128 )
			return a;
		a &= 0x7F;
		var b = i.readByte(); ++bytePos;
		if( b < 128 )
			return  (b << 7) | a;
		b &= 0x7F;
		var c = i.readByte(); ++bytePos;
		if( c < 128 )
			return  (c << 14) | (b << 7) | a;
		c &= 0x7F;
		var d = i.readByte(); ++bytePos;
		if( d < 128 )
			return (d << 21) | (c << 14) | (b << 7) | a;
		d &= 0x7F;
		var e = i.readByte(); ++bytePos;
		if( e > 15 ) throw "assert";
		var small = (d << 21) | (c << 14) | (b << 7) | a;
		var big = e<<28;
		return big|small;
	}

	inline function reg() {
		++bytePos;
		return i.readByte();
	}

	function jmp(j): format.abc.OpCode
	{
		jumpNameIndex++;
		var offset = i.readInt24();
		++bytePos;
		++bytePos;
		++bytePos;
		if (offset < 0)
		{
			ops.push(OJump(j, offset));//commented in xml
			return OJump2(j, labels[bytePos + offset], offset);
		}
		else
		{
			if (jumps[bytePos + offset] == null)
				jumps[bytePos + offset] = [];
			jumps[bytePos + offset].push('jump' + jumpNameIndex);
			ops.push(OJump(j, offset));//commented in xml
			return OJump2(j, 'jump' + jumpNameIndex, offset);
		}
	}

	public function readOp(op:Int) :format.abc.OpCode
	{
		return switch( op ) {
		case 0x01:
			OBreakPoint;
		case 0x02:
			ONop;
		case 0x03:
			OThrow;
		case 0x04:
			OGetSuper(readIndex());
		case 0x05:
			OSetSuper(readIndex());
		case 0x06:
			ODxNs(readIndex());
		case 0x07:
			ODxNsLate;
		case 0x08:
			ORegKill(reg());
		case 0x09:
			labelNameIndex++;
			labels[(bytePos-1)]= 'label' + labelNameIndex;
			ops.push(OLabel);//commented in xml
			OLabel2('label' + labelNameIndex);
		case 0x0C:
			jmp(JNotLt);
		case 0x0D:
			jmp(JNotLte);
		case 0x0E:
			jmp(JNotGt);
		case 0x0F:
			jmp(JNotGte);
		case 0x10:
			jmp(JAlways);
		case 0x11:
			jmp(JTrue);
		case 0x12:
			jmp(JFalse);
		case 0x13:
			jmp(JEq);
		case 0x14:
			jmp(JNeq);
		case 0x15:
			jmp(JLt);
		case 0x16:
			jmp(JLte);
		case 0x17:
			jmp(JGt);
		case 0x18:
			jmp(JGte);
		case 0x19:
			jmp(JPhysEq);
		case 0x1A:
			jmp(JPhysNeq);
		/*
		case 0x1B:
			bytePos+=3;
			var def = i.readInt24();
			var cases = new Array();
			for ( _ in 0...readInt() + 1 )
			{
				bytePos+=3;
				cases.push(i.readInt24());
			}
			OSwitch(def,cases);
		*/
		case 0x1B:
			var base = bytePos - 1;
			var _def = i.readInt24();
			bytePos += 3;
			var def = "";
			if (_def < 0)
			{
				def = labels[base+_def];
			}
			else
			{
				if (switches[base + _def] == null) switches[base + _def] = [];
				caseNameIndex++;
				def = 'case' + caseNameIndex;
				switches[base + _def].push(def);
			}
				
			var cases = new Array();
			var offsets = [_def];
			var total = readInt() + 1 ;
			for ( _ in 0...total)
			{
				var offset = i.readInt24();
				bytePos += 3;
				offsets.push(offset);
				if (offset < 0)
				{
					cases.push(labels[base+offset]);
				}
				else
				{
					caseNameIndex++;
					if (switches[base + offset] == null)switches[base + offset] = [];
					switches[base + offset].push('case' + caseNameIndex);
					cases.push('case' + caseNameIndex);
				}
			}
			OSwitch2(def,cases,offsets);
		case 0x1C:
			OPushWith;
		case 0x1D:
			OPopScope;
		case 0x1E:
			OForIn;
		case 0x1F:
			OHasNext;
		case 0x20:
			ONull;
		case 0x21:
			OUndefined;
		case 0x23:
			OForEach;
		case 0x24:
			++bytePos;
			OSmallInt(i.readInt8());
		case 0x25:
			OInt(readInt());
		case 0x26:
			OTrue;
		case 0x27:
			OFalse;
		case 0x28:
			ONaN;
		case 0x29:
			OPop;
		case 0x2A:
			ODup;
		case 0x2B:
			OSwap;
		case 0x2C:
			OString(readIndex());
		case 0x2D:
			OIntRef(readIndex());
		case 0x2E:
			OUIntRef(readIndex());
		case 0x2F:
			OFloat(readIndex());
		case 0x30:
			OScope;
		case 0x31:
			ONamespace(readIndex());
		case 0x32:
			var r1 = readInt();
			var r2 = readInt();
			ONext(r1,r2);
		case 0x35:
			OOp(OpMemGet8);
		case 0x36:
			OOp(OpMemGet16);
		case 0x37:
			OOp(OpMemGet32);
		case 0x38:
			OOp(OpMemGetFloat);
		case 0x39:
			OOp(OpMemGetDouble);
		case 0x3A:
			OOp(OpMemSet8);
		case 0x3B:
			OOp(OpMemSet16);
		case 0x3C:
			OOp(OpMemSet32);
		case 0x3D:
			OOp(OpMemSetFloat);
		case 0x3E:
			OOp(OpMemSetDouble);
		case 0x40:
			OFunction(readIndex());
		case 0x41:
			OCallStack(readInt());
		case 0x42:
			OConstruct(readInt());
		case 0x43:
			var s = readInt();
			var n = readInt();
			OCallMethod(s,n);
		case 0x44:
			var m = readIndex();
			var n = readInt();
			OCallStatic(m,n);
		case 0x45:
			var p = readIndex();
			var n = readInt();
			OCallSuper(p,n);
		case 0x46:
			var p = readIndex();
			var n = readInt();
			OCallProperty(p,n);
		case 0x47:
			ORetVoid;
		case 0x48:
			ORet;
		case 0x49:
			OConstructSuper(readInt());
		case 0x4A:
			var p = readIndex();
			var n = readInt();
			OConstructProperty(p,n);
		case 0x4C:
			var p = readIndex();
			var n = readInt();
			OCallPropLex(p,n);
		case 0x4E:
			var p = readIndex();
			var n = readInt();
			OCallSuperVoid(p,n);
		case 0x4F:
			var p = readIndex();
			var n = readInt();
			OCallPropVoid(p,n);
		case 0x50:
			OOp(OpSign1);
		case 0x51:
			OOp(OpSign8);
		case 0x52:
			OOp(OpSign16);
		case 0x53:
			OApplyType(readInt());
		case 0x55:
			OObject(readInt());
		case 0x56:
			OArray(readInt());
		case 0x57:
			ONewBlock;
		case 0x58:
			OClassDef(readIndex());
		case 0x59:
			OGetDescendants(readIndex());
		case 0x5A:
			OCatch(readInt());
		case 0x5D:
			OFindPropStrict(readIndex());
		case 0x5E:
			OFindProp(readIndex());
		case 0x5F:
			OFindDefinition(readIndex());
		case 0x60:
			OGetLex(readIndex());
		case 0x61:
			OSetProp(readIndex());
		case 0x62:
			OReg(reg());
		case 0x63:
			OSetReg(reg());
		case 0x64:
			OGetGlobalScope;
		case 0x65:
			++bytePos;
			OGetScope(i.readByte());
		case 0x66:
			OGetProp(readIndex());
		case 0x68:
			OInitProp(readIndex());
		case 0x6A:
			ODeleteProp(readIndex());
		case 0x6C:
			OGetSlot(readInt());
		case 0x6D:
			OSetSlot(readInt());
		case 0x6E:
			OGetGlobalSlot(readInt());
		case 0x6F:
			OSetGlobalSlot(readInt());
		case 0x70:
			OToString;
		case 0x71:
			OToXml;
		case 0x72:
			OToXmlAttr;
		case 0x73:
			OToInt;
		case 0x74:
			OToUInt;
		case 0x75:
			OToNumber;
		case 0x76:
			OToBool;
		case 0x77:
			OToObject;
		case 0x78:
			OCheckIsXml;
		case 0x80:
			OCast(readIndex());
		case 0x82:
			OAsAny;
		case 0x85:
			OAsString;
		case 0x86:
			OAsType(readIndex());
		case 0x87:
			OOp(OpAs);
		case 0x89:
			OAsObject;
		case 0x90:
			OOp(OpNeg);
		case 0x91:
			OOp(OpIncr);
		case 0x92:
			OIncrReg(reg());
		case 0x93:
			OOp(OpDecr);
		case 0x94:
			ODecrReg(reg());
		case 0x95:
			OTypeof;
		case 0x96:
			OOp(OpNot);
		case 0x97:
			OOp(OpBitNot);
		case 0xA0:
			OOp(OpAdd);
		case 0xA1:
			OOp(OpSub);
		case 0xA2:
			OOp(OpMul);
		case 0xA3:
			OOp(OpDiv);
		case 0xA4:
			OOp(OpMod);
		case 0xA5:
			OOp(OpShl);
		case 0xA6:
			OOp(OpShr);
		case 0xA7:
			OOp(OpUShr);
		case 0xA8:
			OOp(OpAnd);
		case 0xA9:
			OOp(OpOr);
		case 0xAA:
			OOp(OpXor);
		case 0xAB:
			OOp(OpEq);
		case 0xAC:
			OOp(OpPhysEq);
		case 0xAD:
			OOp(OpLt);
		case 0xAE:
			OOp(OpLte);
		case 0xAF:
			OOp(OpGt);
		case 0xB0:
			OOp(OpGte);
		case 0xB1:
			OInstanceOf;
		case 0xB2:
			OIsType(readIndex());
		case 0xB3:
			OOp(OpIs);
		case 0xB4:
			OOp(OpIn);
		case 0xC0:
			OOp(OpIIncr);
		case 0xC1:
			OOp(OpIDecr);
		case 0xC2:
			OIncrIReg(reg());
		case 0xC3:
			ODecrIReg(reg());
		case 0xC4:
			OOp(OpINeg);
		case 0xC5:
			OOp(OpIAdd);
		case 0xC6:
			OOp(OpISub);
		case 0xC7:
			OOp(OpIMul);
		case 0xD0:
			OThis;
		case 0xD1:
			OReg(1);
		case 0xD2:
			OReg(2);
		case 0xD3:
			OReg(3);
		case 0xD4:
			OSetThis;
		case 0xD5:
			OSetReg(1);
		case 0xD6:
			OSetReg(2);
		case 0xD7:
			OSetReg(3);
		case 0xEF:
			var b = i.readByte();
			if (b != 1 ) 
				throw "assert"; 
			++bytePos;
			var name = readIndex();
			var r; 
			#if php 
				++bytePos;
				r = i.readByte();
			#else
				r = reg();
			#end
			var line = readInt();
			ODebugReg(name,r,line);
		case 0xF0:
			ODebugLine(readInt());
		case 0xF1:
			ODebugFile(readIndex());
		case 0xF2:
			OBreakPointLine(readInt());
		case 0xF3:
			OTimestamp;
		default:
			OUnknown(op);
		}
	}

	static var bytePos:Int = 0;
	static var jumps:Array < Array < String >> ;
	static var switches:Array < Array < String >> ;
	static var jumpNameIndex:Int;
	static var caseNameIndex:Int;
	static var labels:Array<String>;
	static var labelNameIndex:Int;
	static var ops: Array<format.abc.OpCode>;
	public static var positions:Array<Int>=[];
	public static function decode( i : haxe.io.Input ) : Array<format.abc.OpCode>
	{
		bytePos = 0;
		positions=[];
		jumps = new Array();
		switches= new Array();
		jumpNameIndex = 0;
		caseNameIndex= 0;
		labels = new Array();
		labelNameIndex = 0;
		var opr = new OpReader(i);
		ops = new Array();
		while ( true ) 
		{
			var op;
			positions.push(bytePos);
			try 
			{
				if (switches[bytePos] != null)
				{
					for (s in switches[bytePos])
					{
						ops.push(OCase(s));
					}
				}
				if (jumps[bytePos] != null)
				{
					for (s in jumps[bytePos])
					{
						ops.push(OJump3(s));
					}
				}
				op = i.readByte();
				++bytePos;
			}
			catch ( e : haxe.io.Eof ) 
			{
				break;
			}
			var opc = opr.readOp(op);
			ops.push(opc);
			
		}
		return ops;
	}
}
