<?php

namespace JaSC;

use UniCAT\CodeExport;
use UniCAT\Comments;
use UniCAT\MethodScope;
use UniCAT\ClassScope;

/**
 * @package VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2017 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * generation of JavaScript code
 */
final class CodeGenerator
{
	use CodeExport,
	Comments;

	/**
	 * construction parts
	 *
	 * @var array
	 */
	private $Construction = array();
	/**
	 * used generic constructions
	 *
	 * @var array
	 */
	private $UsedConstructions = array();
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
	 * @throws Exception
	 */
	public function __construct($InsertMode = Core::JASC_MODE_NOINS)
	{
		try
		{
			if( !Core::Check_IsInsertMode($InsertMode) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				$this -> InsertMode = $InsertMode;
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_InsertMode());
		}
	}

	/**
	 * sets logic operator as part of generated code
	 *
	 * @param string $Operator pre-defined operator
	 *
	 * @throws Exception if unsupported operator was set
	 */
	public function Set_LogicOperator($Operator)
	{
		try
		{
			if( !Core::Check_IsLogicOperator($Operator) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				$Option = preg_split('/((?:^|[A-Z])[a-z]+)/', explode('_', __FUNCTION__)[1], NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
				$Option = strtolower(implode('_', $Option));

				$this -> Construction[] = $Operator;
				$this -> UsedConstructions[] = $Option;
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_LogicOperator());
		}
	}

	/**
	 * sets setting operator as part of generated code
	 *
	 * @param string $Operator pre-defined operator
	 *
	 * @throws Exception if unsupported operator was set
	 */
	public function Set_SettingOperator($Operator)
	{
		try
		{
			if( !Core::Check_IsSettingOperator($Operator) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				$Option = preg_split('/((?:^|[A-Z])[a-z]+)/', explode('_', __FUNCTION__)[1], NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
				$Option = strtolower(implode('_', $Option));

				$this -> Construction[] = $Operator;
				$this -> UsedConstructions[] = $Option;
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_SettingOperator());
		}
	}

	/**
	 * sets separator (dot, comma or various spaces) as part of generated code
	 *
	 * @param string $Separator pre-defined separator
	 *
	 * @throws Exception if unsupported separator was set
	 */
	public function Set_ValuesSeparator($Separator = Core::JASC_OPTION_SPC)
	{
		try
		{
			if( !Core::Check_IsValuesSeparator($Separator) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				$Option = preg_split('/((?:^|[A-Z])[a-z]+)/', explode('_', __FUNCTION__)[1], NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
				$Option = strtolower(implode('_', $Option));

				$this -> Construction[] = $Separator;
				$this -> UsedConstructions[] = $Option;
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_ValuesSeparator());
		}
	}

	/**
	 * sets line breaker as part of generated code
	 *
	 * @param string $Breaker pre-defined line-breaker
	 *
	 * @throws Exception if unsupported line-breaker was set
	 */
	public function Set_TextFormatter($Formatter = Core::JASC_OPTION_NLN)
	{
		try
		{
			if( !Core::Check_IsTextFormatter($Formatter) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				$Option = preg_split('/((?:^|[A-Z])[a-z]+)/', explode('_', __FUNCTION__)[1], NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
				$Option = strtolower(implode('_', $Option));

				$this -> Construction[] = $Formatter;
				$this -> UsedConstructions[] = $Option;
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_ValuesSeparator());
		}
	}

	/**
	 * sets border (brackets or quotations) as part of generated code
	 *
	 * @param string $Border pre-defined pair of brackets or quotations
	 *
	 * @throws Exception if unsupported border was set
	 */
	public function Set_BlockBorder($Border)
	{
		try
		{
			if( !Core::Check_IsBlockBorder($Border) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				$Option = preg_split('/((?:^|[A-Z])[a-z]+)/', explode('_', __FUNCTION__)[1], NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
				$Option = strtolower(implode('_', $Option));

				$this -> Construction[] = $Border;
				$this -> UsedConstructions[] = $Option;
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_BlockBorder());
		}
	}

	/**
	 * sets keyword (see options interfaces) as part of generated code
	 *
	 * @param string $Keyword pre-defined keyword
	 *
	 * @throws Exception if unsupported keyword was set
	 */
	public function Set_ScriptKeyword($Keyword)
	{
		try
		{
			if( !Core::Check_IsScriptKeyword($Keyword) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				$Option = preg_split('/((?:^|[A-Z])[a-z]+)/', explode('_', __FUNCTION__)[1], NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
				$Option = strtolower(implode('_', $Option));

				$this -> Construction[] = $Keyword;
				$this -> UsedConstructions[] = $Option;
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_ScriptKeyword());
		}
	}

	/**
	 * sets keyword (see options interfaces) as part of generated code
	 *
	 * @param string $Keyword pre-defined keyword
	 *
	 * @throws Exception if unsupported keyword was set
	 */
	public function Set_SpecialCharacter($Character)
	{
		try
		{
			if( !Core::Check_IsSpecialCharacter($Character) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				$Option = preg_split('/((?:^|[A-Z])[a-z]+)/', explode('_', __FUNCTION__)[1], NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
				$Option = strtolower(implode('_', $Option));

				$this -> Construction[] = $Character;
				$this -> UsedConstructions[] = $Option;
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_SpecialCharacter());
		}
	}

	/**
	 * sets random value as part of generated code
	 *
	 * @param string $Value any word or character that is not pre-defined in interfaces
	 *
	 * @throws Exception if unsupported keyword was set
	 */
	public function Set_Value($Value = NULL)
	{
		try
		{
			if( $Value !== NULL && !Core::Check_IsScalar($Value) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
			}
			else
			{
				$Option = preg_split('/((?:^|[A-Z])[a-z]+)/', explode('_', __FUNCTION__)[1], NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
				$Option = strtolower(implode('_', $Option));

				$this -> Construction[] = $Value;
				$this -> UsedConstructions[] = $Option;
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), gettype($Value), Core::ShowOptions_Scalar());
		}
	}

	/**
	 * prevents using of non-public functions
	 *
	 * @param string $Method function name
	 * @param array $Parameters parameters values - arguments
	 *
	 * @throws Exception if function does not exist
	 * @throws Exception if function is not public
	 */
	public function __call($Method, $Parameters)
	{
		try
		{
			if( in_array($Method, ClassScope::Get_Methods(__CLASS__, ClassScope::UNICAT_OPTION_PUBLIC)) )
			{
				throw new UniCAT_Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_SEC_FNC_MISSING);
			}
			else
			{
				call_user_func_array(array( $this, $Method ), $Parameters);
			}
		}
		catch( UniCAT_Exception $Exception )
		{
			$Exception -> ExceptionWarning(__CLASS__, $Method);
		}
	}

	/**
	 * assembling of code
	 *
	 * @return string|void
	 */
	public function Execute()
	{
		switch( $this -> InsertMode )
		{
			case Core::JASC_MODE_RTLINS:
				for( $Index = 0; $Index < count($this -> Construction); $Index++ )
				{
					if( isset($this -> Construction[$Index + 1]) )
					{
						if( $this -> UsedConstructions[$Index] == 'block_border' && $this -> UsedConstructions[$Index + 1] == 'value' )
						{
							$this -> LocalCode .= sprintf($this -> Construction[$Index], preg_replace('/\n/', "\n\t", $this -> Construction[$Index + 1]));
							$this -> Construction[$Index + 1] = FALSE;
						}
						elseif( $this -> UsedConstructions[$Index] == 'block_border' )
						{
							$this -> LocalCode .= sprintf(preg_replace('/\n/', "\n\t", $this -> Construction[$Index]), '');
						}
						else
						{
							$this -> LocalCode .= $this -> Construction[$Index];
						}
					}
					else
					{
						if( $this -> UsedConstructions[$Index] == 'block_border' )
						{
							$this -> LocalCode .= sprintf(preg_replace('/\n/', "\n\t", $this -> Construction[$Index]), '');
						}
						else
						{
							$this -> LocalCode .= $this -> Construction[$Index];
						}
					}
				}
				break;
			case Core::JASC_MODE_LTRINS:
				for( $Index = 0; $Index < count($this -> Construction); $Index++ )
				{
					if( isset($this -> Construction[$Index + 1]) )
					{
						if( $this -> UsedConstructions[$Index] == 'value' && $this -> UsedConstructions[$Index + 1] == 'block_border' )
						{
							$this -> LocalCode .= sprintf(preg_replace('/\n/', "\n\t", $this -> Construction[$Index + 1]), $this -> Construction[$Index]);
							$this -> Construction[$Index] = FALSE;
						}
						elseif( $this -> UsedConstructions[$Index] == 'block_border' )
						{
							$this -> LocalCode .= sprintf(preg_replace('/\n/', "\n\t", $this -> Construction[$Index]), '');
						}
						else
						{
							$this -> LocalCode .= $this -> Construction[$Index];
						}
					}
					else
					{
						if( $this -> UsedConstructions[$Index] == 'block_border' )
						{
							$this -> LocalCode .= sprintf(preg_replace('/\n/', "\n\t", $this -> Construction[$Index]), '');
						}
						else
						{
							$this -> LocalCode .= $this -> Construction[$Index];
						}
					}
				}
				break;
			default:
				for( $Index = 0; $Index < count($this -> Construction); $Index++ )
				{
					if( $this -> UsedConstructions[$Index] == 'block_border' )
					{
						$this -> LocalCode .= sprintf(preg_replace('/\n/', "\n\t", $this -> Construction[$Index]), '');
					}
					else
					{
						$this -> LocalCode .= $this -> Construction[$Index];
					}
				}
				break;
		}

		/*
		 * corrects some formatting problems
		 */
		$this -> LocalCode = preg_replace('/;\n\t}/', ";\n}", $this -> LocalCode);
		$this -> LocalCode = preg_replace('/\t\t}/', "\t}", $this -> LocalCode);
		$this -> LocalCode = preg_replace('/}\n\t}/', "}\n}", $this -> LocalCode);
		$this -> LocalCode = preg_replace('/}\n}/', "\t}\n}", $this -> LocalCode);
		$this -> LocalCode = preg_replace('/}\n\t([^}])/', "\t}\n\t$1", $this -> LocalCode);

		/*
		 * sets way how code will be exported;
		 * exports code
		 */
		Core::Set_ExportWay(static::$ExportWay);
		Core::Add_Comments($this -> LocalCode, static::$Comments);
		static::$Comments = array();
		return Core::Convert_Code($this -> LocalCode, __CLASS__);
	}

}

?>