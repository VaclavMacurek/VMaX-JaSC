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
 * interface with logic operators
 */
interface I_JaSC_LogicOperator
{

	const JASC_OPTION_EQUAL2 = "\x20==\x20";
	const JASC_OPTION_EQUAL3 = "\x20===\x20";
	const JASC_OPTION_LT = "\x20<\x20";
	const JASC_OPTION_GT = "\x20>\x20";
	const JASC_OPTION_LTE = "\x20<=\x20";
	const JASC_OPTION_GTE = "\x20>=\x20";
	const JASC_OPTION_AND2 = "\x20&&\x20";
	const JASC_OPTION_OR2 = "\x20||\x20";
	const JASC_OPTION_NOTEQUAL1 = "\x20!=\x20";
	const JASC_OPTION_NOTEQUAL2 = "\x20!==\x20";

}

/**
 * interface with setting operators
 */
interface I_JaSC_SettingOperator
{

	const JASC_OPTION_PLUS1 = "\x20+\x20";
	const JASC_OPTION_PLUS2 = '++';
	const JASC_OPTION_MINUS1 = "\x20-\x20";
	const JASC_OPTION_MINUS2 = '--';
	const JASC_OPTION_PLUSEQUAL = "\x20+=\x20";
	const JASC_OPTION_MINUSEQUAL = "\x20-=\x20";
	const JASC_OPTION_EQUAL1 = "\x20=\x20";

}

/**
 * interface with block borders
 */
interface I_JaSC_BlockBorder
{

	const JASC_OPTION_CMNBRKTS = '(%s)';
	const JASC_OPTION_SQRBRKTS = '[%s]';
	const JASC_OPTION_BRCS = '{%s}';
	const JASC_OPTION_SMPLQTS = "'%s'";
	const JASC_OPTION_DBLQTS = '"%s"';
	const JASC_OPTION_SLSHS = '/%s/';

}

/**
 * interface with values separators
 */
interface I_JaSC_ValuesSeparator
{

	const JASC_OPTION_CMM = ',';
	const JASC_OPTION_DOT = '.';
	const JASC_OPTION_SPC = "\x20";
	const JASC_OPTION_OR1 = '|';

}

/**
 * interface with text formattera - new lines and so on
 */
interface I_JaSC_TextFormatter
{

	const JASC_OPTION_TAB = "\t";
	const JASC_OPTION_NLN = "\n";
	const JASC_OPTION_NLT = "\n\t";

}

/**
 * interface with keywords (pre-defined words for inserting into code)
 */
interface I_JaSC_ScriptKeyword
{

	const JASC_OPTION_FOR = 'for';
	const JASC_OPTION_WHILE = 'while';
	const JASC_OPTION_DO = 'do';
	const JASC_OPTION_IF = 'if';
	const JASC_OPTION_ELSE = 'else';
	const JASC_OPTION_ELSEIF = 'else if';
	const JASC_OPTION_SWITCH = 'switch';
	const JASC_OPTION_CASE = 'case';
	const JASC_OPTION_DEFAULT = 'default';
	const JASC_OPTION_BREAK = 'break';
	const JASC_OPTION_CONTINUE = 'continue';
	const JASC_OPTION_TRY = 'try';
	const JASC_OPTION_CATCH = 'catch';
	const JASC_OPTION_FINALLY = 'finally';
	const JASC_OPTION_FUNCTION = 'function';
	const JASC_OPTION_INSTOF = "\x20instanceof\x20";
	const JASC_OPTION_IN = "\x20in\x20";
	const JASC_OPTION_NEW = "new\x20";
	const JASC_OPTION_VAR = "var\x20";

}

/**
 * interface with special/other characters
 */
interface I_JaSC_SpecialCharacter
{

	const JASC_OPTION_HASH = '#';
	const JASC_OPTION_DLR = '$';
	const JASC_OPTION_PLUS = '+';
	const JASC_OPTION_SMCLN = ';';
	const JASC_OPTION_CLN = ":";
	const JASC_OPTION_AND1 = '&';

}

/**
 * interface with modes for inserting of values
 */
interface I_JaSC_InsertMode
{

	/**
	 * values are inserted from right to left
	 */
	const JASC_MODE_RTLINS = 'RIGHT_TO_LEFT_INSERT';
	/**
	 * values are inserted from left to right
	 */
	const JASC_MODE_LTRINS = 'LEFT_TO_RIGHT_INSERT';
	/**
	 * values are not inserted
	 */
	const JASC_MODE_NOINS = 'NO_INSERT';

}

interface I_JaSC_ValueMode
{

	const JASC_MODE_CSV = 'CSV';
	const JASC_MODE_PRMS = 'PARAMETERS';
	const JASC_MODE_CSVPRMS = 'CSV_PARAMETERS';

}

interface I_JaSC_ValueForm
{

	const JASC_MODE_VAR = 'VARIABLE';
	const JASC_MODE_TEXT = 'TEXT';

}

interface I_JaSC_Union extends I_JaSC_BlockBorder,
 I_JaSC_SettingOperator,
 I_JaSC_LogicOperator,
 I_JaSC_ElseOperator,
 I_JaSC_ValuesSeparator,
 I_JaSC_TextFormatter,
 I_JaSC_ScriptKeyword,
 I_JaSC_SpecialCharacter
{
	
}

?>