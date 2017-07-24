<?php

namespace JaSC;

use UniCAT\ClassScope;
use UniCAT\MethodScope;

/**
 * @package VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2017 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * generation of code fragments with fluent interface
 * 
 * @method $this Set_ExportWay(string $ExportWay) sets how code will be exported/see trait CodeExport in VMaX-UniCAT
 * @method $this Set_Comment(string $Text, string $Position) sets comment and its position/see trait Comments in VMaX-UniCAT
 *
 * @method $this Set_Name(string $Name) sets any string that is not in list of supported constructions, operators and so on; description for this function is in function Get_AvailableMethods
 * @method $this Set_Value(string $Value) sets any string that is not in list of supported constructions, operators and so on; description for this function is in function Get_AvailableMethods
 * @method $this Set_Part(string $Part) sets any string that is not in list of supported constructions, operators and so on; description for this function is in function Get_AvailableMethods
 * 
 * @method $this Set_For() adds keyword for into created code
 * @method $this Set_While() adds keyword while into created code
 * @method $this Set_Do() adds keyword do into created code
 * @method $this Set_If() adds keyword if into created code
 * @method $this Set_Else() adds keyword else into created code
 * @method $this Set_Elseif() adds keyword else into created code
 * @method $this Set_Switch() adds keyword switch into created code
 * @method $this Set_Case() adds keyword case into created code
 * @method $this Set_Default() adds keyword default into created code
 * @method $this Set_Break() adds keyword break into created code
 * @method $this Set_Continue() adds keyword continue into created code
 * @method $this Set_Try() adds keyword try into created code
 * @method $this Set_Catch() adds keyword catch into created code
 * @method $this Set_Finally() adds keyword finally into created code
 * @method $this Set_Function() adds keyword function into created code
 * @method $this Set_Instof() adds keyword instanceof into created code
 * @method $this Set_In() adds keyword in into created code
 * @method $this Set_New() adds keyword new into created code
 * @method $this Set_Var() adds keyword var into created code
 * 
 * @method $this Set_Plus1() adds + into created code (wrapped in spaces - for expressions)
 * @method $this Set_Plus2() adds ++ for into created code (wrapped in spaces - for expressions)
 * @method $this Set_Minus1() adds - into created code
 * @method $this Set_Minus2() adds -- into created code
 * @method $this Set_Plusequal() adds += into created code
 * @method $this Set_Minusequal() adds -= into created code
 * @method $this Set_Equal1() adds = into created code
 * 
 * @method $this Set_Equal2() adds == into created code
 * @method $this Set_Equal3() adds === into created code
 * @method $this Set_Lt() adds < into created code
 * @method $this Set_Gt() adds > into created code
 * @method $this Set_Lte() adds <= into created code
 * @method $this Set_Gte() adds >= into created code
 * @method $this Set_And2() adds && into created code
 * @method $this Set_Or2() adds || into created code
 * @method $this Set_Notequal1() adds != into created code
 * @method $this Set_Notequal2() adds !== into created code
 * 
 * @method $this Set_Cmnbrkts() adds common brackets (%s) into created code
 * @method $this Set_Sqrbrkts() adds square brackets [%s] into created code
 * @method $this Set_Brcs() adds braces {%s} into created code
 * @method $this Set_Smplqts() adds simple quotes/apostrophes '%s' into created code
 * @method $this Set_Dblqts() adds double quotes "%s" into created code
 * @method $this Set_Slshs() adds slashes /%s/ into created code
 * 
 * @method $this Set_Cmm() adds , into created code
 * @method $this Set_Dot() adds . into created code
 * @method $this Set_Spc() adds space \x20 into created code
 * @method $this Set_Or1() adds | into created code
 * 
 * @method $this Set_Nln() adds \n into created code
 * @method $this Set_Nlt() adds \n\t into created code
 * @method $this Set_Tab() adds \t into created code
 * 
 * @method $this Set_Hash() adds # into created code
 * @method $this Set_Dlr() adds $ into created code
 * @method $this Set_Plus() adds + into created code
 * @method $this Set_Smcln() adds ; into created code
 * @method $this Set_Cln() adds : into created code
 * @method $this Set_And1() adds & into created code
 * 
 * @method string Execute() executes code generation
 */
class FluentFragment
{

	/**
	 * object for class CodeGenerator
	 *
	 * @var object
	 */
	protected $FluentFragment;
	/**
	 * list of available functions;
	 * given by private function Get_AvailableMethods();
	 *
	 * @var array
	 */
	protected $Methods = array();
	/**
	 * mode of inserting of values (or else code parts) between "borders"
	 *
	 * @var string
	 */
	protected $InsertMode;

	/**
	 * sets insert mode - if text is inserted to "borders" (brackets, apostrophes, quotations or so) from the left or from the right side - or not inserted;
	 * RTLINS (RIGHT_TO_LEFT_INSERT) means that inserted text has to be placed after place where it will be inserted;
	 * LTRINS (LEFT_TO_RIGHT_INSERT) means that inserted text has to be placed before place where it will be inserted;
	 * NOINS (NO_INSERT) means that code will be written as is set;
	 * private statement enforces using of liquid interface of this class
	 *
	 * @param string $InsertMode direction of code inserting
	 *
	 * @throws Exception
	 *
	 * @example new CodeGenerator('NO_INSERT');
	 */
	protected function __construct($InsertMode)
	{
		$this -> Get_AvailableMethods();
		$this -> InsertMode = $InsertMode;

		/*
		 * option SKIP causes that code of this object will be only exported, without saving anywhere;
		 * see function Execute of CodeGenerator for details;
		 * use function Set_ExportWay to set else export way
		 */
		$this -> FluentFragment = new CodeGenerator($InsertMode);
		$this -> FluentFragment -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
	}

