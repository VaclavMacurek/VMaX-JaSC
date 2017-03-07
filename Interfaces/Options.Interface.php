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
interface I_JaSC_Options_LogicOperator
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
interface I_JaSC_Options_SettingOperator
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
 * interface with else operators
 */
interface I_JaSC_Options_ElseOperator
{

	const JASC_OPTION_SMCLN = ';';
	const JASC_OPTION_CLN = "\x20:\x20";
	const JASC_OPTION_AND1 = "&";

}

/**
 * interface with block borders
 */
interface I_JaSC_Options_BlockBorder
{

	const JASC_OPTION_CMNBRKTS = '(%s)';
	const JASC_OPTION_SQRBRKTS = '[%s]';
	const JASC_OPTION_BRCS = '{%s}';
	const JASC_OPTION_SMPLQTŚ = "'%s'";
	const JASC_OPTION_DBLQTS = '"%s"';
	const JASC_OPTION_SLSHS = '/%s/';

}

/**
 * interface with values separators
 */
interface I_JaSC_Options_ValuesSeparator
{

	const JASC_OPTION_CMM = ',';
	const JASC_OPTION_DOT = '.';
	const JASC_OPTION_SPC = "\x20";
	const JASC_OPTION_OR1 = '|';

}

/**
 * interface with code-breakers (new-lines)
 */
interface I_JaSC_Options_LineBreaker
{

	const JASC_OPTION_NLN = "\n";
	const JASC_OPTION_NLT = "\n\t";

}

/**
 * interface with keywords (pre-defined words for inserting into code)
 */
interface I_JaSC_Options_ScriptKeyword
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
	const JASC_OPTION_FUNCTION = "function\x20";
	const JASC_OPTION_INSTOF = "\x20instanceof\x20";
	const JASC_OPTION_IN = "\x20in\x20";
	const JASC_OPTION_NEW = "new\x20";
	const JASC_OPTION_VAR = "var\x20";

}

interface I_JaSC_Options_Union extends I_JaSC_Options_BlockBorder,
 I_JaSC_Options_SettingOperator,
 I_JaSC_Options_LogicOperator,
 I_JaSC_Options_ElseOperator,
 I_JaSC_Options_ValuesSeparator,
 I_JaSC_Options_LineBreaker,
 I_JaSC_Options_ScriptKeyword
{
	
}

?>