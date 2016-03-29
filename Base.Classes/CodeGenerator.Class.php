<?php

namespace JaSC;

use UniCAT\CodeExport;
use UniCAT\Comments;
use UniCAT\UniCAT;
use UniCAT\MethodScope;

/**
 * @package VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2016 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * generation of JavaScript code
 */
final class CodeGenerator
{
	use CodeExport, Comments;
	
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
	 * @throws JaSC_Exception if insert mode was set by wrong option
	 */
	public function __construct($InsertMode=JaSC::JASC_MODE_NOINS)
	{
		/*
		 * initial setting of instance of class JaSC;
		 * using of function __construct is also available
		 */
		JaSC::Set_Instance();

		try
		{
			if(!in_array($InsertMode, JaSC::ShowOptions_Modes()))
			{
				throw new JaSC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				$this -> InsertMode = $InsertMode;
			}
		}
		catch(JaSC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), JaSC::ShowOptions_Modes() );
		}

	}
	
	/**
	 * sets operator as part of generated code
	 *
	 * @param string $Operator pre-defined operator
	 *
	 * @throws JaSC_Exception if unsupported operator was set
	 */
	public function Set_Operator($Operator)
	{
		try
		{
			if(!in_array($Operator, JaSC::ShowOptions_Operators()))
			{
				throw new JaSC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_DMDOPTION );
			}
			else
			{
				$this -> Construction[] = $Operator;
				$this -> UsedConstructions[] = strtolower(explode('_', __FUNCTION__)[1]);
			}
		}
		catch(JaSC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), JaSC::ShowOptions_Operators() );
		}
	}

	/**
	 * sets separator (dot, comma or various spaces) as part of generated code
	 *
	 * @param string $Separator pre-defined separator
	 *
	 * @throws JaSC_Exception if unsupported separator was set
	 */
	public function Set_Separator($Separator=JaSC::JASC_OPTION_SPC)
	{
		try
		{
			if(!in_array($Separator, JaSC::ShowOptions_Separators()))
			{
				throw new JaSC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_DMDOPTION );
			}
			else
			{
				$this -> Construction[] = $Separator;
				$this -> UsedConstructions[] = strtolower(explode('_', __FUNCTION__)[1]);
			}
		}
		catch(JaSC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), JaSC::ShowOptions_Separators() );
		}
	}

	/**
	 * sets border (brackets or quotations) as part of generated code
	 *
	 * @param string $Border pre-defined pair of brackets or quotations
	 *
	 * @throws JaSC_Exception if unsupported border was set
	 */
	public function Set_Border($Border)
	{
		try
		{
			if(!in_array($Border, JaSC::ShowOptions_Borders()))
			{
				throw new JaSC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_DMDOPTION );
			}
			else
			{
				$this -> Construction[] = $Border;
				$this -> UsedConstructions[] = strtolower(explode('_', __FUNCTION__)[1]);
			}
		}
		catch(JaSC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), JaSC::ShowOptions_Borders() );
		}
	}

	/**
	 * sets keyword (in, instanceof, new) as part of generated code
	 *
	 * @param string $Keyword pre-defined keyword
	 *
	 * @throws JaSC_Exception if unsupported keyword was set
	 */
	public function Set_Keyword($Keyword)
	{
		try
		{
			if(!in_array($Keyword, JaSC::ShowOptions_Keywords()))
			{
				throw new JaSC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_DMDOPTION );
			}
			else
			{
				$this -> Construction[] = $Keyword;
				$this -> UsedConstructions[] = strtolower(explode('_', __FUNCTION__)[1]);
			}
		}
		catch(JaSC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), JaSC::ShowOptions_Keywords());
		}
	}

	/**
	 * sets random value as part of generated code
	 *
	 * @param string $Value any word or character that is not pre-defined in interfaces
	 *
	 * @throws JaSC_Exception if unsupported keyword was set
	 */
	public function Set_Value($Value=NULL)
	{
		try
		{
			if($Value !== NULL && !in_array(gettype($Value), UniCAT::ShowOptions_Scalars()))
			{
				throw new JaSC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_WRONGVALTYPE);
			}
			else
			{
				$this -> Construction[] = $Value;
				$this -> UsedConstructions[] = strtolower(explode('_', __FUNCTION__)[1]);
			}
		}
		catch(JaSC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), gettype($Value), JaSC::ShowOptions_Scalars());
		}
	}

	/**
	 * sets construction keyword (like for, case and so on) as part of generated code
	 *
	 * @param string $Construction pre-defined construction keyword
	 *
	 * @throws JaSC_Exception if unsupported keyword was set
	 */
	public function Set_Construction($Construction)
	{
		try
		{
			if(!in_array($Construction, JaSC::ShowOptions_Constructions()))
			{
				throw new JaSC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_MAIN_PRM, UniCAT::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
			else
			{
				$this -> Construction[] = $Construction;
				$this -> UsedConstructions[] = strtolower(explode('_', __FUNCTION__)[1]);
			}
		}
		catch(JaSC_Exception $Exception)
		{
			$Exception -> ExceptionWarning(__CLASS__, __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), JaSC::ShowOptions_Constructions());
		}
	}

	/**
	 * prevents using of non-public functions
	 *
	 * @param string $Method function name
	 * @param array $Parameters parameters values - arguments
	 *
	 * @throws JaSC_Exception if function does not exist
	 * @throws JaSC_Exception if function is not public
	 */
	public function __call($Method, array $Parameters)
	{
		try
		{
			if(method_exists($this, $Method))
			{
				if(MethodScope::Check_IsPublic(__CLASS__, $Method))
				{
					call_user_func_array(array($this, $Method), $Parameters);
				}
				else
				{
					throw new JaSC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_SEC_FNC_PRHBUSE1);
				}
			}
			else
			{
				throw new JaSC_Exception(UniCAT::UNICAT_XCPT_MAIN_CLS, UniCAT::UNICAT_XCPT_MAIN_FNC, UniCAT::UNICAT_XCPT_SEC_FNC_MISSING1);
			}
		}
		catch(JaSC_Exception $Exception)
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
		switch($this -> InsertMode)
		{
			case JaSC::JASC_MODE_RTLINS:
				for($Index = 0; $Index < count($this -> Construction); $Index++)
				{
					if(isset($this -> Construction[$Index+1]))
					{
						if($this -> UsedConstructions[$Index] == 'border' && $this -> UsedConstructions[$Index+1] == 'value')
						{
							$this -> LocalCode .= sprintf($this -> Construction[$Index], $this -> Construction[$Index+1]);
							$this -> Construction[$Index+1] = FALSE;
						}
						elseif($this -> UsedConstructions[$Index] == 'border')
						{
							$this -> LocalCode .= sprintf($this -> Construction[$Index], '');
						}
						else
						{
							$this -> LocalCode .= $this -> Construction[$Index];
						}
					}
					else
					{
						if($this -> UsedConstructions[$Index] == 'border')
						{
							$this -> LocalCode .= sprintf($this -> Construction[$Index], '');
						}
						else
						{
							$this -> LocalCode .= $this -> Construction[$Index];
						}
					}
				}
				break;
			case JaSC::JASC_MODE_LTRINS:
				for($Index = 0; $Index < count($this -> Construction); $Index++)
				{
					if(isset($this -> Construction[$Index+1]))
					{
						if($this -> UsedConstructions[$Index] == 'value' && $this -> UsedConstructions[$Index+1] == 'border')
						{
							$this -> LocalCode .= sprintf($this -> Construction[$Index+1], $this -> Construction[$Index]);
							$this -> Construction[$Index] = FALSE;
						}
						elseif($this -> UsedConstructions[$Index] == 'border')
						{
							$this -> LocalCode .= sprintf($this -> Construction[$Index], '');
						}
						else
						{
							$this -> LocalCode .= $this -> Construction[$Index];
						}
					}
					else
					{
						if($this -> UsedConstructions[$Index] == 'border')
						{
							$this -> LocalCode .= sprintf($this -> Construction[$Index], '');
						}
						else
						{
							$this -> LocalCode .= $this -> Construction[$Index];
						}
					}
				}
				break;
			default:
				for($Index = 0; $Index < count($this -> Construction); $Index++)
				{
					if($this -> UsedConstructions[$Index] == 'border')
					{
						$this -> LocalCode .= sprintf($this -> Construction[$Index], '');
					}
					else
					{
						$this -> LocalCode .= $this -> Construction[$Index];
					}
				}
				break;
		}

		/*
		 * sets way how code will be exported;
		 * exports code
		 */
		JaSC::Set_ExportWay(static::$ExportWay);
		JaSC::Add_Comments($this -> LocalCode, static::$Comments);
		return JaSC::Convert_Code($this -> LocalCode, __CLASS__);
	}
}

?>