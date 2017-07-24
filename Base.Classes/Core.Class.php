<?php

namespace JaSC;

use UniCAT\CodeExport;
use UniCAT\CodeMemory;
use UniCAT\Comments;
use UniCAT\Core as UniCAT;
use UniCAT\ClassScope;

/**
 * @package VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2017 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * class for easier access to class constants of interfaces
 *
 * @method array ShowOptions_LogicOperator() show supported operators
 * @method array ShowOptions_SettingOperator() show supported operators
 * @method array ShowOptions_ElseOperator() show supported operators
 * @method array ShowOptions_BlockBorder() show supported borders characters
 * @method array ShowOptions_ScriptKeyword() show supported keywords
 * @method array ShowOptions_ValuesSeparator() show supported values separators
 * @method array ShowOptions_LineBreaker() show supported line breakers
 * @method array ShowOptions_InsertMode() show modes of inserting
 * @method array ShowOptions_ValueMode() show modes of values generation
 * @method array ShowOptions_ValueForm() show form of values (if any value will be generated as is or will be as text)
 * 
 * @method bool Check_IsLogicOperator(string $Checked); checks if value is in array of allowed values
 * @method bool Check_IsSettingOperator(string $Checked); checks if value is in array of allowed values
 * @method bool Check_IsElseOperator(string $Checked); checks if value is in array of allowed values
 * @method bool Check_IsBlockBorder(string $Checked); checks if value is in array of allowed values
 * @method bool Check_IsScriptKeyword(string $Checked); checks if value is in array of allowed values
 * @method bool Check_IsValuesSeparator(string $Checked); checks if value is in array of allowed values
 * @method bool Check_IsLineBreaker(string $Checked); checks if value is in array of allowed values
 * @method bool Check_IsInsertMode(string $Checked); checks if value is in array of allowed values
 * @method bool Check_IsValueMode(string $Checked); checks if value is in array of allowed values
 * @method bool Check_IsValueForm(string $Checked); checks if value is in array of allowed values
 */
final class Core extends UniCAT implements I_JaSC_Union, I_JaSC_InsertMode, I_JaSC_ValueMode, I_JaSC_ValueForm
{
	use CodeExport,
	CodeMemory,
	Comments
	{
		Set_Comment as private;
	}

	/**
	 * prepares lists of options
	 */
	protected function __construct()
	{
		parent::__construct();

		static::$Options['logic_operator'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_LogicOperator');
		static::$Options['setting_operator'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_SettingOperator');
		static::$Options['else_operator'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_ElseOperator');
		static::$Options['block_border'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_BlockBorder');
		static::$Options['script_keyword'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_ScriptKeyword');
		static::$Options['text_formatter'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_TextFormatter');
		static::$Options['values_separator'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_ValuesSeparator');
		static::$Options['special_character'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_SpecialCharacter');
		static::$Options['insert_mode'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_InsertMode');
		static::$Options['value_mode'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_ValueMode');
		static::$Options['value_form'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_ValueForm');
	}

}

?>