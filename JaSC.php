<?php

/**
 * @package VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2017 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * classes for JavaScript code generation
 */
define("JASC_ADR", __DIR__.'/');

/*
 * VMaX-MarC is dependent on VMaX-UniCAT
 */
if( !defined('UNICAT_ADR') )
{
	die('VMaX-UniCAT not available');
}

/*
 * Interfaces
 */
require_once JASC_ADR.'Interfaces/ConstructionTexts.Interface.php';
require_once JASC_ADR.'Interfaces/Options.Interface.php';
require_once JASC_ADR.'Interfaces/Modes.Interface.php';

/*
 * Exceptions
 */
require_once JASC_ADR.'Exceptions/JaSC_Exception.Exception.php';

/*
 * Base classes (Base.Classes);
 * support and basic code generation classes
 */
require_once JASC_ADR.'Base.Classes/Core.Class.php';
require_once JASC_ADR.'Base.Classes/CodeGenerator.Class.php';

/*
 * Advanced classes (Adv.Classes);
 * classes for creation of pre-defined (not only) simple code
 */
require_once JASC_ADR.'Adv.Classes/FluentFragment.Class.php';
require_once JASC_ADR.'Adv.Classes/FragmentFiller.Class.php';

?>