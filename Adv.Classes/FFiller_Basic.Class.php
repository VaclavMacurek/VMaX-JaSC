<?php

namespace JaSC;

use UniCAT\MethodScope;

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
final class FFiller_Basic extends FragmentFiller
{
	use Execute;

	/**
	 * generation of expression/condition for "for" loop with lasting determined by characters from group of logic operators
	 * 
	 * @param string $Lasting end of lasting of loop
	 * @param string $Step size and direction of step
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Xpsn_ForMath($Lasting = Core::JASC_OPTION_LT, $Step = Core::JASC_OPTION_PLUS2)
	{
		$this -> Disable_Comments = TRUE;

		try
		{
			if( count($this -> Insertions) < 4 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 5);
		}

		try
		{
			if( !Core::Check_IsLogicOperator($Lasting) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_LogicOperator());
		}

		try
		{
			if( !Core::Check_IsSettingOperator($Step) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_SettingOperator());
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_VAR);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_ElseOperator(Core::JASC_OPTION_SMCLN);
		$FFiller_Basic -> Set_ValuesSeparator();
		$FFiller_Basic -> Set_Value($this -> Insertions[2]);
		$FFiller_Basic -> Set_LogicOperator($Lasting);
		$FFiller_Basic -> Set_Value($this -> Insertions[3]);
		$FFiller_Basic -> Set_ElseOperator(Core::JASC_OPTION_SMCLN);
		$FFiller_Basic -> Set_ValuesSeparator();
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_SettingOperator($Step);
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of expression/condition for "for in" loop
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Xpsn_ForIn()
	{
		$this -> Disable_Comments = TRUE;

		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_VAR);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_IN);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of expression/condition for "while" loop with lasting determined by characters from group of logic operators
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Xpsn_While($Lasting = Core::JASC_OPTION_LT)
	{
		$this -> Disable_Comments = TRUE;

		try
		{
			if( !Core::Check_IsLogicOperator($Lasting) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_LogicOperator());
		}

		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_VAR);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_LogicOperator($Lasting);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of block of "if" condition
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Cdtn_If()
	{
		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_IF);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of block of "else" condition
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Cdtn_Else()
	{
		try
		{
			if( count($this -> Insertions) < 1 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 1);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_ELSE);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of block of "else if" condition
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Cdtn_ElseIf()
	{
		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_ELSEIF);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of block of "switch" condition
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Cdtn_Switch()
	{
		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_SWITCH);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of block of "case" condition
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Cdtn_Case()
	{
		$this -> Disable_Comments = TRUE;

		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_CASE);
		$FFiller_Basic -> Set_ValuesSeparator();
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_ElseOperator(Core::JASC_OPTION_CLN);
		$FFiller_Basic -> Set_TextFormatter(Core::JASC_OPTION_NLT);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_TextFormatter(Core::JASC_OPTION_NLT);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_BREAK);
		$FFiller_Basic -> Set_ElseOperator(Core::JASC_OPTION_SMCLN);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of block of "default" condition
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Cdtn_Default()
	{
		$this -> Disable_Comments = TRUE;

		try
		{
			if( count($this -> Insertions) < 1 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 1);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_DEFAULT);
		$FFiller_Basic -> Set_ElseOperator(Core::JASC_OPTION_CLN);
		$FFiller_Basic -> Set_TextFormatter(Core::JASC_OPTION_NLT);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_TextFormatter(Core::JASC_OPTION_NLT);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_BREAK);
		$FFiller_Basic -> Set_ElseOperator(Core::JASC_OPTION_SMCLN);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of block of "try-catch" condition
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Cdtn_TryCatch()
	{
		try
		{
			if( count($this -> Insertions) < 3 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 3);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_TRY);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_CATCH);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[2]);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of block of "try-catch-finally" condition
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Cdtn_TryCatchFinally()
	{
		try
		{
			if( count($this -> Insertions) < 4 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 4);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_TRY);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_CATCH);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[2]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_FINALLY);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[3]);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of block of "for" loop
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Loop_For()
	{
		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_FOR);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of block of "while" loop
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Loop_While()
	{
		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_WHILE);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of block of "do...while" loop
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Loop_DoWhile()
	{
		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_DO);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_WHILE);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of function definition
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Dfn_Function()
	{
		try
		{
			if( count($this -> Insertions) < 3 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 3);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_FUNCTION);
		$FFiller_Basic -> Set_ValuesSeparator();
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_TextFormatter();
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[2]);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of function definition
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Dfn_AnnmFunction()
	{
		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_FUNCTION);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of variable setting;
	 * without semicolon for using anonymous functions as content
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Set_VarSimple($Set = Core::JASC_OPTION_EQUAL1)
	{
		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		try
		{
			if( !Core::Check_IsSettingOperator($Set) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_SettingOperator());
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_SettingOperator($Set);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of variable setting;
	 * without semicolon for using anonymous functions as content
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Set_VarBasic()
	{
		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_VAR);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of variable setting;
	 * with semicolon and new-line
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Set_VarFull()
	{
		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_VAR);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_ElseOperator(Core::JASC_OPTION_SMCLN);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of variable setting;
	 * JSON pre-set variation of full variable setting
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Set_VarJson()
	{
		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_ScriptKeyword(Core::JASC_OPTION_VAR);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_SettingOperator(Core::JASC_OPTION_EQUAL1);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_BRCS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$FFiller_Basic -> Set_ElseOperator(Core::JASC_OPTION_SMCLN);
		$FFiller_Basic -> Set_TextFormatter();
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of comparation
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Cmpr_Simple($CompChar = Core::JASC_OPTION_EQUAL2)
	{
		$this -> Disable_Comments = TRUE;

		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		try
		{
			if( !Core::Check_IsLogicOperator($CompChar) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_LogicOperator());
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_LogicOperator($CompChar);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of comparation
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Cmpr_Multilvl($CompChar = Core::JASC_OPTION_AND2)
	{
		$this -> Disable_Comments = TRUE;

		try
		{
			if( count($this -> Insertions) < 2 )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_SEC_VAR_PRHBLWRARRSIZE);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, $Exception -> Get_VariableNameAsText($this -> Insertions), 2);
		}

		try
		{
			if( !Core::Check_IsLogicOperator($CompChar) )
			{
				throw new Exception(Core::UNICAT_XCPT_MAIN_CLS, Core::UNICAT_XCPT_MAIN_FNC, Core::UNICAT_XCPT_MAIN_PRM, Core::UNICAT_XCPT_SEC_PRM_DMDOPTION);
			}
		}
		catch( Exception $Exception )
		{
			$Exception -> ExceptionWarning(get_called_class(), __FUNCTION__, MethodScope::Get_ParameterName(__CLASS__, __FUNCTION__), Core::ShowOptions_LogicOperator());
		}

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$FFiller_Basic -> Set_LogicOperator($CompChar);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[1]);
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

}
