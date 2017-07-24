<?php

namespace JaSC;

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
final class FFiller_jQuery extends FragmentFiller
{

	/**
	 * generation of jQuery for simple elements selection with default text option
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Start_Selection()
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
		$FFiller_Basic -> Set_SpecialCharacter(Core::JASC_OPTION_DLR);
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of jQuery for simple elements selection with default text option
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function StartFull_Selection()
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
		$FFiller_Basic -> Set_Value('jQuery');
		$FFiller_Basic -> Set_BlockBorder(Core::JASC_OPTION_CMNBRKTS);
		$FFiller_Basic -> Set_Value($this -> Insertions[0]);
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of jQuery for simple elements selection with full setting
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function Start_Simple()
	{
		$this -> Disable_Comments = TRUE;

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_SpecialCharacter(Core::JASC_OPTION_DLR);
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

	/**
	 * generation of jQuery for simple elements selection with full setting
	 * 
	 * @return string
	 * 
	 * @throws Exception
	 */
	public function StartFull_Simple()
	{
		$this -> Disable_Comments = TRUE;

		$FFiller_Basic = new CodeGenerator(Core::JASC_MODE_RTLINS);
		$FFiller_Basic -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
		$FFiller_Basic -> Set_Value('jQuery');
		$this -> LocalCode = $FFiller_Basic -> Execute();
	}

}
