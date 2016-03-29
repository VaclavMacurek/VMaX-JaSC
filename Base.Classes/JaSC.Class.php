<?php

namespace JaSC;

use UniCAT\InstanceOptions;
use UniCAT\CodeExport;
use UniCAT\CodeMemory;
use UniCAT\Comments;
use UniCAT\UniCAT;
use UniCAT\ClassScope;

/**
 * @package VMaX-JaSC
 *
 * @author Václav Macůrek <VaclavMacurek@seznam.cz>
 * @copyright 2014 - 2016 Václav Macůrek
 *
 * @license GNU LESSER GENERAL PUBLIC LICENSE version 3.0
 *
 * class for easier access to class constants of interfaces
 *
 * @method array ShowOptions_Operators() show supported operators
 * @method array ShowOptions_Borders() show supported borders characters
 * @method array ShowOptions_Constructions() show supported constructions keywords
 * @method array ShowOptions_Separators() show supported constructions keywords
 * @method array ShowOptions_Modes() show modes of inserting
 */
final class JaSC extends UniCAT implements I_JaSC_Options_Union, I_JaSC_Modes
{
	use CodeExport, CodeMemory, Comments,
	InstanceOptions
	{
		Set_Instance as public;
	}
	
	/**
	 * prepares lists of options
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		self::$Options['operators'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_Options_Operators');
		self::$Options['borders'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_Options_Borders');
		self::$Options['constructions'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_Options_Constructions');
		self::$Options['keywords'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_Options_Keywords');
		self::$Options['separators'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_Options_Separators');
		self::$Options['modes'] = ClassScope::Get_ConstantsValues('JaSC\I_JaSC_Modes');
	}
}

?>