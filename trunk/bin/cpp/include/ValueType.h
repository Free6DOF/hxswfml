#ifndef INCLUDED_ValueType
#define INCLUDED_ValueType

#include <hxObject.h>

DECLARE_CLASS0(ValueType)


class ValueType_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef ValueType_obj OBJ_;

	public:
		ValueType_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"ValueType",9); }
		String __ToString() const { return STRING(L"ValueType.",10) + tag; }

		static ValueType TBool;
		static ValueType TClass(Class c);
		static Dynamic TClass_dyn();
		static ValueType TEnum(Enum e);
		static Dynamic TEnum_dyn();
		static ValueType TFloat;
		static ValueType TFunction;
		static ValueType TInt;
		static ValueType TNull;
		static ValueType TObject;
		static ValueType TUnknown;
};


#endif /* INCLUDED_ValueType */ 
