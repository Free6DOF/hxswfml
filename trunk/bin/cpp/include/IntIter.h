#ifndef INCLUDED_IntIter
#define INCLUDED_IntIter

#include <hxObject.h>

DECLARE_CLASS0(IntIter)


class IntIter_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef IntIter_obj OBJ_;

	protected:
		IntIter_obj();
		Void __construct(int min,int max);

	public:
		static hxObjectPtr<IntIter_obj > __new(int min,int max);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~IntIter_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"IntIter",7); }

		int min;
		int max;
		virtual bool hasNext( );
		Dynamic hasNext_dyn();

		virtual int next( );
		Dynamic next_dyn();

};


#endif /* INCLUDED_IntIter */ 
