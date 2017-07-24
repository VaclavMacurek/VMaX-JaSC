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
 * class for better generation of values of various types (arguments, parameters, array values ...)
 */
class MultiValuesSerializer
{
	use CodeExport;

	/**
	 * mode of values generation;
	 * CSV: comma-separated-values, simple values - for simple arrays, arguments and parameters without pre-set value
	 * JSON: name: value;
	 * PRMS: name = value;
	 * CSVPRMS: combination of CSV and PRMS
	 *
	 * @var string 
	 */
	protected $Mode = FALSE;
	/**
	 * methods' parameters;
	 * parameters' group per item
	 * 
	 * @var array 
	 */
	protected $Values = array();
	/**
	 * if value will be set as is or as text
	 * 
	 * @var array
	 */
	protected $Forms = array();

	/**
	 * sets values generation mode
	 * 
	 * @param string $Mode values generation mode
	 * 
	 * @throws Exception
	 */
	public function __construct($Mode = Core::JASC_MODE_CSV)
	{
		try
		{
			if( Core::Check_IsValueMode($Mode) )
			{
				$this -> Mode = $Mode;
			}
			else
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_ValueMode());
		}
	}

	/**
	 * sets value
	 * 
	 * @param string $Value value
	 * @param string $Form controls if value will be as text or variable
	 * 
	 * @throws Exception
	 */
	public function Set_Value($Value = NULL, $Form = Core::JASC_MODE_TEXT)
	{
		try
		{
			switch( $this -> Mode )
			{
				case Core::JASC_MODE_CSVPRMS:
					if( !Core::Check_IsBasic($Value) )
					{
						throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
					}
					break;
				case Core::JASC_MODE_PRMS:
					if( !Core::Check_IsArray($Value) )
					{
						throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
					}
					break;
				case Core::JASC_MODE_CSV:
					if( !Core::Check_IsScalar($Value) )
					{
						throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
					}
					break;
				case Core::JASC_MODE_JSON:
					if( !Core::Check_IsArray($Value) )
					{
						throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
					}
					break;
			}
		}
		catch( Exception $Exception )
		{
			switch( $this -> Mode )
			{
				case Core::JASC_MODE_CSVPRMS:
					$Exception -> ExceptionWarning(get_called_class(), $Exception -> Get_CallerFunctionName(), MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_Basic());
					break;
				case Core::JASC_MODE_PRMS:
					$Exception -> ExceptionWarning(get_called_class(), $Exception -> Get_CallerFunctionName(), MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_Array());
					break;
				case Core::JASC_MODE_CSV:
					$Exception -> ExceptionWarning(get_called_class(), $Exception -> Get_CallerFunctionName(), MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_Scalar());
					break;
				case Core::JASC_MODE_JSON:
					$Exception -> ExceptionWarning(get_called_class(), $Exception -> Get_CallerFunctionName(), MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_Array());
					break;
			}
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
			$Exception -> ExceptionWarning(get_called_class(), $Exception -> Get_CallerFunctionName(), MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__, 1), Core::ShowOptions_ValueForm());
		}

		$this -> Values[] = $Value;
		$this -> Forms[] = $Form;
	}

	/**
	 * assembles row of values as was defined
	 * 
	 * @return string generated code of row of values ready for insertion anywhere
	 */
	public function Execute()
	{
		$MultiValuesSerializer = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$MultiValuesSerializer -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);

		for( $Index = 0; $Index < count($this -> Values); $Index++ )
		{
			switch( $this -> Mode )
			{
				case Core::JASC_MODE_CSVPRMS:
					if( $Index == 0 )
					{
						if( Core::Check_IsArray($this -> Values[$Index]) && $this -> Forms[$Index] == Core::JASC_MODE_VAR )
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][0]);
							$MultiValuesSerializer -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][1]);
						}
						elseif( Core::Check_IsArray($this -> Values[$Index]) && $this -> Forms[$Index] == Core::JASC_MODE_TEXT )
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][0]);
							$MultiValuesSerializer -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
							$MultiValuesSerializer -> Set_BlockBorder(Core::JASC_OPTION_SMPLQTS);
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][1]);
						}
						else
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index]);
						}
					}
					else
					{
						$MultiValuesSerializer -> Set_ValuesSeparator(Core::JASC_OPTION_CMM);

						if( Core::Check_IsArray($this -> Values[$Index]) && $this -> Forms[$Index] == Core::JASC_MODE_VAR )
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][0]);
							$MultiValuesSerializer -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][1]);
						}
						elseif( Core::Check_IsArray($this -> Values[$Index]) && $this -> Forms[$Index] == Core::JASC_MODE_TEXT )
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][0]);
							$MultiValuesSerializer -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
							$MultiValuesSerializer -> Set_BlockBorder(Core::JASC_OPTION_SMPLQTS);
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][1]);
						}
						else
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index]);
						}
					}
					break;
				case Core::JASC_MODE_PRMS:
					if( $Index == 0 )
					{
						if( $this -> Forms[$Index] == Core::JASC_MODE_VAR )
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][0]);
							$MultiValuesSerializer -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][1]);
						}
						elseif( $this -> Forms[$Index] == Core::JASC_MODE_TEXT )
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][0]);
							$MultiValuesSerializer -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
							$MultiValuesSerializer -> Set_BlockBorder(Core::JASC_OPTION_SMPLQTS);
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][1]);
						}
					}
					else
					{
						$MultiValuesSerializer -> Set_ValuesSeparator(Core::JASC_OPTION_CMM);

						if( $this -> Forms[$Index] == Core::JASC_MODE_VAR )
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][0]);
							$MultiValuesSerializer -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][1]);
						}
						elseif( $this -> Forms[$Index] == Core::JASC_MODE_TEXT )
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][0]);
							$MultiValuesSerializer -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
							$MultiValuesSerializer -> Set_BlockBorder(Core::JASC_OPTION_SMPLQTS);
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index][1]);
						}
					}
					break;
				case Core::JASC_MODE_CSV:
					if( $Index == 0 )
					{
						if( $this -> Forms[$Index] == Core::JASC_MODE_VAR )
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index]);
						}
						elseif( $this -> Forms[$Index] == Core::JASC_MODE_TEXT )
						{
							$MultiValuesSerializer -> Set_BlockBorder(Core::JASC_OPTION_SMPLQTS);
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index]);
						}
					}
					else
					{
						$MultiValuesSerializer -> Set_ValuesSeparator(Core::JASC_OPTION_CMM);

						if( $this -> Forms[$Index] == Core::JASC_MODE_VAR )
						{
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index]);
						}
						elseif( $this -> Forms[$Index] == Core::JASC_MODE_TEXT )
						{
							$MultiValuesSerializer -> Set_BlockBorder(Core::JASC_OPTION_SMPLQTS);
							$MultiValuesSerializer -> Set_Value($this -> Values[$Index]);
						}
					}
					break;
				case Core::JASC_MODE_JSON:
					if( $this -> Forms[$Index] == Core::JASC_MODE_VAR )
					{
						$MultiValuesSerializer -> Set_Value($this -> Values[$Index][0]);
						$MultiValuesSerializer -> Set_ElseOperator(Core::JASC_OPTION_CLN);
						$MultiValuesSerializer -> Set_Value($this -> Values[$Index][1]);
					}
					elseif( $this -> Forms[$Index] == Core::JASC_MODE_TEXT )
					{
						$MultiValuesSerializer -> Set_Value($this -> Values[$Index][0]);
						$MultiValuesSerializer -> Set_ElseOperator(Core::JASC_OPTION_CLN);
						$MultiValuesSerializer -> Set_BlockBorder(Core::JASC_OPTION_SMPLQTS);
						$MultiValuesSerializer -> Set_Value($this -> Values[$Index][1]);
					}
					break;
			}
		}

		$this -> LocalCode = $MultiValuesSerializer -> Execute();

		/*
		 * sets way how code will be exported;
		 * exports code
		 */
		Core::Set_ExportWay(static::$ExportWay);
		return Core::Convert_Code($this -> LocalCode, __CLASS__);
	}

}
