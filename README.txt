VMaX-JaSC
=========

Brief history of project
========================

Originally developed only for my needs - as part of project that allowed generation of HTML, CSS and JavaScript.
And in March of 2016, after separation from original project and rewriting, I published it for public using, if someone would like to use it.

And development goes on.
Some releases are very important because they change behaviour of one or more parts.
And some ones only fix error that came from inattention.

Development
===========

You may write your ideas for further development on G+ community of the same name as this project (https://plus.google.com/communities/108802113477397664652) or through tickets, here, on SourceForge.net.
Mostly awaited are ideas for

* new classes (they should to create any code of the same structure)
* new or improved features of classes

Traits with public access functions
===================================

Execute
=======

Has only one function - Execute.
This function is used in child classes of class FragmentFiller.
And it has not any parameter.

Basic classes
=============

CodeGenerator
=============

Generated code is assembled consequently, in order of used functions.
There is not any else native setting than how quotes or brackets will accept text set by function used before or after function for setting of quotes or brackets.
Any other setting comes from traits of project VMaX-UniCAT.
The most suitable is creation of short fragments that will be connected to larger blocks.
Offers pre-defined keywords like var, for, while and so on.
All settings may be done also with constants' values - but it is recommended to use constants' names.

Examples
========

Creation of raw text that can be used like variable name.
With default insertion direction 'NO INSERT'.

$Example = new JaSC\CodeGenerator();
$Example -> Set_Value('example');
$Example -> Execute();

Creation of text inserted into simple quotes (apostrophes).
With insertion direction 'LEFT TO RIGHT'.
 
$Example = new JaSC\CodeGenerator(JaSC\Core::JASC_MODE_LTRINS);
$Example -> Set_Value('example');
$Example -> Set_Border(JaSC\Core::JASC_OPTION_SMPLQTS);
$Example -> Execute();

And again creation of text inserted into simple quotes (apostrophes).
Now with insertion direction 'RIGHT TO LEFT'.
 
$Example = new JaSC\CodeGenerator(JaSC\Core::JASC_MODE_LTRINS);
$Example -> Set_Border(JaSC\Core::JASC_OPTION_SMPLQTS);
$Example -> Set_Value('example');
$Example -> Execute();

Creation of logic operator.
 
$Example = new JaSC\CodeGenerator();
$Example -> Set_LogicOperator(JaSC\Core::JASC_OPTION_LT);
$Example -> Execute();

Creation of setting operator.
 
$Example = new JaSC\CodeGenerator();
$Example -> Set_SettingOperator(JaSC\Core::JASC_OPTION_PLUS2);
$Example -> Execute();

Creation of values separator.
This function has default option - space.

$Example = new JaSC\CodeGenerator();
$Example -> Set_ValuesSeparator();
$Example -> Execute();

Creation of values separator.
Now with comma, other of four supported values separators.

$Example = new JaSC\CodeGenerator();
$Example -> Set_ValuesSeparator(JaSC\Core::JASC_OPTION_CMM);
$Example -> Execute();

Creation of text formatter.
This function has default option - new line.

$Example = new JaSC\CodeGenerator();
$Example -> Set_TextFormatter();
$Example -> Execute();

Creation of text formatter.
Now with tab, other of three supported values separators.

$Example = new JaSC\CodeGenerator();
$Example -> Set_TextFormatter(JaSC\Core::JASC_OPTION_TAB);
$Example -> Execute();

Creation of pre-defined keyword.
Code generator allows to use some special pre-defined words used in loops, conditions and so on.
Unsupported words can be used via function Set_Value.

$Example = new JaSC\CodeGenerator();
$Example -> Set_ScriptKeyword(JaSC\Core::JASC_OPTION_FOR);
$Example -> Execute();

Creation of special character.
These characters cannot be placed in other groups - because they are used in more than one way,
or they are already present in other groups in different form used in else way.

$Example = new JaSC\CodeGenerator();
$Example -> Set_SpecialCharacter(JaSC\Core::JASC_OPTION_PLUS);
$Example -> Execute();

Functions can be chained - to generate longer code.
For examples see code of functions of classes FFiller_Basic and FFiller_jQuery.

Core
====

Provides simple access to chosen interfaces and their constants.
This class has not any real functions, only magic function __callStatic inherited from parent class from project VMaX-UniCAT.

Advanced classes
================

FluentFragment
==============

It is special fluent interface for CodeGenerator.
Allows to set code through using of functions of the same name as used characters.
In comparison with class FluentElement from project VMaX-MarC, this class hides (most) functions.

Examples
========

Codes of the same result - but two forms.
The first one belongs to CodeGenerator.
The second one belongs to FluentElement and is VISUALLY shorter.
Code is borrowed from function Cdtn_Case of class FFiller_Basic.

$Example = new JaSC\CodeGenerator();
$Example -> Set_ExportWay(Core::UNICAT_OPTION_SKIP);
$Example -> Set_ScriptKeyword(Core::JASC_OPTION_CASE);
$Example -> Set_ValuesSeparator();
$Example -> Set_Value($Example);
$Example -> Set_ElseOperator(Core::JASC_OPTION_CLN);
$Example -> Set_TextFormatter(Core::JASC_OPTION_NLT);
$Example -> Set_Value($Example);
$Example -> Set_TextFormatter(Core::JASC_OPTION_NLT);
$Example -> Set_ScriptKeyword(Core::JASC_OPTION_BREAK);
$Example -> Set_ElseOperator(Core::JASC_OPTION_SMCLN);
$Example -> Set_TextFormatter();
$Example -> Execute();

JaSC\FluentElement::InsertMode()
				->Set_ExportWay(JaSC\Core::UNICAT_OPTION_SKIP)
				->Set_Case()
				->Set_Spc()
				->Set_Value($Example)
				->Set_Cln()
				->Set_Nlt()
				->Set_Value($Example)
				->Set_Nlt()
				->Set_Break()
				->Set_Smcln()
				->Set_Nln()
				->Execute();

ChainedFunctionsAssembler
=========================

Assembles chain of functions as is known mostly from jQuery, it means for example $(document).ready().
Length of chain may be as long as you wish, if processing will not exceed time limit.

Examples
========

Assembling of functions chain does not include anything what is in the front of the first set function.
It has to be included through constructor, but it can be anything usable.

Character `$` is default start.
So, it can be used for start of jQuery or so.
Basic construction of jQuery's AJAX handling.
Result of this will be $.ajax().

$Example = new JaSC\ChainedFunctionsAssembler();
$Example -> Set_Function('ajax', '');
$Example -> Execute();

Basic construction of simple attributes handling is a bit more difficult because it demands setting of start.
This example contains usage of class FluentElement.
Result of it will be $().attr()

$Example = new JaSC\ChainedFunctionsAssembler(JaSC\FluentElement::InsertMode()->Set_Dlr()->Set_Cmnbrkts()->Execute() );
$Example -> Set_Function('attr', '');
$Example -> Execute();

MixedValuesAssembler
====================

Allows to create combinations of texts/numbers and variables of various length.
It is good for cases like jQuery's identification of elements where is needed to combine texts and variables - like $('#'+ID).css('display', 'block');

Examples
========

Result of following example will be '#'+ID.

$Example = new JaSC\MixedValuesAssembler();
$Example -> Set_Value('#', JaSC\Core::JASC_MODE_TEXT);
$Example -> Set_Value('ID', JaSC\Core::JASC_MODE_VAR);
$Example -> Execute();

MultiValuesSerializer
=====================

Allows to prepare multiple values in one of three modes - CSV, parameters and combination of both.
JSON is not supported.

Examples
========

Creation of CSV with two values in simple form.
This can be done very simply also with FluentElement or even CodeGenerator.
So, see difference between all three ways.
Result of them will be the same: Example1,Example2

$Example = new JaSC\MultiValuesSerializer();
$Example -> Set_Value('Example1', JaSC\Core::JASC_MODE_VAR);
$Example -> Set_Value('Example2', JaSC\Core::JASC_MODE_VAR);
$Example -> Execute();

JaSC\FluentElement::InsertMode()
				->Set_Value('Example1')
				->Set_Cmm()
				->Set_Value('\Example2')
				->Execute();

$Example = new JaSC\CodeGenerator();
$Example -> Set_Value('Exaple1');
$Example -> Set_ValuesSeparator(JaSC\Core::JASC_OPTION_CMM);
$Example -> Set_Value('Example2');
$Example -> Execute();

Now creation of CSV with values inside quotes.
Difference between all those ways in this case is greater.
Result will be the same, again: 'Example1','Example2'

$Example = new JaSC\MultiValuesSerializer();
$Example -> Set_Value('Example1', JaSC\Core::JASC_MODE_TEXT);
$Example -> Set_Value('Example2', JaSC\Core::JASC_MODE_TEXT);
$Example -> Execute();

JaSC\FluentElement::InsertMode(JaSC\Core::JASC_MODE_RTLINS)
				->Set_Smplqts()
				->Set_Value('Example1')
				->Set_Cmm()
				->Set_Smplqts()
				->Set_Value('Example2')
				->Execute();

$Example = new JaSC\CodeGenerator();
$Example -> Set_Value('Example1');
$Example -> Set_ValuesSeparator(JaSC\Core::JASC_OPTION_CMM);
$Example -> Set_Value('Example2');
$Example -> Execute();

Else mode is parameters.
This mode demands using array as value.
Result of following will be: Example1 = Value1, Example2 = Value2

$Example = new JaSC\MultiValuesSerializer(JaSC\Core::JASC_MODE_PRMS);
$Example -> Set_Value(['Example1','Value1'], JaSC\Core::JASC_MODE_VAR);
$Example -> Set_Value(['Example2','Value2'], JaSC\Core::JASC_MODE_VAR);
$Example -> Execute();

And now with values in quotes.
Result of following will be: Example1 = 'Value1', Example2 = 'Value2'

$Example = new JaSC\MultiValuesSerializer(JaSC\Core::JASC_MODE_PRMS);
$Example -> Set_Value(['Example1','Value1'], JaSC\Core::JASC_MODE_TEXT);
$Example -> Set_Value(['Example2','Value2'], JaSC\Core::JASC_MODE_TEXT);
$Example -> Execute();

And also, both these ways can be combined.
Then, result of following will be: Example1, Example2 = 'Value2'

$Example = new JaSC\MultiValuesSerializer(JaSC\Core::JASC_MODE_CSVPRMS);
$Example -> Set_Value('Example1', JaSC\Core::JASC_MODE_VAR);
$Example -> Set_Value(['Example2','Value2'], JaSC\Core::JASC_MODE_TEXT);
$Example -> Execute();

FragmentFiller/FFiller_Basic
============================

Allows to create one of many supported fragments with only filling of prepared template.
Usage of more than one template is not supported.
But more objects of class may be used in a row.

Functions represent loops, conditions, variables and functions setting and expressions for loops and conditions.
And each create only one fragment of code, even if some (5 of all) may be additionally modified.

# Xpsn_ForMath
# Xpsn_ForIn
# Xpsn_While
# Cdtn_If
# Cdtn_Else
# Cdtn_ElseIf
# Cdtn_Switch
# Cdtn_Case
# Cdtn_Default
# Cdtn_TryCatch
# Loop_For
# Loop_While
# Loop_DoWhile
# Dfn_Function
# Dfn_AnnmFunction
# Set_VarSimple
# Set_VarBasic
# Set_VarFull
# Set_VarJson
# Cmpr_Simple
# Cmpr_Multilvl

Examples
========

Xpsn_ForMath prepares basic expression for loop for.
Its five parts are set in two functions.
Variable with its start and final value are demanded to be set - and they are set in constructor.
Result of following will be: var Example = 0; Example < 5; Example++

$Example = new JaSC\FFiller_Basic('Example', 0, 5);
$Example -> Xpsn_ForMath();
$Example -> Execute();

Characters determining direction of loop have default values - that can be re-set directly in function Xpsn_ForMath.
Result of following will be: var Example = 5; Example < 0; Example--

$Example = new JaSC\FFiller_Basic('Example', 5, 0);
$Example -> Xpsn_ForMath(JaSC\Core:JASC_OPTION_LT, JaSC\Core:JASC_OPTION_MINUS2);
$Example -> Execute();

Usage of other functions is the same, regardless of they have additional setting options or not.
I hope that more examples is not needed to write.

FragmentFiller/FFiller_jQuery
=============================

Functions in FFiller_jQuery represents four ways how jQuery functions chain can start.
Rest part is done with class ChainFunctionsAssembler.

# Start_Selection
# StartFull_Selection
# Start_Simple
# StartFull_Simple

Examples
========

Only two of four functions written above demand texts set in constructor.
No function has additional setting, like in case of five functions of FFiller_Basic.

Function Start_Selection offers creation of basic jQuery start with element selection.
Result of following will be: $(document)

$Example = new JaSC\FFiller_jQuery('document');
$Example -> Start_Selection();
$Example -> Execute();

For avoiding conflict of jQuery with other frameworks, use function Start_FullSelection.
Its result will be: jQuery(document)

$Example = new JaSC\FFiller_jQuery('document');
$Example -> Start_FullSelection();
$Example -> Execute();

Exceptions
==========

Exception
=========

Designed only to say that error has happened in VMaX-JaSC.
It inherits all from exception class UniCAT\Exception and not adds anything else.
