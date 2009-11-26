#ifndef INCLUDED_format_tools__InflateImpl_State
#define INCLUDED_format_tools__InflateImpl_State

#include <hxObject.h>

DECLARE_CLASS3(format,tools,_InflateImpl,State)
namespace format{
namespace tools{
namespace _InflateImpl{


class State_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef State_obj OBJ_;

	public:
		State_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.tools._InflateImpl.State",31); }
		String __ToString() const { return STRING(L"State.",6) + tag; }

		static State Block;
		static State CData;
		static State Crc;
		static State Dist;
		static State DistOne;
		static State Done;
		static State Flat;
		static State Head;
};

} // end namespace format
} // end namespace tools
} // end namespace _InflateImpl

#endif /* INCLUDED_format_tools__InflateImpl_State */ 
