<?php

class format_swf_Writer {
	public function __construct($o) {
		if( !php_Boot::$skip_constructor ) {
		$this->output = $o;
	}}
	public $output;
	public $o;
	public $compressed;
	public $bits;
	public function write($s) {
		$this->writeHeader($s->header);
		{
			$_g = 0; $_g1 = $s->tags;
			while($_g < $_g1->length) {
				$t = $_g1[$_g];
				++$_g;
				$this->writeTag($t);
				unset($t);
			}
		}
		$this->writeEnd();
	}
	public function writeRect($r) {
		$nbits = eval("if(isset(\$this)) \$퍁his =& \$this;\$_g = _hx_qtype(\"format.swf.Tools\"); \$values = new _hx_array(array(\$r->left, \$r->right, \$r->top, \$r->bottom));
			\$max_bits = 0;
			{
				\$_g1 = 0;
				while(\$_g1 < \$values->length) {
					\$x = \$values[\$_g1];
					++\$_g1;
					if(\$x < 0) {
						\$x = -\$x;
					}
					\$x |= (\$x >> 1);
					\$x |= (\$x >> 2);
					\$x |= (\$x >> 4);
					\$x |= (\$x >> 8);
					\$x |= (\$x >> 16);
					\$x -= ((\$x >> 1) & 1431655765);
					\$x = (((\$x >> 2) & 858993459) + (\$x & 858993459));
					\$x = (((\$x >> 4) + \$x) & 252645135);
					\$x += (\$x >> 8);
					\$x += (\$x >> 16);
					\$x &= 63;
					if(\$x > \$max_bits) {
						\$max_bits = \$x;
					}
					unset(\$x);
				}
			}
			\$팿 = \$max_bits;
			return \$팿;
		") + 1;
		$this->bits->writeBits(5, $nbits);
		$this->bits->writeBits($nbits, $r->left);
		$this->bits->writeBits($nbits, $r->right);
		$this->bits->writeBits($nbits, $r->top);
		$this->bits->writeBits($nbits, $r->bottom);
		{
			$_g2 = $this->bits;
			if($_g2->nbits > 0) {
				$_g2->writeBits(8 - $_g2->nbits, 0);
				$_g2->nbits = 0;
			}
		}
	}
	public function writeFixed8($v) {
		$this->o->writeUInt16($v);
	}
	public function writeFixed($v) {
		$this->o->writeInt32($v);
	}
	public function openTMP() {
		$old = $this->o;
		$this->o = new haxe_io_BytesOutput();
		$this->bits->o = $this->o;
		return $old;
	}
	public function closeTMP($old) {
		$bytes = $this->o->getBytes();
		$this->o = $old;
		$this->bits->o = $old;
		return $bytes;
	}
	public function writeHeader($h) {
		$this->compressed = false;
		$this->output->writeString(($this->compressed ? "CWS" : "FWS"));
		$this->output->writeByte($h->version);
		$this->o = new haxe_io_BytesOutput();
		$this->bits = new format_tools_BitsOutput($this->o);
		$this->writeRect(_hx_anonymous(array("left" => 0, "top" => 0, "right" => $h->width * 20, "bottom" => $h->height * 20)));
		$this->o->writeByte(0);
		$this->o->writeByte($h->fps);
		$this->o->writeUInt16($h->nframes);
	}
	public function writeRGB($c) {
		$this->o->writeByte($c->r);
		$this->o->writeByte($c->g);
		$this->o->writeByte($c->b);
	}
	public function writeRGBA($c) {
		$this->o->writeByte($c->r);
		$this->o->writeByte($c->g);
		$this->o->writeByte($c->b);
		$this->o->writeByte($c->a);
	}
	public function writeMatrix($m) {
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		if(_hx_field($m, "scale") !== null) {
			$this->bits->writeBit(true);
			$sx = eval("if(isset(\$this)) \$퍁his =& \$this;\$f = \$m->scale->x;
				\$i = intval(\$f);
				if((((\$i > 0) ? \$i : -\$i)) >= 32768) {
					throw new HException(haxe_io_Error::\$Overflow);
				}
				if(\$i < 0) {
					\$i = 65536 - \$i;
				}
				\$팿 = ((\$i << 16) | intval((\$f - \$i) * 65536.0));
				return \$팿;
			");
			$sy = eval("if(isset(\$this)) \$퍁his =& \$this;\$f2 = \$m->scale->y;
				\$i2 = intval(\$f2);
				if((((\$i2 > 0) ? \$i2 : -\$i2)) >= 32768) {
					throw new HException(haxe_io_Error::\$Overflow);
				}
				if(\$i2 < 0) {
					\$i2 = 65536 - \$i2;
				}
				\$팿2 = ((\$i2 << 16) | intval((\$f2 - \$i2) * 65536.0));
				return \$팿2;
			");
			$nbits = eval("if(isset(\$this)) \$퍁his =& \$this;\$_g2 = _hx_qtype(\"format.swf.Tools\"); \$values = new _hx_array(array(\$sx, \$sy));
				\$max_bits = 0;
				{
					\$_g1 = 0;
					while(\$_g1 < \$values->length) {
						\$x = \$values[\$_g1];
						++\$_g1;
						if(\$x < 0) {
							\$x = -\$x;
						}
						\$x |= (\$x >> 1);
						\$x |= (\$x >> 2);
						\$x |= (\$x >> 4);
						\$x |= (\$x >> 8);
						\$x |= (\$x >> 16);
						\$x -= ((\$x >> 1) & 1431655765);
						\$x = (((\$x >> 2) & 858993459) + (\$x & 858993459));
						\$x = (((\$x >> 4) + \$x) & 252645135);
						\$x += (\$x >> 8);
						\$x += (\$x >> 16);
						\$x &= 63;
						if(\$x > \$max_bits) {
							\$max_bits = \$x;
						}
						unset(\$x);
					}
				}
				\$팿3 = \$max_bits;
				return \$팿3;
			") + 1;
			$this->bits->writeBits(5, $nbits);
			$this->bits->writeBits($nbits, $sx);
			$this->bits->writeBits($nbits, $sy);
		}
		else {
			$this->bits->writeBit(false);
		}
		if(_hx_field($m, "rotate") !== null) {
			$this->bits->writeBit(true);
			$rs0 = eval("if(isset(\$this)) \$퍁his =& \$this;\$f3 = \$m->rotate->rs0;
				\$i3 = intval(\$f3);
				if((((\$i3 > 0) ? \$i3 : -\$i3)) >= 32768) {
					throw new HException(haxe_io_Error::\$Overflow);
				}
				if(\$i3 < 0) {
					\$i3 = 65536 - \$i3;
				}
				\$팿4 = ((\$i3 << 16) | intval((\$f3 - \$i3) * 65536.0));
				return \$팿4;
			");
			$rs1 = eval("if(isset(\$this)) \$퍁his =& \$this;\$f4 = \$m->rotate->rs1;
				\$i4 = intval(\$f4);
				if((((\$i4 > 0) ? \$i4 : -\$i4)) >= 32768) {
					throw new HException(haxe_io_Error::\$Overflow);
				}
				if(\$i4 < 0) {
					\$i4 = 65536 - \$i4;
				}
				\$팿5 = ((\$i4 << 16) | intval((\$f4 - \$i4) * 65536.0));
				return \$팿5;
			");
			$nbits2 = eval("if(isset(\$this)) \$퍁his =& \$this;\$_g3 = _hx_qtype(\"format.swf.Tools\"); \$values2 = new _hx_array(array(\$rs0, \$rs1));
				\$max_bits2 = 0;
				{
					\$_g12 = 0;
					while(\$_g12 < \$values2->length) {
						\$x2 = \$values2[\$_g12];
						++\$_g12;
						if(\$x2 < 0) {
							\$x2 = -\$x2;
						}
						\$x2 |= (\$x2 >> 1);
						\$x2 |= (\$x2 >> 2);
						\$x2 |= (\$x2 >> 4);
						\$x2 |= (\$x2 >> 8);
						\$x2 |= (\$x2 >> 16);
						\$x2 -= ((\$x2 >> 1) & 1431655765);
						\$x2 = (((\$x2 >> 2) & 858993459) + (\$x2 & 858993459));
						\$x2 = (((\$x2 >> 4) + \$x2) & 252645135);
						\$x2 += (\$x2 >> 8);
						\$x2 += (\$x2 >> 16);
						\$x2 &= 63;
						if(\$x2 > \$max_bits2) {
							\$max_bits2 = \$x2;
						}
						unset(\$x2);
					}
				}
				\$팿6 = \$max_bits2;
				return \$팿6;
			") + 1;
			$this->bits->writeBits(5, $nbits2);
			$this->bits->writeBits($nbits2, $rs0);
			$this->bits->writeBits($nbits2, $rs1);
		}
		else {
			$this->bits->writeBit(false);
		}
		$nbits3 = eval("if(isset(\$this)) \$퍁his =& \$this;\$_g4 = _hx_qtype(\"format.swf.Tools\"); \$values3 = new _hx_array(array(\$m->translate->x, \$m->translate->y));
			\$max_bits3 = 0;
			{
				\$_g13 = 0;
				while(\$_g13 < \$values3->length) {
					\$x3 = \$values3[\$_g13];
					++\$_g13;
					if(\$x3 < 0) {
						\$x3 = -\$x3;
					}
					\$x3 |= (\$x3 >> 1);
					\$x3 |= (\$x3 >> 2);
					\$x3 |= (\$x3 >> 4);
					\$x3 |= (\$x3 >> 8);
					\$x3 |= (\$x3 >> 16);
					\$x3 -= ((\$x3 >> 1) & 1431655765);
					\$x3 = (((\$x3 >> 2) & 858993459) + (\$x3 & 858993459));
					\$x3 = (((\$x3 >> 4) + \$x3) & 252645135);
					\$x3 += (\$x3 >> 8);
					\$x3 += (\$x3 >> 16);
					\$x3 &= 63;
					if(\$x3 > \$max_bits3) {
						\$max_bits3 = \$x3;
					}
					unset(\$x3);
				}
			}
			\$팿7 = \$max_bits3;
			return \$팿7;
		") + 1;
		$this->bits->writeBits(5, $nbits3);
		$this->bits->writeBits($nbits3, $m->translate->x);
		$this->bits->writeBits($nbits3, $m->translate->y);
		{
			$_g5 = $this->bits;
			if($_g5->nbits > 0) {
				$_g5->writeBits(8 - $_g5->nbits, 0);
				$_g5->nbits = 0;
			}
		}
	}
	public function writeCXAColor($c, $nbits) {
		$this->bits->writeBits($nbits, $c->r);
		$this->bits->writeBits($nbits, $c->g);
		$this->bits->writeBits($nbits, $c->b);
		$this->bits->writeBits($nbits, $c->a);
	}
	public function writeCXA($c) {
		$this->bits->writeBit(_hx_field($c, "add") !== null);
		$this->bits->writeBit(_hx_field($c, "mult") !== null);
		$this->bits->writeBits(4, $c->nbits);
		if(_hx_field($c, "mult") !== null) {
			$this->writeCXAColor($c->mult, $c->nbits);
		}
		if(_hx_field($c, "add") !== null) {
			$this->writeCXAColor($c->add, $c->nbits);
		}
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
	}
	public function writeClipEvents($events) {
		$this->o->writeUInt16(0);
		$all = 0;
		{
			$_g = 0;
			while($_g < $events->length) {
				$e = $events[$_g];
				++$_g;
				$all |= $e->eventsFlags;
				unset($e);
			}
		}
		$this->o->writeUInt30($all);
		{
			$_g2 = 0;
			while($_g2 < $events->length) {
				$e2 = $events[$_g2];
				++$_g2;
				$this->o->writeUInt30($e2->eventsFlags);
				$this->o->writeUInt30($e2->data->length);
				$this->o->write($e2->data);
				unset($e2);
			}
		}
		$this->o->writeUInt16(0);
	}
	public function writeFilterFlags($f, $top) {
		$flags = 32;
		if($f->inner) {
			$flags |= 128;
		}
		if($f->knockout) {
			$flags |= 64;
		}
		if($f->ontop) {
			$flags |= 16;
		}
		$flags |= $f->passes;
		$this->o->writeByte($flags);
	}
	public function writeFilterGradient($f) {
		$this->o->writeByte($f->colors->length);
		{
			$_g = 0; $_g1 = $f->colors;
			while($_g < $_g1->length) {
				$c = $_g1[$_g];
				++$_g;
				$this->writeRGBA($c->color);
				unset($c);
			}
		}
		{
			$_g2 = 0; $_g12 = $f->colors;
			while($_g2 < $_g12->length) {
				$c2 = $_g12[$_g2];
				++$_g2;
				$this->o->writeByte($c2->position);
				unset($c2);
			}
		}
		$d = $f->data;
		$this->o->writeInt32($d->blurX);
		$this->o->writeInt32($d->blurY);
		$this->o->writeInt32($d->angle);
		$this->o->writeInt32($d->distance);
		$this->o->writeUInt16($d->strength);
		$this->writeFilterFlags($d->flags, true);
	}
	public function writeFilter($f) {
		$퍁 = ($f);
		switch($퍁->index) {
		case 0:
		$d = $퍁->params[0];
		{
			$this->o->writeByte(0);
			$this->writeRGBA($d->color);
			$this->o->writeInt32($d->blurX);
			$this->o->writeInt32($d->blurY);
			$this->o->writeInt32($d->angle);
			$this->o->writeInt32($d->distance);
			$this->o->writeUInt16($d->strength);
			$this->writeFilterFlags($d->flags, false);
		}break;
		case 1:
		$d2 = $퍁->params[0];
		{
			$this->o->writeByte(1);
			$this->o->writeInt32($d2->blurX);
			$this->o->writeInt32($d2->blurY);
			$this->o->writeByte($d2->passes << 3);
		}break;
		case 2:
		$d3 = $퍁->params[0];
		{
			$this->o->writeByte(2);
			$this->writeRGBA($d3->color);
			$this->o->writeInt32($d3->blurX);
			$this->o->writeInt32($d3->blurY);
			$this->o->writeUInt16($d3->strength);
			$this->writeFilterFlags($d3->flags, false);
		}break;
		case 3:
		$d4 = $퍁->params[0];
		{
			$this->o->writeByte(3);
			$this->writeRGBA($d4->color);
			$this->writeRGBA($d4->color2);
			$this->o->writeInt32($d4->blurX);
			$this->o->writeInt32($d4->blurY);
			$this->o->writeInt32($d4->angle);
			$this->o->writeInt32($d4->distance);
			$this->o->writeUInt16($d4->strength);
			$this->writeFilterFlags($d4->flags, true);
		}break;
		case 4:
		$d5 = $퍁->params[0];
		{
			$this->o->writeByte(5);
			$this->writeFilterGradient($d5);
		}break;
		case 5:
		$d6 = $퍁->params[0];
		{
			$this->o->writeByte(6);
			{
				$_g = 0;
				while($_g < $d6->length) {
					$f1 = $d6[$_g];
					++$_g;
					$this->o->writeFloat($f1);
					unset($f1);
				}
			}
		}break;
		case 6:
		$d7 = $퍁->params[0];
		{
			$this->o->writeByte(7);
			$this->writeFilterGradient($d7);
		}break;
		}
	}
	public function writeFilters($filters) {
		$this->o->writeByte($filters->length);
		{
			$_g = 0;
			while($_g < $filters->length) {
				$f = $filters[$_g];
				++$_g;
				$this->writeFilter($f);
				unset($f);
			}
		}
	}
	public function writeBlendMode($b) {
		$this->o->writeByte($b->index + 1);
	}
	public function writePlaceObject($po, $v3) {
		$f = 0;
		$f2 = 0;
		if($po->move) {
			$f |= 1;
		}
		if($po->cid !== null) {
			$f |= 2;
		}
		if(_hx_field($po, "matrix") !== null) {
			$f |= 4;
		}
		if(_hx_field($po, "color") !== null) {
			$f |= 8;
		}
		if($po->ratio !== null) {
			$f |= 16;
		}
		if($po->instanceName !== null) {
			$f |= 32;
		}
		if($po->clipDepth !== null) {
			$f |= 64;
		}
		if($po->events !== null) {
			$f |= 128;
		}
		if($po->filters !== null) {
			$f2 |= 1;
		}
		if($po->blendMode !== null) {
			$f2 |= 2;
		}
		if($po->bitmapCache) {
			$f2 |= 4;
		}
		$this->o->writeByte($f);
		if($v3) {
			$this->o->writeByte($f2);
		}
		else {
			if($f2 !== 0) {
				throw new HException("Invalid place object version");
			}
		}
		$this->o->writeUInt16($po->depth);
		if($po->cid !== null) {
			$this->o->writeUInt16($po->cid);
		}
		if(_hx_field($po, "matrix") !== null) {
			$this->writeMatrix($po->matrix);
		}
		if(_hx_field($po, "color") !== null) {
			$this->writeCXA($po->color);
		}
		if($po->ratio !== null) {
			$this->o->writeUInt16($po->ratio);
		}
		if($po->instanceName !== null) {
			$this->o->writeString($po->instanceName);
			$this->o->writeByte(0);
		}
		if($po->clipDepth !== null) {
			$this->o->writeUInt16($po->clipDepth);
		}
		if($po->filters !== null) {
			$this->writeFilters($po->filters);
		}
		if($po->blendMode !== null) {
			$this->writeBlendMode($po->blendMode);
		}
		if($po->events !== null) {
			$this->writeClipEvents($po->events);
		}
	}
	public function writeTID($id, $len) {
		$h = ($id << 6);
		if($len < 63) {
			$this->o->writeUInt16($h | $len);
		}
		else {
			$this->o->writeUInt16($h | 63);
			$this->o->writeUInt30($len);
		}
	}
	public function writeTIDExt($id, $len) {
		$this->o->writeUInt16(($id << 6) | 63);
		$this->o->writeUInt30($len);
	}
	public function writeSymbols($sl, $tagid) {
		$len = 2;
		{
			$_g = 0;
			while($_g < $sl->length) {
				$s = $sl[$_g];
				++$_g;
				$len += 2 + strlen($s->className) + 1;
				unset($s);
			}
		}
		$this->writeTID($tagid, $len);
		$this->o->writeUInt16($sl->length);
		{
			$_g2 = 0;
			while($_g2 < $sl->length) {
				$s2 = $sl[$_g2];
				++$_g2;
				$this->o->writeUInt16($s2->cid);
				$this->o->writeString($s2->className);
				$this->o->writeByte(0);
				unset($s2);
			}
		}
	}
	public function writeSound($s) {
		$len = 7 + eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁 = (\$s->data);
			switch(\$퍁->index) {
			case 0:
			\$data = \$퍁->params[1];
			{
				\$팿 = \$data->length + 2;
			}break;
			case 1:
			\$data2 = \$퍁->params[0];
			{
				\$팿 = \$data2->length;
			}break;
			case 2:
			\$data3 = \$퍁->params[0];
			{
				\$팿 = \$data3->length;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
		$this->writeTIDExt(14, $len);
		$this->o->writeUInt16($s->sid);
		$this->bits->writeBits(4, eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁2 = (\$s->format);
			switch(\$퍁2->index) {
			case 0:
			{
				\$팿2 = 0;
			}break;
			case 1:
			{
				\$팿2 = 1;
			}break;
			case 2:
			{
				\$팿2 = 2;
			}break;
			case 3:
			{
				\$팿2 = 3;
			}break;
			case 4:
			{
				\$팿2 = 4;
			}break;
			case 5:
			{
				\$팿2 = 5;
			}break;
			case 6:
			{
				\$팿2 = 6;
			}break;
			case 7:
			{
				\$팿2 = 11;
			}break;
			default:{
				\$팿2 = null;
			}break;
			}
			return \$팿2;
		"));
		$this->bits->writeBits(2, eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁3 = (\$s->rate);
			switch(\$퍁3->index) {
			case 0:
			{
				\$팿3 = 0;
			}break;
			case 1:
			{
				\$팿3 = 1;
			}break;
			case 2:
			{
				\$팿3 = 2;
			}break;
			case 3:
			{
				\$팿3 = 3;
			}break;
			default:{
				\$팿3 = null;
			}break;
			}
			return \$팿3;
		"));
		$this->bits->writeBit($s->is16bit);
		$this->bits->writeBit($s->isStereo);
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		$this->o->writeInt32($s->samples);
		$퍁4 = ($s->data);
		switch($퍁4->index) {
		case 0:
		$data4 = $퍁4->params[1]; $seek = $퍁4->params[0];
		{
			$this->o->writeInt16($seek);
			$this->o->write($data4);
		}break;
		case 1:
		$data5 = $퍁4->params[0];
		{
			$this->o->write($data5);
		}break;
		case 2:
		$data6 = $퍁4->params[0];
		{
			$this->o->write($data6);
		}break;
		}
	}
	public function writeGradRecord($ver, $grad_record) {
		$퍁 = ($grad_record);
		switch($퍁->index) {
		case 0:
		$col = $퍁->params[1]; $pos = $퍁->params[0];
		{
			if($ver > 2) {
				throw new HException("Shape versions higher than 2 require alpha channel in gradient control points!");
			}
			$this->o->writeByte($pos);
			$this->writeRGB($col);
		}break;
		case 1:
		$col2 = $퍁->params[1]; $pos2 = $퍁->params[0];
		{
			if($ver < 3) {
				throw new HException("Shape versions lower than 3 don't support alpha channel in gradient control points!");
			}
			$this->o->writeByte($pos2);
			$this->writeRGBA($col2);
		}break;
		}
	}
	public function writeGradient($ver, $grad) {
		$spread_mode = eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁 = (\$grad->spread);
			switch(\$퍁->index) {
			case 0:
			{
				\$팿 = 0;
			}break;
			case 1:
			{
				\$팿 = 1;
			}break;
			case 2:
			{
				\$팿 = 2;
			}break;
			case 3:
			{
				\$팿 = 3;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
		$interpolation_mode = eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁2 = (\$grad->interpolate);
			switch(\$퍁2->index) {
			case 0:
			{
				\$팿2 = 0;
			}break;
			case 1:
			{
				\$팿2 = 1;
			}break;
			case 2:
			{
				\$팿2 = 2;
			}break;
			case 3:
			{
				\$팿2 = 3;
			}break;
			default:{
				\$팿2 = null;
			}break;
			}
			return \$팿2;
		");
		if($ver < 4 && ($spread_mode !== 0 || $interpolation_mode !== 0)) {
			throw new HException("Spread must be Pad and interpolation mode must be Normal RGB in gradient specification when shape version is lower than 4!");
		}
		$num_records = $grad->data->length;
		if($ver < 4) {
			if($num_records > 8) {
				throw new HException("Gradient supports at most 8 control points (" . $num_records . " has bee given) when shape verison is lower than 4!");
			}
		}
		else {
			if($num_records > 15) {
				throw new HException("Gradient supports at most 15 control points (" . $num_records . " has been given) at shape version 4!");
			}
		}
		$this->bits->writeBits(2, $spread_mode);
		$this->bits->writeBits(2, $interpolation_mode);
		$this->bits->writeBits(4, $num_records);
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		{
			$_g2 = 0; $_g1 = $grad->data;
			while($_g2 < $_g1->length) {
				$grad_record = $_g1[$_g2];
				++$_g2;
				$this->writeGradRecord($ver, $grad_record);
				unset($grad_record);
			}
		}
	}
	public function writeFocalGradient($ver, $grad) {
		if($ver < 4) {
			throw new HException("Focal gradient only supported in shape versions higher than 3!");
		}
		$this->writeGradient($ver, $grad->data);
		$this->o->writeUInt16($grad->focalPoint);
	}
	public function writeFillStyle($ver, $fill_style) {
		$퍁 = ($fill_style);
		switch($퍁->index) {
		case 0:
		$rgb = $퍁->params[0];
		{
			if($ver > 2) {
				throw new HException("Fill styles with Shape versions higher than 2 reqire alhpa channel!");
			}
			$this->o->writeByte(0);
			$this->writeRGB($rgb);
		}break;
		case 1:
		$rgba = $퍁->params[0];
		{
			if($ver < 3) {
				throw new HException("Fill styles with Shape versions lower than 3 doesn't support alhpa channel!");
			}
			$this->o->writeByte(0);
			$this->writeRGBA($rgba);
		}break;
		case 2:
		$grad = $퍁->params[1]; $mat = $퍁->params[0];
		{
			$this->o->writeByte(16);
			$this->writeMatrix($mat);
			$this->writeGradient($ver, $grad);
		}break;
		case 3:
		$grad2 = $퍁->params[1]; $mat2 = $퍁->params[0];
		{
			$this->o->writeByte(18);
			$this->writeMatrix($mat2);
			$this->writeGradient($ver, $grad2);
		}break;
		case 4:
		$grad3 = $퍁->params[1]; $mat3 = $퍁->params[0];
		{
			if($ver > 3) {
				throw new HException("Focal gradient fill style only supported with Shape versions higher than 3!");
			}
			$this->o->writeByte(19);
			$this->writeMatrix($mat3);
			$this->writeFocalGradient($ver, $grad3);
		}break;
		case 5:
		$smooth = $퍁->params[3]; $repeat = $퍁->params[2]; $mat4 = $퍁->params[1]; $cid = $퍁->params[0];
		{
			$this->o->writeByte(($repeat ? ($smooth ? 64 : 66) : ($smooth ? 65 : 67)));
			$this->o->writeUInt16($cid);
			$this->writeMatrix($mat4);
		}break;
		}
	}
	public function writeFillStyles($ver, $fill_styles) {
		$num_styles = $fill_styles->length;
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		if($num_styles > 254) {
			if($ver >= 2) {
				$this->o->writeByte(255);
				$this->o->writeUInt16($num_styles);
			}
			else {
				if($num_styles === 255) {
					$this->o->writeByte(255);
				}
				else {
					throw new HException("Too much fill styles (" . $num_styles . ") for Shape version 1");
				}
			}
		}
		else {
			$this->o->writeByte($num_styles);
		}
		{
			$_g2 = 0;
			while($_g2 < $fill_styles->length) {
				$style = $fill_styles[$_g2];
				++$_g2;
				$this->writeFillStyle($ver, $style);
				unset($style);
			}
		}
	}
	public function writeLineStyle($ver, $line_style) {
		$this->o->writeUInt16($line_style->width);
		$퍁 = ($line_style->data);
		switch($퍁->index) {
		case 0:
		$rgb = $퍁->params[0];
		{
			if($ver > 2) {
				throw new HException("Line styles with Shape versions higher than 2 reqire alhpa channel!");
			}
			$this->writeRGB($rgb);
		}break;
		case 1:
		$rgba = $퍁->params[0];
		{
			if($ver < 3) {
				throw new HException("Line styles with Shape versions lower than 3 doesn't support alhpa channel!");
			}
			$this->writeRGBA($rgba);
		}break;
		case 2:
		$data = $퍁->params[0];
		{
			if($ver < 4) {
				throw new HException("LineStyle version 2 only supported in shape versions higher than 3!");
			}
			$this->bits->writeBits(2, eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁2 = (\$data->startCap);
				switch(\$퍁2->index) {
				case 0:
				{
					\$팿 = 0;
				}break;
				case 1:
				{
					\$팿 = 1;
				}break;
				case 2:
				{
					\$팿 = 2;
				}break;
				default:{
					\$팿 = null;
				}break;
				}
				return \$팿;
			"));
			$this->bits->writeBits(2, eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁3 = (\$data->join);
				switch(\$퍁3->index) {
				case 0:
				{
					\$팿2 = 0;
				}break;
				case 1:
				{
					\$팿2 = 1;
				}break;
				case 2:
				\$limitFactor = \$퍁3->params[0];
				{
					\$팿2 = 2;
				}break;
				default:{
					\$팿2 = null;
				}break;
				}
				return \$팿2;
			"));
			$this->bits->writeBit(eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁4 = (\$data->fill);
				switch(\$퍁4->index) {
				case 0:
				\$color = \$퍁4->params[0];
				{
					\$팿3 = false;
				}break;
				case 1:
				\$style = \$퍁4->params[0];
				{
					\$팿3 = true;
				}break;
				default:{
					\$팿3 = null;
				}break;
				}
				return \$팿3;
			"));
			$this->bits->writeBit($data->noHScale);
			$this->bits->writeBit($data->noVScale);
			$this->bits->writeBit($data->pixelHinting);
			$this->bits->writeBits(5, 0);
			$this->bits->writeBit($data->noClose);
			$this->bits->writeBits(2, eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁5 = (\$data->endCap);
				switch(\$퍁5->index) {
				case 0:
				{
					\$팿4 = 0;
				}break;
				case 1:
				{
					\$팿4 = 1;
				}break;
				case 2:
				{
					\$팿4 = 2;
				}break;
				default:{
					\$팿4 = null;
				}break;
				}
				return \$팿4;
			"));
			$퍁6 = ($data->join);
			switch($퍁6->index) {
			case 2:
			$limitFactor2 = $퍁6->params[0];
			{
				$this->o->writeUInt16($limitFactor2);
			}break;
			default:{
				;
			}break;
			}
			$퍁7 = ($data->fill);
			switch($퍁7->index) {
			case 0:
			$color2 = $퍁7->params[0];
			{
				$this->writeRGBA($color2);
			}break;
			case 1:
			$style2 = $퍁7->params[0];
			{
				$this->writeFillStyle($ver, $style2);
			}break;
			}
		}break;
		}
	}
	public function writeLineStyles($ver, $line_styles) {
		$num_styles = $line_styles->length;
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		if($num_styles > 254) {
			if($ver >= 2) {
				$this->o->writeByte(255);
				$this->o->writeUInt16($num_styles);
			}
			else {
				if($num_styles === 255) {
					$this->o->writeByte(255);
				}
				else {
					throw new HException("Too much line styles (" . $num_styles . ") for Shape version 1");
				}
			}
		}
		else {
			$this->o->writeByte($num_styles);
		}
		{
			$_g2 = 0;
			while($_g2 < $line_styles->length) {
				$style = $line_styles[$_g2];
				++$_g2;
				$this->writeLineStyle($ver, $style);
				unset($style);
			}
		}
	}
	public function writeShapeRecord($ver, $style_info, $shape_record) {
		$퍁 = ($shape_record);
		switch($퍁->index) {
		case 0:
		{
			$this->bits->writeBit(false);
			$this->bits->writeBits(5, 0);
		}break;
		case 1:
		$data = $퍁->params[0];
		{
			$this->bits->writeBit(false);
			if(_hx_field($data, "newStyles") !== null) {
				if($ver === 2 || $ver === 3) {
					$this->bits->writeBit(true);
				}
				else {
					throw new HException("Defining new fill and line style arrays are only supported in shape version 2 and 3!");
				}
			}
			else {
				$this->bits->writeBit(false);
			}
			$this->bits->writeBit(_hx_field($data, "lineStyle") !== null);
			$this->bits->writeBit(_hx_field($data, "fillStyle1") !== null);
			$this->bits->writeBit(_hx_field($data, "fillStyle0") !== null);
			$this->bits->writeBit(_hx_field($data, "moveTo") !== null);
			if(_hx_field($data, "moveTo") !== null) {
				$mb = eval("if(isset(\$this)) \$퍁his =& \$this;\$_g = _hx_qtype(\"format.swf.Tools\"); \$values = new _hx_array(array(\$data->moveTo->dx, \$data->moveTo->dy));
					\$max_bits = 0;
					{
						\$_g1 = 0;
						while(\$_g1 < \$values->length) {
							\$x = \$values[\$_g1];
							++\$_g1;
							if(\$x < 0) {
								\$x = -\$x;
							}
							\$x |= (\$x >> 1);
							\$x |= (\$x >> 2);
							\$x |= (\$x >> 4);
							\$x |= (\$x >> 8);
							\$x |= (\$x >> 16);
							\$x -= ((\$x >> 1) & 1431655765);
							\$x = (((\$x >> 2) & 858993459) + (\$x & 858993459));
							\$x = (((\$x >> 4) + \$x) & 252645135);
							\$x += (\$x >> 8);
							\$x += (\$x >> 16);
							\$x &= 63;
							if(\$x > \$max_bits) {
								\$max_bits = \$x;
							}
							unset(\$x);
						}
					}
					\$팿 = \$max_bits;
					return \$팿;
				") + 1;
				$this->bits->writeBits(5, $mb);
				$this->bits->writeBits($mb, $data->moveTo->dx);
				$this->bits->writeBits($mb, $data->moveTo->dy);
			}
			if(_hx_field($data, "fillStyle0") !== null) {
				$this->bits->writeBits($style_info->fillBits, $data->fillStyle0->idx);
			}
			if(_hx_field($data, "fillStyle1") !== null) {
				$this->bits->writeBits($style_info->fillBits, $data->fillStyle1->idx);
			}
			if(_hx_field($data, "lineStyle") !== null) {
				$this->bits->writeBits($style_info->lineBits, $data->lineStyle->idx);
			}
			if(_hx_field($data, "newStyles") !== null) {
				$this->writeFillStyles($ver, $data->newStyles->fillStyles);
				$this->writeLineStyles($ver, $data->newStyles->lineStyles);
				$style_info->numFillStyles += $data->newStyles->fillStyles->length;
				$style_info->numLineStyles += $data->newStyles->lineStyles->length;
				$style_info->fillBits = eval("if(isset(\$this)) \$퍁his =& \$this;\$_g2 = _hx_qtype(\"format.swf.Tools\"); \$values2 = new _hx_array(array(\$style_info->numFillStyles));
					\$max_bits2 = 0;
					{
						\$_g12 = 0;
						while(\$_g12 < \$values2->length) {
							\$x2 = \$values2[\$_g12];
							++\$_g12;
							if(\$x2 < 0) {
								\$x2 = -\$x2;
							}
							\$x2 |= (\$x2 >> 1);
							\$x2 |= (\$x2 >> 2);
							\$x2 |= (\$x2 >> 4);
							\$x2 |= (\$x2 >> 8);
							\$x2 |= (\$x2 >> 16);
							\$x2 -= ((\$x2 >> 1) & 1431655765);
							\$x2 = (((\$x2 >> 2) & 858993459) + (\$x2 & 858993459));
							\$x2 = (((\$x2 >> 4) + \$x2) & 252645135);
							\$x2 += (\$x2 >> 8);
							\$x2 += (\$x2 >> 16);
							\$x2 &= 63;
							if(\$x2 > \$max_bits2) {
								\$max_bits2 = \$x2;
							}
							unset(\$x2);
						}
					}
					\$팿2 = \$max_bits2;
					return \$팿2;
				");
				$style_info->lineBits = eval("if(isset(\$this)) \$퍁his =& \$this;\$_g3 = _hx_qtype(\"format.swf.Tools\"); \$values3 = new _hx_array(array(\$style_info->numLineStyles));
					\$max_bits3 = 0;
					{
						\$_g13 = 0;
						while(\$_g13 < \$values3->length) {
							\$x3 = \$values3[\$_g13];
							++\$_g13;
							if(\$x3 < 0) {
								\$x3 = -\$x3;
							}
							\$x3 |= (\$x3 >> 1);
							\$x3 |= (\$x3 >> 2);
							\$x3 |= (\$x3 >> 4);
							\$x3 |= (\$x3 >> 8);
							\$x3 |= (\$x3 >> 16);
							\$x3 -= ((\$x3 >> 1) & 1431655765);
							\$x3 = (((\$x3 >> 2) & 858993459) + (\$x3 & 858993459));
							\$x3 = (((\$x3 >> 4) + \$x3) & 252645135);
							\$x3 += (\$x3 >> 8);
							\$x3 += (\$x3 >> 16);
							\$x3 &= 63;
							if(\$x3 > \$max_bits3) {
								\$max_bits3 = \$x3;
							}
							unset(\$x3);
						}
					}
					\$팿3 = \$max_bits3;
					return \$팿3;
				");
				$this->bits->writeBits(4, $style_info->fillBits);
				$this->bits->writeBits(4, $style_info->lineBits);
			}
		}break;
		case 2:
		$dy = $퍁->params[1]; $dx = $퍁->params[0];
		{
			$this->bits->writeBit(true);
			$this->bits->writeBit(true);
			$mb2 = eval("if(isset(\$this)) \$퍁his =& \$this;\$_g4 = _hx_qtype(\"format.swf.Tools\"); \$values4 = new _hx_array(array(\$dx, \$dy));
				\$max_bits4 = 0;
				{
					\$_g14 = 0;
					while(\$_g14 < \$values4->length) {
						\$x4 = \$values4[\$_g14];
						++\$_g14;
						if(\$x4 < 0) {
							\$x4 = -\$x4;
						}
						\$x4 |= (\$x4 >> 1);
						\$x4 |= (\$x4 >> 2);
						\$x4 |= (\$x4 >> 4);
						\$x4 |= (\$x4 >> 8);
						\$x4 |= (\$x4 >> 16);
						\$x4 -= ((\$x4 >> 1) & 1431655765);
						\$x4 = (((\$x4 >> 2) & 858993459) + (\$x4 & 858993459));
						\$x4 = (((\$x4 >> 4) + \$x4) & 252645135);
						\$x4 += (\$x4 >> 8);
						\$x4 += (\$x4 >> 16);
						\$x4 &= 63;
						if(\$x4 > \$max_bits4) {
							\$max_bits4 = \$x4;
						}
						unset(\$x4);
					}
				}
				\$팿4 = \$max_bits4;
				return \$팿4;
			") + 1;
			$mb2 = ($mb2 < 2 ? 0 : $mb2 - 2);
			$this->bits->writeBits(4, $mb2);
			$mb2 += 2;
			$is_general = ($dx !== 0) && ($dy !== 0);
			$this->bits->writeBit($is_general);
			if(!$is_general) {
				$is_vertical = ($dx === 0);
				$this->bits->writeBit($is_vertical);
				if($is_vertical) {
					$this->bits->writeBits($mb2, $dy);
				}
				else {
					$this->bits->writeBits($mb2, $dx);
				}
			}
			else {
				$this->bits->writeBits($mb2, $dx);
				$this->bits->writeBits($mb2, $dy);
			}
		}break;
		case 3:
		$ady = $퍁->params[3]; $adx = $퍁->params[2]; $cdy = $퍁->params[1]; $cdx = $퍁->params[0];
		{
			$this->bits->writeBit(true);
			$this->bits->writeBit(false);
			$mb3 = eval("if(isset(\$this)) \$퍁his =& \$this;\$_g5 = _hx_qtype(\"format.swf.Tools\"); \$values5 = new _hx_array(array(\$cdx, \$cdy, \$adx, \$ady));
				\$max_bits5 = 0;
				{
					\$_g15 = 0;
					while(\$_g15 < \$values5->length) {
						\$x5 = \$values5[\$_g15];
						++\$_g15;
						if(\$x5 < 0) {
							\$x5 = -\$x5;
						}
						\$x5 |= (\$x5 >> 1);
						\$x5 |= (\$x5 >> 2);
						\$x5 |= (\$x5 >> 4);
						\$x5 |= (\$x5 >> 8);
						\$x5 |= (\$x5 >> 16);
						\$x5 -= ((\$x5 >> 1) & 1431655765);
						\$x5 = (((\$x5 >> 2) & 858993459) + (\$x5 & 858993459));
						\$x5 = (((\$x5 >> 4) + \$x5) & 252645135);
						\$x5 += (\$x5 >> 8);
						\$x5 += (\$x5 >> 16);
						\$x5 &= 63;
						if(\$x5 > \$max_bits5) {
							\$max_bits5 = \$x5;
						}
						unset(\$x5);
					}
				}
				\$팿5 = \$max_bits5;
				return \$팿5;
			") + 1;
			$mb3 = ($mb3 < 2 ? 0 : $mb3 - 2);
			$this->bits->writeBits(4, $mb3);
			$mb3 += 2;
			$this->bits->writeBits($mb3, $cdx);
			$this->bits->writeBits($mb3, $cdy);
			$this->bits->writeBits($mb3, $adx);
			$this->bits->writeBits($mb3, $ady);
		}break;
		}
	}
	public function writeShapeWithoutStyle($ver, $data) {
		$style_info = _hx_anonymous(array("numFillStyles" => 0, "fillBits" => 1, "numLineStyles" => 0, "lineBits" => 1));
		$this->bits->writeBits(4, $style_info->fillBits);
		$this->bits->writeBits(4, $style_info->lineBits);
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		{
			$_g2 = 0; $_g1 = $data->shapeRecords;
			while($_g2 < $_g1->length) {
				$shr = $_g1[$_g2];
				++$_g2;
				$this->writeShapeRecord($ver, $style_info, $shr);
				unset($shr);
			}
		}
		{
			$_g3 = $this->bits;
			if($_g3->nbits > 0) {
				$_g3->writeBits(8 - $_g3->nbits, 0);
				$_g3->nbits = 0;
			}
		}
	}
	public function writeShapeWithStyle($ver, $data) {
		$this->writeFillStyles($ver, $data->fillStyles);
		$this->writeLineStyles($ver, $data->lineStyles);
		$style_info = _hx_anonymous(array("numFillStyles" => $data->fillStyles->length, "fillBits" => eval("if(isset(\$this)) \$퍁his =& \$this;\$_g = _hx_qtype(\"format.swf.Tools\"); \$values = new _hx_array(array(\$data->fillStyles->length));
			\$max_bits = 0;
			{
				\$_g1 = 0;
				while(\$_g1 < \$values->length) {
					\$x = \$values[\$_g1];
					++\$_g1;
					if(\$x < 0) {
						\$x = -\$x;
					}
					\$x |= (\$x >> 1);
					\$x |= (\$x >> 2);
					\$x |= (\$x >> 4);
					\$x |= (\$x >> 8);
					\$x |= (\$x >> 16);
					\$x -= ((\$x >> 1) & 1431655765);
					\$x = (((\$x >> 2) & 858993459) + (\$x & 858993459));
					\$x = (((\$x >> 4) + \$x) & 252645135);
					\$x += (\$x >> 8);
					\$x += (\$x >> 16);
					\$x &= 63;
					if(\$x > \$max_bits) {
						\$max_bits = \$x;
					}
					unset(\$x);
				}
			}
			\$팿 = \$max_bits;
			return \$팿;
		"), "numLineStyles" => $data->lineStyles->length, "lineBits" => eval("if(isset(\$this)) \$퍁his =& \$this;\$_g2 = _hx_qtype(\"format.swf.Tools\"); \$values2 = new _hx_array(array(\$data->lineStyles->length));
			\$max_bits2 = 0;
			{
				\$_g12 = 0;
				while(\$_g12 < \$values2->length) {
					\$x2 = \$values2[\$_g12];
					++\$_g12;
					if(\$x2 < 0) {
						\$x2 = -\$x2;
					}
					\$x2 |= (\$x2 >> 1);
					\$x2 |= (\$x2 >> 2);
					\$x2 |= (\$x2 >> 4);
					\$x2 |= (\$x2 >> 8);
					\$x2 |= (\$x2 >> 16);
					\$x2 -= ((\$x2 >> 1) & 1431655765);
					\$x2 = (((\$x2 >> 2) & 858993459) + (\$x2 & 858993459));
					\$x2 = (((\$x2 >> 4) + \$x2) & 252645135);
					\$x2 += (\$x2 >> 8);
					\$x2 += (\$x2 >> 16);
					\$x2 &= 63;
					if(\$x2 > \$max_bits2) {
						\$max_bits2 = \$x2;
					}
					unset(\$x2);
				}
			}
			\$팿2 = \$max_bits2;
			return \$팿2;
		")));
		$this->bits->writeBits(4, $style_info->fillBits);
		$this->bits->writeBits(4, $style_info->lineBits);
		{
			$_g3 = $this->bits;
			if($_g3->nbits > 0) {
				$_g3->writeBits(8 - $_g3->nbits, 0);
				$_g3->nbits = 0;
			}
		}
		{
			$_g4 = 0; $_g13 = $data->shapeRecords;
			while($_g4 < $_g13->length) {
				$shr = $_g13[$_g4];
				++$_g4;
				$this->writeShapeRecord($ver, $style_info, $shr);
				unset($shr);
			}
		}
		{
			$_g5 = $this->bits;
			if($_g5->nbits > 0) {
				$_g5->writeBits(8 - $_g5->nbits, 0);
				$_g5->nbits = 0;
			}
		}
	}
	public function writeShape($id, $data) {
		$old = $this->openTMP();
		$this->o->writeUInt16($id);
		$퍁 = ($data);
		switch($퍁->index) {
		case 0:
		$shapes = $퍁->params[1]; $bounds = $퍁->params[0];
		{
			$this->writeRect($bounds);
			$this->writeShapeWithStyle(1, $shapes);
		}break;
		case 1:
		$shapes2 = $퍁->params[1]; $bounds2 = $퍁->params[0];
		{
			$this->writeRect($bounds2);
			$this->writeShapeWithStyle(2, $shapes2);
		}break;
		case 2:
		$shapes3 = $퍁->params[1]; $bounds3 = $퍁->params[0];
		{
			$this->writeRect($bounds3);
			$this->writeShapeWithStyle(3, $shapes3);
		}break;
		case 3:
		$data1 = $퍁->params[0];
		{
			$this->writeRect($data1->shapeBounds);
			$this->writeRect($data1->edgeBounds);
			$this->bits->writeBits(5, 0);
			$this->bits->writeBit($data1->useWinding);
			$this->bits->writeBit($data1->useNonScalingStroke);
			$this->bits->writeBit($data1->useScalingStroke);
			{
				$_g = $this->bits;
				if($_g->nbits > 0) {
					$_g->writeBits(8 - $_g->nbits, 0);
					$_g->nbits = 0;
				}
			}
			$this->writeShapeWithStyle(4, $data1->shapes);
		}break;
		}
		{
			$_g2 = $this->bits;
			if($_g2->nbits > 0) {
				$_g2->writeBits(8 - $_g2->nbits, 0);
				$_g2->nbits = 0;
			}
		}
		$shape_data = $this->closeTMP($old);
		$퍁2 = ($data);
		switch($퍁2->index) {
		case 0:
		$shapes4 = $퍁2->params[1]; $bounds4 = $퍁2->params[0];
		{
			$this->writeTID(2, $shape_data->length);
		}break;
		case 1:
		$shapes5 = $퍁2->params[1]; $bounds5 = $퍁2->params[0];
		{
			$this->writeTID(22, $shape_data->length);
		}break;
		case 2:
		$shapes6 = $퍁2->params[1]; $bounds6 = $퍁2->params[0];
		{
			$this->writeTID(32, $shape_data->length);
		}break;
		case 3:
		$data12 = $퍁2->params[0];
		{
			$this->writeTID(83, $shape_data->length);
		}break;
		}
		$this->o->write($shape_data);
	}
	public function writeMorphGradient($ver, $g) {
		$this->o->writeByte($g->startRatio);
		$this->writeRGBA($g->startColor);
		$this->o->writeByte($g->endRatio);
		$this->writeRGBA($g->endColor);
	}
	public function writeMorphGradients($ver, $gradients) {
		$num = $gradients->length;
		if($num < 1 || $num > 8) {
			throw new HException("Number of specified morph gradients (" . $num . ") must be in range 1..8");
		}
		{
			$_g = 0;
			while($_g < $gradients->length) {
				$grad = $gradients[$_g];
				++$_g;
				$this->writeMorphGradient($ver, $grad);
				unset($grad);
			}
		}
	}
	public function writeMorphFillStyle($ver, $fill_style) {
		$퍁 = ($fill_style);
		switch($퍁->index) {
		case 0:
		$endColor = $퍁->params[1]; $startColor = $퍁->params[0];
		{
			$this->o->writeByte(0);
			$this->writeRGBA($startColor);
			$this->writeRGBA($endColor);
		}break;
		case 1:
		$gradients = $퍁->params[2]; $endMatrix = $퍁->params[1]; $startMatrix = $퍁->params[0];
		{
			$this->o->writeByte(16);
			$this->writeMatrix($startMatrix);
			$this->writeMatrix($endMatrix);
			$this->writeMorphGradients($ver, $gradients);
		}break;
		case 2:
		$gradients2 = $퍁->params[2]; $endMatrix2 = $퍁->params[1]; $startMatrix2 = $퍁->params[0];
		{
			$this->o->writeByte(16);
			$this->writeMatrix($startMatrix2);
			$this->writeMatrix($endMatrix2);
			$this->writeMorphGradients($ver, $gradients2);
		}break;
		case 3:
		$smooth = $퍁->params[4]; $repeat = $퍁->params[3]; $endMatrix3 = $퍁->params[2]; $startMatrix3 = $퍁->params[1]; $cid = $퍁->params[0];
		{
			$this->o->writeByte(($repeat ? ($smooth ? 64 : 66) : ($smooth ? 65 : 67)));
			$this->o->writeUInt16($cid);
			$this->writeMatrix($startMatrix3);
			$this->writeMatrix($endMatrix3);
		}break;
		}
	}
	public function writeMorphFillStyles($ver, $fill_styles) {
		$num_styles = $fill_styles->length;
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		if($num_styles > 254) {
			$this->o->writeByte(255);
			$this->o->writeUInt16($num_styles);
		}
		else {
			$this->o->writeByte($num_styles);
		}
		{
			$_g2 = 0;
			while($_g2 < $fill_styles->length) {
				$style = $fill_styles[$_g2];
				++$_g2;
				$this->writeMorphFillStyle($ver, $style);
				unset($style);
			}
		}
	}
	public function writeMorph1LineStyle($s) {
		$this->o->writeUInt16($s->startWidth);
		$this->o->writeUInt16($s->endWidth);
		$this->writeRGBA($s->startColor);
		$this->writeRGBA($s->endColor);
	}
	public function writeMorph1LineStyles($line_styles) {
		$num_styles = $line_styles->length;
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		if($num_styles > 254) {
			$this->o->writeByte(255);
			$this->o->writeUInt16($num_styles);
		}
		else {
			$this->o->writeByte($num_styles);
		}
		{
			$_g2 = 0;
			while($_g2 < $line_styles->length) {
				$style = $line_styles[$_g2];
				++$_g2;
				$this->writeMorph1LineStyle($style);
				unset($style);
			}
		}
	}
	public function writeMorph2LineStyle($style) {
		$m2data = null;
		$퍁 = ($style);
		switch($퍁->index) {
		case 0:
		$data = $퍁->params[2]; $endColor = $퍁->params[1]; $startColor = $퍁->params[0];
		{
			$m2data = $data;
		}break;
		case 1:
		$data2 = $퍁->params[1]; $fill = $퍁->params[0];
		{
			$m2data = $data2;
		}break;
		}
		$this->o->writeUInt16($m2data->startWidth);
		$this->o->writeUInt16($m2data->endWidth);
		$this->bits->writeBits(2, eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁2 = (\$m2data->startCapStyle);
			switch(\$퍁2->index) {
			case 0:
			{
				\$팿 = 0;
			}break;
			case 1:
			{
				\$팿 = 1;
			}break;
			case 2:
			{
				\$팿 = 2;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		"));
		$this->bits->writeBits(2, eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁3 = (\$m2data->joinStyle);
			switch(\$퍁3->index) {
			case 0:
			{
				\$팿2 = 0;
			}break;
			case 1:
			{
				\$팿2 = 1;
			}break;
			case 2:
			\$limitFactor = \$퍁3->params[0];
			{
				\$팿2 = 2;
			}break;
			default:{
				\$팿2 = null;
			}break;
			}
			return \$팿2;
		"));
		$퍁4 = ($style);
		switch($퍁4->index) {
		case 0:
		$data3 = $퍁4->params[2]; $endColor2 = $퍁4->params[1]; $startColor2 = $퍁4->params[0];
		{
			$this->bits->writeBit(false);
		}break;
		case 1:
		$data4 = $퍁4->params[1]; $fill2 = $퍁4->params[0];
		{
			$this->bits->writeBit(true);
		}break;
		}
		$this->bits->writeBit($m2data->noHScale);
		$this->bits->writeBit($m2data->noVScale);
		$this->bits->writeBit($m2data->pixelHinting);
		$this->bits->writeBits(5, 0);
		$this->bits->writeBit($m2data->noClose);
		$this->bits->writeBits(2, eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁5 = (\$m2data->endCapStyle);
			switch(\$퍁5->index) {
			case 0:
			{
				\$팿3 = 0;
			}break;
			case 1:
			{
				\$팿3 = 1;
			}break;
			case 2:
			{
				\$팿3 = 2;
			}break;
			default:{
				\$팿3 = null;
			}break;
			}
			return \$팿3;
		"));
		$퍁6 = ($m2data->joinStyle);
		switch($퍁6->index) {
		case 2:
		$limitFactor2 = $퍁6->params[0];
		{
			$this->o->writeUInt16($limitFactor2);
		}break;
		default:{
			;
		}break;
		}
		$퍁7 = ($style);
		switch($퍁7->index) {
		case 0:
		$data5 = $퍁7->params[2]; $endColor3 = $퍁7->params[1]; $startColor3 = $퍁7->params[0];
		{
			$this->writeRGBA($startColor3);
			$this->writeRGBA($endColor3);
		}break;
		case 1:
		$data6 = $퍁7->params[1]; $fill3 = $퍁7->params[0];
		{
			$this->writeMorphFillStyle(2, $fill3);
		}break;
		}
	}
	public function writeMorph2LineStyles($line_styles) {
		$num_styles = $line_styles->length;
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		if($num_styles > 254) {
			$this->o->writeByte(255);
			$this->o->writeUInt16($num_styles);
		}
		else {
			$this->o->writeByte($num_styles);
		}
		{
			$_g2 = 0;
			while($_g2 < $line_styles->length) {
				$style = $line_styles[$_g2];
				++$_g2;
				$this->writeMorph2LineStyle($style);
				unset($style);
			}
		}
	}
	public function writeMorphShape($id, $data) {
		$old = $this->openTMP();
		$this->o->writeUInt16($id);
		$퍁 = ($data);
		switch($퍁->index) {
		case 0:
		$sh1data = $퍁->params[0];
		{
			$this->writeRect($sh1data->startBounds);
			$this->writeRect($sh1data->endBounds);
			$old1 = $this->openTMP();
			$this->writeMorphFillStyles(1, $sh1data->fillStyles);
			$this->writeMorph1LineStyles($sh1data->lineStyles);
			$this->writeShapeWithoutStyle(3, $sh1data->startEdges);
			{
				$_g = $this->bits;
				if($_g->nbits > 0) {
					$_g->writeBits(8 - $_g->nbits, 0);
					$_g->nbits = 0;
				}
			}
			$part_data = $this->closeTMP($old1);
			$this->o->writeUInt30($part_data->length);
			$this->o->write($part_data);
			$this->writeShapeWithoutStyle(3, $sh1data->endEdges);
		}break;
		case 1:
		$sh2data = $퍁->params[0];
		{
			$this->writeRect($sh2data->startBounds);
			$this->writeRect($sh2data->endBounds);
			$this->writeRect($sh2data->startEdgeBounds);
			$this->writeRect($sh2data->endEdgeBounds);
			$this->bits->writeBits(6, 0);
			$this->bits->writeBit($sh2data->useNonScalingStrokes);
			$this->bits->writeBit($sh2data->useScalingStrokes);
			{
				$_g2 = $this->bits;
				if($_g2->nbits > 0) {
					$_g2->writeBits(8 - $_g2->nbits, 0);
					$_g2->nbits = 0;
				}
			}
			$old12 = $this->openTMP();
			$this->writeMorphFillStyles(1, $sh2data->fillStyles);
			$this->writeMorph2LineStyles($sh2data->lineStyles);
			$this->writeShapeWithoutStyle(4, $sh2data->startEdges);
			{
				$_g3 = $this->bits;
				if($_g3->nbits > 0) {
					$_g3->writeBits(8 - $_g3->nbits, 0);
					$_g3->nbits = 0;
				}
			}
			$part_data2 = $this->closeTMP($old12);
			$this->o->writeUInt30($part_data2->length);
			$this->o->write($part_data2);
			$this->writeShapeWithoutStyle(4, $sh2data->endEdges);
		}break;
		}
		{
			$_g4 = $this->bits;
			if($_g4->nbits > 0) {
				$_g4->writeBits(8 - $_g4->nbits, 0);
				$_g4->nbits = 0;
			}
		}
		$morph_shape_data = $this->closeTMP($old);
		$퍁2 = ($data);
		switch($퍁2->index) {
		case 0:
		$sh1data2 = $퍁2->params[0];
		{
			$this->writeTID(46, $morph_shape_data->length);
		}break;
		case 1:
		$sh2data2 = $퍁2->params[0];
		{
			$this->writeTID(84, $morph_shape_data->length);
		}break;
		}
		$this->o->write($morph_shape_data);
	}
	public function writeFontGlyphs($glyphs) {
		$old = $this->openTMP();
		$offsets = new _hx_array(array());
		$offs = 0;
		{
			$_g = 0;
			while($_g < $glyphs->length) {
				$shape = $glyphs[$_g];
				++$_g;
				$offsets->push($offs);
				$old1 = $this->openTMP();
				$this->writeShapeWithoutStyle(1, $shape);
				{
					$_g1 = $this->bits;
					if($_g1->nbits > 0) {
						$_g1->writeBits(8 - $_g1->nbits, 0);
						$_g1->nbits = 0;
					}
				}
				$shape_data = $this->closeTMP($old1);
				$this->o->write($shape_data);
				$offs += $shape_data->length;
				unset($shape_data,$shape,$old1,$_g1);
			}
		}
		$glyph_data = $this->closeTMP($old);
		$this->o->write($glyph_data);
		return $offsets;
	}
	public function writeFont1($data) {
		$old = $this->openTMP();
		$offset_table = $this->writeFontGlyphs($data->glyphs);
		if($offset_table->length * 2 + $offset_table[$offset_table->length - 1] > 65535) {
			throw new HException("Font version 1 only supports font sizes up to 64kB!");
		}
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		$shape_data = $this->closeTMP($old);
		$first_glyph_offset = $offset_table->length * 2;
		{
			$_g2 = 0;
			while($_g2 < $offset_table->length) {
				$offset = $offset_table[$_g2];
				++$_g2;
				$this->o->writeUInt16($first_glyph_offset + $offset);
				unset($offset);
			}
		}
		$this->o->write($shape_data);
	}
	public function writeFont2($hasWideChars, $data) {
		$glyphs = new _hx_array(array());
		$num_glyphs = $data->glyphs->length;
		{
			$_g = 0; $_g1 = $data->glyphs;
			while($_g < $_g1->length) {
				$glyph = $_g1[$_g];
				++$_g;
				$glyphs->push($glyph->shape);
				unset($glyph);
			}
		}
		$old = $this->openTMP();
		$offset_table = $this->writeFontGlyphs($glyphs);
		{
			$_g2 = $this->bits;
			if($_g2->nbits > 0) {
				$_g2->writeBits(8 - $_g2->nbits, 0);
				$_g2->nbits = 0;
			}
		}
		$shape_data = $this->closeTMP($old);
		$hasWideOffsets = $offset_table->length * 2 + 2 + $shape_data->length > 65535;
		$this->bits->writeBit(_hx_field($data, "layout") !== null);
		$this->bits->writeBit($data->shiftJIS);
		$this->bits->writeBit($data->isSmall);
		$this->bits->writeBit($data->isANSI);
		$this->bits->writeBit($hasWideOffsets);
		$this->bits->writeBit($hasWideChars);
		$this->bits->writeBit($data->isItalic);
		$this->bits->writeBit($data->isBold);
		{
			$_g3 = $this->bits;
			if($_g3->nbits > 0) {
				$_g3->writeBits(8 - $_g3->nbits, 0);
				$_g3->nbits = 0;
			}
		}
		$this->o->writeByte(eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁 = (\$data->language);
			switch(\$퍁->index) {
			case 0:
			{
				\$팿 = 0;
			}break;
			case 1:
			{
				\$팿 = 1;
			}break;
			case 2:
			{
				\$팿 = 2;
			}break;
			case 3:
			{
				\$팿 = 3;
			}break;
			case 4:
			{
				\$팿 = 4;
			}break;
			case 5:
			{
				\$팿 = 5;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		"));
		$this->o->writeByte(strlen($data->name));
		$this->o->writeString($data->name);
		$this->o->writeUInt16($num_glyphs);
		if($hasWideOffsets) {
			$first_glyph_offset = $num_glyphs * 4 + 4;
			{
				$_g4 = 0;
				while($_g4 < $offset_table->length) {
					$offset = $offset_table[$_g4];
					++$_g4;
					$this->o->writeUInt30($first_glyph_offset + $offset);
					unset($offset);
				}
			}
			$this->o->writeUInt30($first_glyph_offset + $shape_data->length);
		}
		else {
			$first_glyph_offset2 = $num_glyphs * 2 + 2;
			{
				$_g5 = 0;
				while($_g5 < $offset_table->length) {
					$offset2 = $offset_table[$_g5];
					++$_g5;
					$this->o->writeUInt16($first_glyph_offset2 + $offset2);
					unset($offset2);
				}
			}
			$this->o->writeUInt16($first_glyph_offset2 + $shape_data->length);
		}
		$this->o->write($shape_data);
		if($hasWideChars) {
			{
				$_g6 = 0; $_g12 = $data->glyphs;
				while($_g6 < $_g12->length) {
					$glyph2 = $_g12[$_g6];
					++$_g6;
					$this->o->writeUInt16($glyph2->charCode);
					unset($glyph2);
				}
			}
		}
		else {
			{
				$_g7 = 0; $_g13 = $data->glyphs;
				while($_g7 < $_g13->length) {
					$glyph3 = $_g13[$_g7];
					++$_g7;
					$this->o->writeByte($glyph3->charCode);
					unset($glyph3);
				}
			}
		}
		if(_hx_field($data, "layout") !== null) {
			$this->o->writeInt16($data->layout->ascent);
			$this->o->writeInt16($data->layout->descent);
			$this->o->writeInt16($data->layout->leading);
			{
				$_g8 = 0; $_g14 = $data->layout->glyphs;
				while($_g8 < $_g14->length) {
					$g = $_g14[$_g8];
					++$_g8;
					$this->o->writeInt16($g->advance);
					unset($g);
				}
			}
			{
				$_g9 = 0; $_g15 = $data->layout->glyphs;
				while($_g9 < $_g15->length) {
					$g2 = $_g15[$_g9];
					++$_g9;
					$this->writeRect($g2->bounds);
					unset($g2);
				}
			}
			$this->o->writeUInt16($data->layout->kerning->length);
			if($hasWideChars) {
				{
					$_g10 = 0; $_g16 = $data->layout->kerning;
					while($_g10 < $_g16->length) {
						$k = $_g16[$_g10];
						++$_g10;
						$this->o->writeUInt16($k->charCode1);
						$this->o->writeUInt16($k->charCode2);
						$this->o->writeInt16($k->adjust);
						unset($k);
					}
				}
			}
			else {
				{
					$_g11 = 0; $_g17 = $data->layout->kerning;
					while($_g11 < $_g17->length) {
						$k2 = $_g17[$_g11];
						++$_g11;
						$this->o->writeByte($k2->charCode1);
						$this->o->writeByte($k2->charCode2);
						$this->o->writeInt16($k2->adjust);
						unset($k2);
					}
				}
			}
		}
	}
	public function writeFont($id, $data) {
		$old = $this->openTMP();
		$this->o->writeUInt16($id);
		$퍁 = ($data);
		switch($퍁->index) {
		case 0:
		$data1 = $퍁->params[0];
		{
			$this->writeFont1($data1);
		}break;
		case 1:
		$data12 = $퍁->params[1]; $hasWideChars = $퍁->params[0];
		{
			$this->writeFont2($hasWideChars, $data12);
		}break;
		case 2:
		$data13 = $퍁->params[0];
		{
			$this->writeFont2(true, $data13);
		}break;
		}
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		$font_data = $this->closeTMP($old);
		$퍁2 = ($data);
		switch($퍁2->index) {
		case 0:
		$data14 = $퍁2->params[0];
		{
			$this->writeTID(10, $font_data->length);
		}break;
		case 1:
		$data15 = $퍁2->params[1]; $hasWideChars2 = $퍁2->params[0];
		{
			$this->writeTID(48, $font_data->length);
		}break;
		case 2:
		$data16 = $퍁2->params[0];
		{
			$this->writeTID(75, $font_data->length);
		}break;
		}
		$this->o->write($font_data);
	}
	public function writeFontInfo($id, $data) {
		$퍁 = ($data);
		switch($퍁->index) {
		case 0:
		$data1 = $퍁->params[3]; $hasWideCodes = $퍁->params[2]; $isANSI = $퍁->params[1]; $shiftJIS = $퍁->params[0];
		{
			$data_length = ($hasWideCodes ? 4 + strlen($data1->name) + $data1->codeTable->length * 2 : 4 + strlen($data1->name) + $data1->codeTable->length);
			$this->writeTID(13, $data_length);
			$this->o->writeUInt16($id);
			$this->o->writeByte(strlen($data1->name));
			$this->o->writeString($data1->name);
			$this->bits->writeBits(2, 0);
			$this->bits->writeBit($data1->isSmall);
			$this->bits->writeBit($shiftJIS);
			$this->bits->writeBit($isANSI);
			$this->bits->writeBit($data1->isItalic);
			$this->bits->writeBit($data1->isBold);
			$this->bits->writeBit($hasWideCodes);
			if($hasWideCodes) {
				{
					$_g = 0; $_g1 = $data1->codeTable;
					while($_g < $_g1->length) {
						$code = $_g1[$_g];
						++$_g;
						$this->o->writeUInt16($code);
						unset($code);
					}
				}
			}
			else {
				{
					$_g2 = 0; $_g12 = $data1->codeTable;
					while($_g2 < $_g12->length) {
						$code2 = $_g12[$_g2];
						++$_g2;
						$this->o->writeByte($code2);
						unset($code2);
					}
				}
			}
		}break;
		case 1:
		$data12 = $퍁->params[1]; $language = $퍁->params[0];
		{
			$this->writeTID(13, 5 + strlen($data12->name) + $data12->codeTable->length * 2);
			$this->o->writeUInt16($id);
			$this->o->writeByte(strlen($data12->name));
			$this->o->writeString($data12->name);
			$this->bits->writeBits(2, 0);
			$this->bits->writeBit($data12->isSmall);
			$this->bits->writeBit(false);
			$this->bits->writeBit(false);
			$this->bits->writeBit($data12->isItalic);
			$this->bits->writeBit($data12->isBold);
			$this->bits->writeBit(true);
			$this->o->writeByte(eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁2 = (\$language);
				switch(\$퍁2->index) {
				case 0:
				{
					\$팿 = 0;
				}break;
				case 1:
				{
					\$팿 = 1;
				}break;
				case 2:
				{
					\$팿 = 2;
				}break;
				case 3:
				{
					\$팿 = 3;
				}break;
				case 4:
				{
					\$팿 = 4;
				}break;
				case 5:
				{
					\$팿 = 5;
				}break;
				default:{
					\$팿 = null;
				}break;
				}
				return \$팿;
			"));
			{
				$_g3 = 0; $_g13 = $data12->codeTable;
				while($_g3 < $_g13->length) {
					$code3 = $_g13[$_g3];
					++$_g3;
					$this->o->writeUInt16($code3);
					unset($code3);
				}
			}
		}break;
		}
	}
	public function writeSoundInfo($info) {
		$this->bits->writeBits(2, 0);
		$this->bits->writeBit($info->syncStop);
		$this->bits->writeBit(false);
		$this->bits->writeBit(false);
		$this->bits->writeBit($info->hasLoops);
		$this->bits->writeBit(false);
		$this->bits->writeBit(false);
		if($info->hasLoops) {
			$this->o->writeUInt16($info->loopCount);
		}
	}
	public function writeEnvelopeRecords($soundEnvelopes) {
		$_g1 = 0; $_g = $soundEnvelopes->length;
		while($_g1 < $_g) {
			$env = $_g1++;
			$this->o->writeUInt30(_hx_array_get($soundEnvelopes, $env)->pos44);
			$this->o->writeUInt16(_hx_array_get($soundEnvelopes, $env)->leftLevel);
			$this->o->writeUInt16(_hx_array_get($soundEnvelopes, $env)->rightLevel);
			unset($env);
		}
	}
	public function writeFileAttributes($att) {
		$this->bits->writeBit(false);
		$this->bits->writeBit($att->useDirectBlit);
		$this->bits->writeBit($att->useGPU);
		$this->bits->writeBit($att->hasMetaData);
		$this->bits->writeBit($att->actionscript3);
		$this->bits->writeBits(2, 0);
		$this->bits->writeBit($att->useNetWork);
		$this->bits->writeBits(24, 0);
	}
	public function writeButtonRecord($btnRec) {
		$this->bits->writeBits(4, 0);
		$this->bits->writeBit($btnRec->hit);
		$this->bits->writeBit($btnRec->down);
		$this->bits->writeBit($btnRec->over);
		$this->bits->writeBit($btnRec->up);
		$this->o->writeUInt16($btnRec->id);
		$this->o->writeUInt16($btnRec->depth);
		$this->writeMatrix($btnRec->matrix);
		$this->o->writeByte(0);
	}
	public function writeDefineEditText($data) {
		$this->writeRect($data->bounds);
		$this->bits->writeBit($data->hasText);
		$this->bits->writeBit($data->wordWrap);
		$this->bits->writeBit($data->multiline);
		$this->bits->writeBit($data->password);
		$this->bits->writeBit($data->input);
		$this->bits->writeBit($data->hasTextColor);
		$this->bits->writeBit($data->hasMaxLength);
		$this->bits->writeBit($data->hasFont);
		$this->bits->writeBit($data->hasFontClass);
		$this->bits->writeBit($data->autoSize);
		$this->bits->writeBit($data->hasLayout);
		$this->bits->writeBit($data->selectable);
		$this->bits->writeBit($data->border);
		$this->bits->writeBit($data->wasStatic);
		$this->bits->writeBit($data->html);
		$this->bits->writeBit($data->useOutlines);
		if($data->hasFont) {
			$this->o->writeUInt16($data->fontID);
		}
		if($data->hasFontClass) {
			$this->o->writeString($data->fontClass);
		}
		$this->o->writeUInt16($data->fontHeight);
		if($data->hasTextColor) {
			$this->writeRGBA($data->textColor);
		}
		if($data->hasMaxLength) {
			$this->o->writeUInt16($data->maxLength);
		}
		if($data->hasLayout) {
			$this->o->writeByte($data->align);
			$this->o->writeUInt16($data->leftMargin);
			$this->o->writeUInt16($data->rightMargin);
			$this->o->writeUInt16($data->indent);
			$this->o->writeInt16($data->leading);
		}
		$this->o->writeString($data->variableName);
		$this->o->writeByte(0);
		if($data->hasText) {
			$this->o->writeString($data->initialText);
		}
		$this->o->writeByte(0);
	}
	public function writeTag($t) {
		$퍁 = ($t);
		switch($퍁->index) {
		case 30:
		$data = $퍁->params[1]; $id = $퍁->params[0];
		{
			if($id === null) {
				$this->o->write($data);
			}
			else {
				$this->writeTID($id, $data->length);
				$this->o->write($data);
			}
		}break;
		case 0:
		{
			$this->writeTID(1, 0);
		}break;
		case 1:
		{
			$this->writeTID(0, 0);
		}break;
		case 2:
		$sdata = $퍁->params[1]; $id2 = $퍁->params[0];
		{
			$this->writeShape($id2, $sdata);
		}break;
		case 3:
		$data2 = $퍁->params[1]; $id3 = $퍁->params[0];
		{
			$this->writeMorphShape($id3, $data2);
		}break;
		case 4:
		$data3 = $퍁->params[1]; $id4 = $퍁->params[0];
		{
			$this->writeFont($id4, $data3);
		}break;
		case 5:
		$data4 = $퍁->params[1]; $id5 = $퍁->params[0];
		{
			$this->writeFontInfo($id5, $data4);
		}break;
		case 21:
		$data5 = $퍁->params[1]; $id6 = $퍁->params[0];
		{
			$this->writeTID(87, $data5->length + 6);
			$this->o->writeUInt16($id6);
			$this->o->writeUInt30(0);
			$this->o->write($data5);
		}break;
		case 6:
		$color = $퍁->params[0];
		{
			$this->writeTID(9, 3);
			$this->o->writeByte(($color & 16711680) >> 16);
			$this->o->writeByte(($color & 65280) >> 8);
			$this->o->writeByte($color & 255);
		}break;
		case 8:
		$po = $퍁->params[0];
		{
			$t1 = $this->openTMP();
			$this->writePlaceObject($po, false);
			$bytes = $this->closeTMP($t1);
			$this->writeTID(26, $bytes->length);
			$this->o->write($bytes);
		}break;
		case 9:
		$po2 = $퍁->params[0];
		{
			$t12 = $this->openTMP();
			$this->writePlaceObject($po2, true);
			$bytes2 = $this->closeTMP($t12);
			$this->writeTID(70, $bytes2->length);
			$this->o->write($bytes2);
		}break;
		case 10:
		$depth = $퍁->params[0];
		{
			$this->writeTID(28, 2);
			$this->o->writeUInt16($depth);
		}break;
		case 11:
		$anchor = $퍁->params[1]; $label = $퍁->params[0];
		{
			$length = strlen($label) + 1 + (($anchor ? 1 : 0));
			$this->writeTIDExt(43, $length);
			$this->o->writeString($label);
			$this->o->writeByte(0);
			if($anchor) {
				$this->o->writeByte(1);
			}
		}break;
		case 7:
		$tags = $퍁->params[2]; $frames = $퍁->params[1]; $id7 = $퍁->params[0];
		{
			$t13 = $this->openTMP();
			{
				$_g = 0;
				while($_g < $tags->length) {
					$t2 = $tags[$_g];
					++$_g;
					$this->writeTag($t2);
					unset($t2);
				}
			}
			$bytes3 = $this->closeTMP($t13);
			$this->writeTIDExt(39, $bytes3->length + 6);
			$this->o->writeUInt16($id7);
			$this->o->writeUInt16($frames);
			$this->o->write($bytes3);
			$this->o->writeUInt16(0);
		}break;
		case 12:
		$data6 = $퍁->params[1]; $id8 = $퍁->params[0];
		{
			$this->writeTID(59, $data6->length + 2);
			$this->o->writeUInt16($id8);
			$this->o->write($data6);
		}break;
		case 13:
		$ctx = $퍁->params[1]; $data7 = $퍁->params[0];
		{
			if($ctx === null) {
				$this->writeTID(72, $data7->length);
			}
			else {
				$len = $data7->length + 4 + strlen($ctx->label) + 1;
				$this->writeTID(82, $len);
				$this->o->writeUInt30($ctx->id);
				$this->o->writeString($ctx->label);
				$this->o->writeByte(0);
			}
			$this->o->write($data7);
		}break;
		case 14:
		$sl = $퍁->params[0];
		{
			$this->writeSymbols($sl, 76);
		}break;
		case 15:
		$sl2 = $퍁->params[0];
		{
			$this->writeSymbols($sl2, 56);
		}break;
		case 16:
		$v = $퍁->params[0];
		{
			$this->writeTID(69, 4);
			$this->writeFileAttributes($v);
		}break;
		case 17:
		$l = $퍁->params[0];
		{
			$cbits = eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁2 = (\$l->color);
				switch(\$퍁2->index) {
				case 0:
				\$n = \$퍁2->params[0];
				{
					\$팿 = \$n;
				}break;
				default:{
					\$팿 = null;
				}break;
				}
				return \$팿;
			");
			$this->writeTIDExt(20, $l->data->length + ((($cbits === null) ? 8 : 7)));
			$this->o->writeUInt16($l->cid);
			$퍁3 = ($l->color);
			switch($퍁3->index) {
			case 0:
			{
				$this->o->writeByte(3);
			}break;
			case 1:
			{
				$this->o->writeByte(4);
			}break;
			case 2:
			{
				$this->o->writeByte(5);
			}break;
			default:{
				throw new HException("assert");
			}break;
			}
			$this->o->writeUInt16($l->width);
			$this->o->writeUInt16($l->height);
			if($cbits !== null) {
				$this->o->writeByte($cbits);
			}
			$this->o->write($l->data);
		}break;
		case 18:
		$l2 = $퍁->params[0];
		{
			$cbits2 = eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁4 = (\$l2->color);
				switch(\$퍁4->index) {
				case 0:
				\$n2 = \$퍁4->params[0];
				{
					\$팿2 = \$n2;
				}break;
				default:{
					\$팿2 = null;
				}break;
				}
				return \$팿2;
			");
			$this->writeTIDExt(36, $l2->data->length + ((($cbits2 === null) ? 7 : 8)));
			$this->o->writeUInt16($l2->cid);
			$퍁5 = ($l2->color);
			switch($퍁5->index) {
			case 0:
			{
				$this->o->writeByte(3);
			}break;
			case 1:
			{
				$this->o->writeByte(4);
			}break;
			case 3:
			{
				$this->o->writeByte(5);
			}break;
			default:{
				throw new HException("assert");
			}break;
			}
			$this->o->writeUInt16($l2->width);
			$this->o->writeUInt16($l2->height);
			if($cbits2 !== null) {
				$this->o->writeByte($cbits2);
			}
			$this->o->write($l2->data);
		}break;
		case 20:
		$data8 = $퍁->params[0];
		{
			$this->writeTIDExt(8, $data8->length);
			$this->o->write($data8);
		}break;
		case 19:
		$jdata = $퍁->params[1]; $id9 = $퍁->params[0];
		{
			$퍁6 = ($jdata);
			switch($퍁6->index) {
			case 0:
			$data9 = $퍁6->params[0];
			{
				$this->writeTIDExt(6, $data9->length + 2);
				$this->o->writeUInt16($id9);
				$this->o->write($data9);
			}break;
			case 1:
			$data10 = $퍁6->params[0];
			{
				$this->writeTIDExt(21, $data10->length + 2);
				$this->o->writeUInt16($id9);
				$this->o->write($data10);
			}break;
			case 2:
			$mask = $퍁6->params[1]; $data11 = $퍁6->params[0];
			{
				$this->writeTIDExt(35, $data11->length + $mask->length + 6);
				$this->o->writeUInt16($id9);
				$this->o->writeUInt30($data11->length);
				$this->o->write($data11);
				$this->o->write($mask);
			}break;
			}
		}break;
		case 22:
		$data12 = $퍁->params[0];
		{
			$this->writeSound($data12);
		}break;
		case 23:
		$soundInfo = $퍁->params[1]; $id10 = $퍁->params[0];
		{
			if($soundInfo->hasLoops) {
				$this->writeTID(15, 5);
			}
			else {
				$this->writeTID(15, 3);
			}
			$this->o->writeUInt16($id10);
			$this->writeSoundInfo($soundInfo);
		}break;
		case 24:
		$data13 = $퍁->params[0];
		{
			$this->writeTID(12, $data13->length);
			$this->o->write($data13);
		}break;
		case 25:
		$timeoutseconds = $퍁->params[1]; $maxRecursion = $퍁->params[0];
		{
			$this->writeTID(65, 4);
			$this->o->writeUInt16($maxRecursion);
			$this->o->writeUInt16($timeoutseconds);
		}break;
		case 26:
		$buttonRecords = $퍁->params[1]; $id11 = $퍁->params[0];
		{
			$t14 = $this->openTMP();
			{
				$_g2 = 0;
				while($_g2 < $buttonRecords->length) {
					$t22 = $buttonRecords[$_g2];
					++$_g2;
					$this->writeButtonRecord($t22);
					unset($t22);
				}
			}
			$bytes4 = $this->closeTMP($t14);
			$this->writeTID(34, $bytes4->length + 6);
			$this->o->writeUInt16($id11);
			$this->o->writeByte(0);
			$this->o->writeUInt16(0);
			$this->o->write($bytes4);
			$this->o->writeByte(0);
		}break;
		case 27:
		$data14 = $퍁->params[1]; $id12 = $퍁->params[0];
		{
			$t15 = $this->openTMP();
			$this->writeDefineEditText($data14);
			$bytes5 = $this->closeTMP($t15);
			$this->writeTID(37, $bytes5->length + 2);
			$this->o->writeUInt16($id12);
			$this->o->write($bytes5);
		}break;
		case 28:
		$data15 = $퍁->params[0];
		{
			$this->writeTID(77, strlen($data15) + 1);
			$this->o->writeString($data15);
			$this->o->writeByte(0);
		}break;
		case 29:
		$splitter = $퍁->params[1]; $id13 = $퍁->params[0];
		{
			$t16 = $this->openTMP();
			$this->writeRect($splitter);
			$bytes6 = $this->closeTMP($t16);
			$this->writeTID(78, $bytes6->length + 2);
			$this->o->writeUInt16($id13);
			$this->o->write($bytes6);
		}break;
		}
	}
	public function writeEnd() {
		$this->o->writeUInt16(0);
		$bytes = $this->o->getBytes();
		$size = $bytes->length;
		if($this->compressed) {
			$bytes = format_tools_Deflate::run($bytes);
		}
		$this->output->writeUInt30($size + 8);
		$this->output->write($bytes);
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->팪ynamics[$m]) && is_callable($this->팪ynamics[$m]))
			return call_user_func_array($this->팪ynamics[$m], $a);
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	function __toString() { return 'format.swf.Writer'; }
}
