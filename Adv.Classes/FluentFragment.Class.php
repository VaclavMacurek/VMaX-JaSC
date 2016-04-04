<?php

namespace JaSC;

use UniCAT\UniCAT;
use UniCAT\ErrorOptions;
use UniCAT\ClassScope;
use UniCAT\MethodScope;

/**
 * @package VMaX-3GeCoS
 * @subpackage VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2016 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * generation of code fragments with fluent interface
 *
 * @method void Set_Name(string $Name) sets any string that is not in list of supported constructions, operators and so on; description for this function is in function Get_AvailableMethods
 * @method void Set_Value(string $Value) sets any string that is not in list of supported constructions, operators and so on; description for this function is in function Get_AvailableMethods
 * @method void Set_For() adds keyword for into created code
 * @method void Set_While() adds keyword while into created code
 * @method void Set_Do() adds keyword do into created code
 * @method void Set_If() adds keyword if into created code
 * @method void Set_Else() adds keyword else into created code
 * @method void Set_Switch() adds keyword switch into created code
 * @method void Set_Case() adds keyword case into created code
 * @method void Set_Default() adds keyword default into created code
 * @method void Set_Try() adds keyword try into created code
 * @method void Set_Catch() adds keyword catch into created code
 * @method void Set_Finally() adds keyword finally into created code
 * @method void Set_Function() adds keyword function into created code
 * @method void Set_Plus1() adds + into created code
 * @method void Set_Plus2() adds ++ for into created code
 * @method void Set_Minus1() adds - into created code
 * @method void Set_Minus2() adds -- into created code
 * @method void Set_PlusEqual() adds += into created code
 * @method void Set_MinusEqual() adds -= into created code
 * @method void Set_Equal1() adds = into created code
 * @method void Set_Equal2() adds == into created code
 * @method void Set_Equal3() adds === into created code
 * @method void Set_Lt() adds < into created code
 * @method void Set_Gt() adds > into created code
 * @method void Set_Lte() adds <= into created code
 * @method void Set_Gte() adds >= into created code
 * @method void Set_And1() adds & into created code
 * @method void Set_And2() adds && into created code
 * @method void Set_Notequal1() adds != into created code
 * @method void Set_Notequal2() adds !== into created code
 * @method void Set_Smcln() adds ; into created code
 * @method void Set_Cln() adds : into created code
 * @method void Set_Cmnbrkts() adds common brackets (%s) into created code
 * @method void Set_Sqrbrkts() adds square brackets [%s] into created code
 * @method void Set_Brcs() adds braces {%s} into created code
 * @method void Set_Smplqt() adds simple quotes/apostrophes '%s' into created code
 * @method void Set_Dblqt() adds double quotes "%s" into created code
 * @method void Set_Cmm() adds , into created code
 * @method void Set_Dot() adds . into created code
 * @method void Set_Spc() adds space \x20 into created code
 * @method void Set_Nln() adds \n into created code
 * @method void Set_Nlt() adds \n\t into created code
 * @method void Set_Instof() adds keyword instanceof into created code
 * @method void Set_In() adds keyword in into created code
 * @method void Set_New() adds keyword new into created code
 * @method void Set_Var() adds keyword var into created code
 * @method string Execute() executes code generation
 */
class FluentFragment
{
	use ErrorOptions;

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
	private $Methods = array();
	/**
	 * mode of inserting of values (or else code parts) between "borders"
	 *
	 * @var string
	 */
	private $InsertMode;