	/**
	 * calls selected public functions of class CodeGenerator in desired order
	 *
	 * @param string $Method function name
	 * @param array $Parameters parameters values - arguments
	 *
	 * @return JaSC\FluentFragment
	 */
	public function __call($Method, $Parameters)
	{
		try
		{
			if( $Method == 'Execute' )
			{
				return $this -> FluentFragment -> Execute();
			}
			elseif( in_array($Method, array_keys($this -> Methods)) && preg_match('/%s/', $this -> Methods[$Method][1]) )
			{
				$RealMethod = $this -> Methods[$Method][0];

				if( $this -> Methods[$Method][0] != 'Set_Value' )
				{
					if( $this -> InsertMode == Core::JASC_MODE_RTLINS )
					{
						$this -> FluentFragment -> $RealMethod($this -> Methods[$Method][1]);
						$this -> FluentFragment -> Set_Value(empty($Parameters) ? '' : $Parameters[0] );
					}
					else
					{
						$this -> FluentFragment -> Set_Value(empty($Parameters) ? '' : $Parameters[0] );
						$this -> FluentFragment -> $RealMethod($this -> Methods[$Method][1]);
					}
				}
				else
				{
					$this -> FluentFragment -> $RealMethod(empty($Parameters) ? '' : $Parameters[0] );
				}

				return $this;
			}
			elseif( in_array($Method, array_keys($this -> Methods)) && !preg_match('/%s/', $this -> Methods[$Method][1]) )
			{
				$RealMethod = $this -> Methods[$Method][0];

				if( empty($Parameters) )
				{
					$this -> FluentFragment -> $RealMethod($this -> Methods[$Method][1]);
					return $this;
				}
				elseif( count($Parameters) == 1 )
				{
					$this -> FluentFragment -> $RealMethod($Parameters[0]);
					return $this;
				}
				else
				{
					call_user_func_array(array( $this -> FluentFragment, $RealMethod ), $Parameters);
					return $this;
				}
			}
			else
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_SEC_FNC_NOSUPPORT);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), $Method);
		}
	}

	/**
	 * sets insert mode - if text is inserted to "borders" (brackets, apostrophes, quotations or so) from the left or from the right side - or not inserted;
	 * RTLINS (RIGHT_TO_LEFT_INSERT) means that inserted text has to be placed after place where it will be inserted;
	 * LTRINS (LEFT_TO_RIGHT_INSERT) means that inserted text has to be placed before place where it will be inserted;
	 * NOINS (NO_INSERT) means that code will be written as is set
	 *
	 * @param string $InsertMode direction of code inserting
	 *
	 * @return JaSC\FluentFragment
	 *
	 * @example InsertMode('NO_INSERT') to create code fragment as is
	 */
	public static function InsertMode($InsertMode = Core::JASC_MODE_NOINS)
	{
		try
		{
			if( !Core::Check_IsInsertMode($InsertMode) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				return new FluentFragment($InsertMode);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, $Exception -> Get_CallerFunctionName(), MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_InsertMode());
		}
	}

	/**
	 * creates list of functions usable for object of SimpleFragment;
	 * list of usable functions is based on names of constants given by interfaces, and extended of three another functions
	 */
	protected function Get_AvailableMethods()
	{
		/*
		 * these functions are identical;
		 * difference in name is only for purpose of "humanising";
		 * but you can use any of them without regard of this
		 */
		$this -> Methods['Set_Name'] = array( 'Set_Value', '%s' );
		$this -> Methods['Set_Value'] = array( 'Set_Value', '%s' );
		$this -> Methods['Set_Part'] = array( 'Set_Value', '%s' );
		/*
		 * these is mirror function for Set_ExportWay
		 */
		$this -> Methods['Set_ExportWay'] = array( 'Set_ExportWay', MethodScope::Get_ParameterDefaultValue('JaSC\CodeGenerator', 'Set_ExportWay') );
		/*
		 * this is mirror function for Set_Comment
		 */
		$this -> Methods['Set_Comment'] = array( 'Set_Comment', '', MethodScope::Get_ParameterDefaultValue('JaSC\CodeGenerator', 'Set_Comment', 1) );

		/*
		 * prepares set of supported functions
		 */
		foreach( ClassScope::Get_Interfaces('JaSC\I_JaSC_Union') as $Interface )
		{
			foreach( ClassScope::Get_ConstantsNames($Interface) as $Constant )
			{
				$this -> Methods['Set_'.ucfirst(strtolower(explode('_', $Constant)[2]))] = array( 'Set_'.implode('', str_split(explode('_', $Interface)[2])), ClassScope::Get_ConstantValue($Interface, $Constant) );
			}
		}
	}

}
