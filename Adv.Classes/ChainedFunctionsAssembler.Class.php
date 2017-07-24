<?php

namespace JaSC;

use UniCAT\MethodScope;
use UniCAT\CodeExport;
use UniCAT\Comments;

/**
 * @package VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2017 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * class for better generation of fragments
 */
class ChainedFunctionsAssembler
{
	use CodeExport,
	Comments;

	/**
	 * functions' arguments;
	 * parameters' group per item
	 * 
	 * @var array 
	 */
	protected $Arguments = array();
	/**
	 * methoda' list;
	 * 
	 * @var array
	 */
	protected $Functions = array();
	/**
	 *
	 * @var string 
	 */
	protected $Start = FALSE;

	/**
	 * sets starting sequence for functions chain;
	 * DO NOT INCLUDE DOT TO THE END
	 * 
	 * @param string $Start
	 * 
	 * @throws Exception
	 */
	public function __construct($Start = Core::JASC_OPTION_DLR)
	{
		try
		{
			if( Core::Check_IsString($Start) )
			{
				$this -> Start = $Start;
			}
			else
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), gettype($Start), Core::ShowOptions_String());
		}
	}

	/**
	 * sets name of method that will be used in chain
	 * 
	 * @param string $Function function name
	 * @param string $Arguments texts/variables used as arguments for function
	 * 
	 * @throws Exception
	 */
	public function Set_Function($Function = NULL, $Argument = NULL)
	{
		try
		{
			if( !Core::Check_IsString($Function) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_MISSING);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), $Exception -> Get_CallerFunctionName(), MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__));
		}

		try
		{
			if( !Core::Check_IsScalar($Argument) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), $Exception -> Get_CallerFunctionName(), MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__, 1), gettype($Argument), Core::ShowOptions_Scalar());
		}

		$this -> Functions[] = array( $Function, $Argument );
	}

	/**
	 * executes assembling of functions chain
	 * 
	 * @return string generated code
	 * 
	 * @throws Exception
	 */
	public function Execute()
	{
		try
		{
			if( empty($this -> Functions) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_EMPTYSTMT);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), $Exception -> Get_CallerFunctionName(), $Exception -> Get_VariableNameAsText($this -> Functions));
		}

		$ChainedFunctionsAssembler = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$ChainedFunctionsAssembler -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$ChainedFunctionsAssembler -> Set_Value($this -> Start);

		foreach( $this -> Functions as $Function )
		{
			$ChainedFunctionsAssembler -> Set_ValuesSeparator(Core::JASC_OPTION_DOT);
			$ChainedFunctionsAssembler -> Set_Value($Function[0]);
			$ChainedFunctionsAssembler -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
			$ChainedFunctionsAssembler -> Set_Value($Function[1]);
		}

		$this -> LocalCode = $ChainedFunctionsAssembler -> Execute();

		/*
		 * sets way how code will be exported;
		 * exports code
		 */
		Core::Set_ExportWay(static::$ExportWay);
		Core::Add_Comments($this -> LocalCode, static::$Comments);
		static::$Comments = FALSE;
		return Core::Convert_Code($this -> LocalCode, __CLASS__);
	}

}
