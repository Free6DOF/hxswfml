#ifndef INCLUDED_cpp_CppXml__
#define INCLUDED_cpp_CppXml__

#include <hxObject.h>

DECLARE_CLASS1(cpp,CppXml__)
namespace cpp{


class CppXml___obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef CppXml___obj OBJ_;

	protected:
		CppXml___obj();
		Void __construct();

	public:
		static hxObjectPtr<CppXml___obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~CppXml___obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		static void __init__();

		String __ToString() const { return STRING(L"CppXml__",8); }

		String _nodeName;
		String _nodeValue;
		Dynamic _attributes;
		Array<Dynamic > _children;
		cpp::CppXml__ _parent;
		String nodeType;
		String nodeName;
		String nodeValue;
		virtual String getNodeName( );
		Dynamic getNodeName_dyn();

		virtual String setNodeName( String n);
		Dynamic setNodeName_dyn();

		virtual String getNodeValue( );
		Dynamic getNodeValue_dyn();

		virtual String setNodeValue( String v);
		Dynamic setNodeValue_dyn();

		virtual cpp::CppXml__ getParent( );
		Dynamic getParent_dyn();

		virtual String get( String att);
		Dynamic get_dyn();

		virtual Void set( String att,String value);
		Dynamic set_dyn();

		virtual Void remove( String att);
		Dynamic remove_dyn();

		virtual bool exists( String att);
		Dynamic exists_dyn();

		virtual Dynamic attributes( );
		Dynamic attributes_dyn();

		virtual Dynamic iterator( );
		Dynamic iterator_dyn();

		virtual Dynamic elements( );
		Dynamic elements_dyn();

		virtual Dynamic elementsNamed( String $t1);
		Dynamic elementsNamed_dyn();

		virtual cpp::CppXml__ firstChild( );
		Dynamic firstChild_dyn();

		virtual cpp::CppXml__ firstElement( );
		Dynamic firstElement_dyn();

		virtual Void addChild( cpp::CppXml__ x_);
		Dynamic addChild_dyn();

		virtual bool removeChild( cpp::CppXml__ x_);
		Dynamic removeChild_dyn();

		virtual Void insertChild( cpp::CppXml__ x_,int pos);
		Dynamic insertChild_dyn();

		virtual String toString( );
		Dynamic toString_dyn();

		static String Element;
		static String PCData;
		static String CData;
		static String Comment;
		static String DocType;
		static String Prolog;
		static String Document;
		static Dynamic _parse;
	Dynamic &_parse_dyn() { return _parse;}
		static cpp::CppXml__ parse( String xmlData);
		static Dynamic parse_dyn();

		static cpp::CppXml__ createElement( String name);
		static Dynamic createElement_dyn();

		static cpp::CppXml__ createPCData( String data);
		static Dynamic createPCData_dyn();

		static cpp::CppXml__ createCData( String data);
		static Dynamic createCData_dyn();

		static cpp::CppXml__ createComment( String data);
		static Dynamic createComment_dyn();

		static cpp::CppXml__ createDocType( String data);
		static Dynamic createDocType_dyn();

		static cpp::CppXml__ createProlog( String data);
		static Dynamic createProlog_dyn();

		static cpp::CppXml__ createDocument( );
		static Dynamic createDocument_dyn();

};

} // end namespace cpp

#endif /* INCLUDED_cpp_CppXml__ */ 