	/**
	 * sets insert mode - if text is inserted to "borders" (brackets, apostrophes, quotations or so) from the left or from the right side - or not inseted;
	 * RTLINS (RIGHT_TO_LEFT_INSERT) means that inserted text has to be placed after place where it will be inserted;
	 * LTRINS (LEFT_TO_RIGHT_INSERT) means that inserted text has to be placed before place where it will be inserted;
	 * NOINS (NO_INSERT) means that code will be written as is set
	 *
	 * @param string $InsertMode direction of code inserting
	 *
	 * @throws JaSC_Exception if element name was not set
	 * @throws JaSC_Exception if element cannot be used (because only empty elements are invited)
	 *
	 * @example new CodeGenerator('NO_INSERT');
	 */
	public function __construct($InsertMode=JaSC::JASC_MODE_NOINS)
	{
		/*
		 * initial setting of instance of class JaSC;
		 * using of function __construct is also available
		 */
		JaSC::Set_Instance();
		
		$this -> Get_AvailableMethods();

		try
		{
			if(!in_array($InsertMode, JaSC::ShowOptions_Modes()))
			{
				throw new JaSC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				$this -> InsertMode = $InsertMode;

				/*
				 * option SKIP causes that code of this object will be only exported, without saving anywhere;
				 * see function Execute of CodeGenerator for details;
				 * use function Set_ExportWay to set else export way
				 */
				$this -> FluentFragment = new CodeGenerator($InsertMode);
				$this -> FluentFragment -> Set_ExportWay(UniCAT::UNICAT_OPTION_SKIP);
			}
		}
		catch(JaSC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, $this -> Get_CallerFunctionName(), MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), JaSC::ShowOptions_Modes() );
		}
	}

	/**
	 * calls selected public functions of class CodeGenerator in desired order
	 *
	 * @param string $Method function name
	 * @param array $Parameters parameters values - arguments
	 *
	 * @return self
	 */
	public function __call($Method, $Parameters)
	{
		try
		{
			if($Method == 'Execute')
			{
				return $this -> FluentFragment -> Execute();
			}
			elseif(in_array($Method, array_keys($this -> Methods)) && preg_match('/%s/', $this -> Methods[$Method][1]))
			{
				$RealMethod = $this -> Methods[$Method][0];

				if($this -> Methods[$Method][0] != 'Set_Value')
				{
					if($this -> InsertMode == JaSC::JASC_MODE_RTLINS)
					{
						$this -> FluentFragment -> $RealMethod($this -> Methods[$Method][1]);
						$this -> FluentFragment -> Set_Value( empty($Parameters) ? '' : $Parameters[0] );
					}
					else
					{
						$this -> FluentFragment -> Set_Value( empty($Parameters) ? '' : $Parameters[0] );
						$this -> FluentFragment -> $RealMethod($this -> Methods[$Method][1]);
					}
				}
				else
				{
					$this -> FluentFragment -> $RealMethod( empty($Parameters) ? '' : $Parameters[0] );
				}
				
				return $this;
			}
			elseif(in_array($Method, array_keys($this -> Methods)) && !preg_match('/%s/', $this -> Methods[$Method][1]))
			{
				$RealMethod = $this -> Methods[$Method][0];

				if(empty($Parameters))
				{
					$this -> FluentFragment -> $RealMethod($this -> Methods[$Method][1]);
					return $this;
				}
				elseif(count($Parameters) == 1)
				{
					$this -> FluentFragment -> $RealMethod($Parameters[0]);
					return $this;
				}
				else
				{
					call_user_func_array(array($this -> FluentFragment, $RealMethod), $Parameters);
					return $this;
				}
			}
			else
			{
				throw new JaSC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_SEC_FNC_NOSUPPORT1);
			}
		}
		catch(JaSC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), $Method);
		}
	}

	/**
	 * sets insert mode - if text is inserted to "borders" (brackets, apostrophes, quotations or so) from the left or from the right side - or not inseted;
	 * RTLINS (RIGHT_TO_LEFT_INSERT) means that inserted text has to be placed after place where it will be inserted;
	 * LTRINS (LEFT_TO_RIGHT_INSERT) means that inserted text has to be placed before place where it will be inserted;
	 * NOINS (NO_INSERT) means that code will be written as is set
	 *
	 * @param string $InsertMode direction of code inserting
	 *
	 * @return JaSC\FluentFragment
	 *
	 * @example Set_InsertMode('NO_INSERT') to create code fragment as is
	 */
	public static function Set_InsertMode($InsertMode)
	{
		try
		{
			if(empty($InsertMode))
			{
				throw new UniCAT_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_MISSING);
			}
			else
			{
				return new FluentFragment($InsertMode);
			}
		}
		catch(JaSC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__));
		}
	}

	/**
	 * creates list of functions usable for object of SimpleFragment;
	 * list of usable functions is based on names of constants given by interfaces, and extended of 
	 */
	private function Get_AvailableMethods()
	{
		/*
		 * these two functions are identical;
		 * difference in name is only for purpose of "humanising", dividing of var name from var value in name of function;
		 * but you can use any of them without regard of this
		 */
		$this -> Methods['Set_Name'] = array('Set_Value', '%s');
		$this -> Methods['Set_Value'] = array('Set_Value', '%s');
		/*
		 * this is mirror function for Set_ExportWay
		 */
		$this -> Methods['Set_ExportWay'] = array('Set_ExportWay', MethodScope::Get_ParameterDefaultValue('JaSC\CodeGenerator', 'Set_ExportWay'));

		/*
		 * prepares set of supported functions
		 */
		foreach(ClassScope::Get_Interfaces('JaSC\I_JaSC_Options_Union') as $Interface)
		{
			foreach(ClassScope::Get_ConstantsNames($Interface) as $Constant)
			{
				$this -> Methods['Set_'.ucfirst(strtolower(explode('_', $Constant)[2]))] = array('Set_'.implode('', array_slice(str_split(explode('_', $Interface)[3]), 0, -1)), ClassScope::Get_ConstantValue($Interface, $Constant) );
			}
		}
	}
}