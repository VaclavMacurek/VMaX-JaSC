<?php

namespace JaSC;

use UniCAT\MethodScope;
use UniCAT\CodeExport;

/**
 * @package VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2017 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * class for better generation of values based on concated variables and texts
 */
class MixedValuesAssembler
{
	use CodeExport;

	/**
	 * values, form
	 * 
	 * @var array used values and their forms
	 */
	protected $Values = array();

	/**
	 * sets value
	 * 
	 * @param string $Value value
	 * @param string $Form control sif value will be as text or variable
	 * 
	 * @throws Exception
	 */
	public function Set_Value($Value = NULL, $Form = Core::JASC_MODE_TEXT)
	{
		try
		{
			if( !Core::Check_IsScalar($Value) )
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
			if( !Core::Check_IsValueForm($Form) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), $Exception -> Get_CallerFunctionName(), MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_ValueForm());
		}

		$this -> Values[] = array( $Value, $Form );
	}

	/**
	 * assembles value mixing texts and variables
	 * 
	 * @return string generated code
	 */
	public function Execute()
	{
		$MixedValuesAssembler = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$MixedValuesAssembler -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);

		for( $Index = 0; $Index < count($this -> Values); $Index++ )
		{
			switch( $this -> Values[$Index][1] )
			{
				case Core::JASC_MODE_TEXT:
					if( $Index == 0 )
					{
						$MixedValuesAssembler -> Set_BlockBorder(Core::JASC_OPTION_SMPLQTS);
						$MixedValuesAssembler -> Set_Value($this -> Values[$Index][0]);
					}
					else
					{
						$MixedValuesAssembler -> Set_SettingOperator(Core::JASC_OPTION_PLUS1);
						$MixedValuesAssembler -> Set_BlockBorder(Core::JASC_OPTION_SMPLQTS);
						$MixedValuesAssembler -> Set_Value($this -> Values[$Index][0]);
					}
					break;
				case Core::JASC_MODE_VAR:
					if( $Index == 0 )
					{
						$MixedValuesAssembler -> Set_Value($this -> Values[$Index][0]);
					}
					else
					{
						$MixedValuesAssembler -> Set_SettingOperator(Core::JASC_OPTION_PLUS1);
						$MixedValuesAssembler -> Set_Value($this -> Values[$Index][0]);
					}
					break;
			}
		}

		$this -> LocalCode = $MixedValuesAssembler -> Execute();

		/*
		 * sets way how code will be exported;
		 * exports code
		 */
		Core::Set_ExportWay(static::$ExportWay);
		return Core::Convert_Code($this -> LocalCode, __CLASS__);
	}

}
