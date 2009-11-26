#ifndef INCLUDED_format_abc_JumpStyle
#define INCLUDED_format_abc_JumpStyle

#include <hxObject.h>

DECLARE_CLASS2(format,abc,JumpStyle)
namespace format{
namespace abc{


class JumpStyle_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef JumpStyle_obj OBJ_;

	public:
		JumpStyle_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.abc.JumpStyle",20); }
		String __ToString() const { return STRING(L"JumpStyle.",10) + tag; }

		static JumpStyle JAlways;
		static JumpStyle JEq;
		static JumpStyle JFalse;
		static JumpStyle JGt;
		static JumpStyle JGte;
		static JumpStyle JLt;
		static JumpStyle JLte;
		static JumpStyle JNeq;
		static JumpStyle JNotGt;
		static JumpStyle JNotGte;
		static JumpStyle JNotLt;
		static JumpStyle JNotLte;
		static JumpStyle JPhysEq;
		static JumpStyle JPhysNeq;
		static JumpStyle JTrue;
};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_JumpStyle */ 
