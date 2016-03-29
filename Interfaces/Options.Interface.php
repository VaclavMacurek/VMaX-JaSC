<?php

namespace JaSC;

/**
 * @package VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2016 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * interface with not only operators
 */
interface I_JaSC_Options_Operators
{
	const JASC_OPTION_PLUS1 = "\x20+\x20";
	const JASC_OPTION_PLUS2 = '++';
	const JASC_OPTION_MINUS1 = "\x20-\x20";
	const JASC_OPTION_MINUS2 = '--';
	const JASC_OPTION_PLUSEQUAL = "\x20+=\x20";
	const JASC_OPTION_MINUSEQUAL = "\x20-=\x20";
	const JASC_OPTION_EQUAL1 = "\x20=\x20";
	const JASC_OPTION_EQUAL2 = "\x20==\x20";
	const JASC_OPTION_EQUAL3 = "\x20===\x20";
	const JASC_OPTION_LT = "\x20<\x20";
	const JASC_OPTION_GT = "\x20>\x20";
	const JASC_OPTION_LTE = "\x20<=\x20";
	const JASC_OPTION_GTE = "\x20>=\x20";
	const JASC_OPTION_SMCLN = ';';
	const JASC_OPTION_CLN = "\x20:\x20";
	const JASC_OPTION_AND1 = "&";
	const JASC_OPTION_AND2 = "\x20&&\x20";
	const JASC_OPTION_OR = "\x20||\x20";
	const JASC_OPTION_NOTEQUAL1 = "\x20!=\x20";
	const JASC_OPTION_NOTEQUAL2 = "\x20!==\x20";
}

/**
 * interface with borders
 */
interface I_JaSC_Options_Borders
{
	const JASC_OPTION_CMNBRKTS = '(%s)';
	const JASC_OPTION_SQRBRKTS = '[%s]';
	const JASC_OPTION_BRCS = '{%s}';
	const JASC_OPTION_SMPLQT = "'%s'";
	const JASC_OPTION_DBLQT = '"%s"';
}

/**
 * interface with separators
 */
interface I_JaSC_Options_Separators
{
	const JASC_OPTION_CMM = ',';
	const JASC_OPTION_DOT = '.';
	const JASC_OPTION_SPC = "\x20";
	const JASC_OPTION_NLN = "\n";
	const JASC_OPTION_NLT = "\n\t";
}

/**
 * interface with construction options
 */
interface I_JaSC_Options_Constructions
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
	const JASC_OPTION_TRY = 'try';
	const JASC_OPTION_CATCH = 'catch';
	const JASC_OPTION_FINALLY = 'finally';
	const JASC_OPTION_FUNCTION = 'function';
}

/**
 * interface with keywords
 */
interface I_JaSC_Options_Keywords
{
	const JASC_OPTION_INSTOF = "\x20instanceof\x20";
	const JASC_OPTION_IN = "\x20in\x20";
	const JASC_OPTION_NEW = "new\x20";
	const JASC_OPTION_VAR = "var\x20";
}

interface I_JaSC_Options_Union extends	I_JaSC_Options_Borders,
								I_JaSC_Options_Constructions,
								I_JaSC_Options_Keywords,
								I_JaSC_Options_Operators,
								I_JaSC_Options_Separators
{
}

?>